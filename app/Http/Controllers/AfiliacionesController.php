<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Sitio;
use App\Models\DatosBasicos;
use App\Models\Requerimiento;
use App\Models\ReqCandidato;
use App\Models\Clientes;
use App\Models\SitioModulo;
use App\Models\FirmaContratos;
use App\Models\User;
use App\Models\Documentos;

use Illuminate\Support\Facades\Mail;

use Maatwebsite\Excel\Facades\Excel;

//Helper
use triPostmaster;

class AfiliacionesController extends Controller
{
    protected function sinClientesPruebas(&$ids_clientes_prueba) {
        $sitio = Sitio::first();
        if ($sitio->filtro_cliente == 'enabled' && $sitio->clientes_prueba_id != null && $sitio->clientes_prueba_id != '') {
            $ids_clientes_prueba = explode(",", $sitio->clientes_prueba_id);
            return true;
        }
        return false;
    }

        /*
     *  Vista principal del asistente de contratación 
    */
    public function index(Request $data)
    {   
        $sitioModulo = SitioModulo::first();
        if ($sitioModulo->afiliaciones == 'disabled') {
            return redirect('admin/index')->with("mensaje_success", "Menú restrigido para instancia");
        }

        $user_sesion = $this->user;

        $sitio = Sitio::first();

        $candidatos = $this->obtenerDataAfiliados($data, 'vista');

        //session(["url_previa_afiliaciones" => url($_SERVER['REQUEST_URI'])]);

        return view("admin.afiliaciones.index-new", compact(
            "user_sesion",
            "candidatos",
            "clientes",
            "usuarios",
            "estados",
            "sitio"
        ));
    }

    public function gestionar($candidato, $req, $contrato_id)
    {
        //Se buscan los datos para armar el correo
        $datos_basicos =  FirmaContratos::join('requerimientos', 'requerimientos.id', '=', 'firma_contratos.req_id')
        ->leftjoin("requerimiento_cantidato", function ($join) {
            $join->on('firma_contratos.req_id', '=', 'requerimiento_cantidato.requerimiento_id')
                ->on('firma_contratos.user_id', '=', 'requerimiento_cantidato.candidato_id');
            })
        ->leftjoin("requerimiento_contrato_candidato", function ($join) {
            $join->on('firma_contratos.req_id', '=', 'requerimiento_contrato_candidato.requerimiento_id')
                ->on('firma_contratos.user_id', '=', 'requerimiento_contrato_candidato.candidato_id');
            })
        ->join("cargos_especificos", "cargos_especificos.id", "=", "requerimientos.cargo_especifico_id")
        ->join("negocio", "negocio.id", "=", "requerimientos.negocio_id")
        ->join("clientes", "clientes.id", "=", "negocio.cliente_id")
        ->leftjoin('datos_basicos', 'datos_basicos.user_id', '=', 'firma_contratos.user_id')
        ->leftjoin("ciudad", function ($join) {
            $join->on("ciudad.cod_pais", "=", "requerimientos.pais_id")
            ->on("ciudad.cod_ciudad", "=", "requerimientos.ciudad_id")
            ->on("ciudad.cod_departamento", "=", "requerimientos.departamento_id");
        })
        ->leftjoin('tipo_identificacion', 'tipo_identificacion.id', '=', 'datos_basicos.tipo_id')
        //->where("requerimiento_cantidato.requerimiento_id", $req)
        //->where("requerimiento_cantidato.candidato_id", $candidato)
        ->where("firma_contratos.id", $contrato_id)
        ->select(
            'datos_basicos.nombres',
            'datos_basicos.primer_apellido',
            'datos_basicos.segundo_apellido',
            'datos_basicos.user_id',
            "ciudad.nombre as nombre_ciudad",
            'datos_basicos.numero_id as cedula',
            'tipo_identificacion.descripcion as tipo_documento',
            "firma_contratos.fecha_firma",
            "firma_contratos.id as contrato_id",
            "requerimientos.sitio_trabajo as sitio_trabajo",
            "requerimiento_cantidato.id as req_can",
            "clientes.nombre as cliente_nombre",
            "clientes.id as cliente_id",
            'cargos_especificos.descripcion as cargo_especifico',
            'requerimiento_contrato_candidato.user_gestiono_id'
            )
        ->first();

        $emails = emails_codigo_rol_cliente_agencia($req, ["EAFL"]);

        if(count($emails) > 0){
            //Se arma la consulta de documentos
            $documentos = Documentos::join("tipos_documentos", "tipos_documentos.id", "=", "documentos.tipo_documento_id")
            ->join("users", "users.id", "=", "documentos.gestiono")
            ->join("role_users", "users.id", "=", "role_users.user_id")
            ->join("roles", "roles.id", "=", "role_users.role_id")
            ->where("roles.codigo", "AFL")
            ->where("documentos.requerimiento", $req)
            ->where('documentos.user_id', $candidato)
            //->whereIn("tipos_documentos.id", [46,47,48]) //cambiar a  45,46,47 para soluciones
            ->select("documentos.nombre_archivo as nombre_archivo", "tipos_documentos.descripcion as tipo_documento")
            ->get();

            if ( $documentos->count() == 0 ) {
                return redirect()->back()->with("mensaje_warning", "No se han cargado soportes de afiliación");
            }

            //Envío de correo
            $this->notificaAfiliaciones(
                $emails,
                $datos_basicos,
                $candidato,
                $req,
                $datos_basicos->req_can,
                $documentos
            );

            //se actualiza campo estado_afiliado 0 = pendiente 1 = procesado
            $firma_contrato = FirmaContratos::find($contrato_id);
    
            if (!empty($firma_contrato)) {
                $firma_contrato->estado_afiliado = 1;
                $firma_contrato->save();
            }

            return redirect()->route("admin.afiliaciones")->with("mensaje_success", "Se han confirmado las afiliaciones exitosamente a los correos: ".$emails->implode('email', ', '));
        }

        return redirect()->back()->with("mensaje_warning", "No se ha encontrado un ejecutivo de afiliaciones asociado para notificar la afiliación");
    }

    /*
    *   Envío de correo electrónico (Notificación de afiliaciones gestionadas)
    */
    private function notificaAfiliaciones($emails, $datos_basicos, $candidato, $req, $req_can, $documentos){

        $asunto = "Confirmación afiliación trabajador {$datos_basicos->cedula}";

        $mailTemplate = 2; //Plantilla con botón e imagen de fondo
        $mailConfiguration = 1; //Id de la configuración
        $mailTitle = $asunto; //Titulo o tema del correo

        $ruta = route('admin.documentos_contratacion', ['candidato' => $candidato, 'req' => $req]);

        $lista_documentos = "";
        foreach($documentos as $docs){
            if( file_exists('recursos_documentos_verificados/'.$docs->nombre_archivo) ){

                $ruta_documento = route("view_document_url", encrypt("recursos_documentos_verificados/|".$docs->nombre_archivo));

                $lista_documentos .= "<a href='{$ruta_documento}' target='_blank'> 
                                        {$docs->tipo_documento}
                                        </a>
                                        <br/>";
            }
        }

        //Arreglo para el botón
        $mailButton = ['buttonText' => 'Soportes afiliación', 'buttonRoute' => $ruta];

        foreach ($emails as $user) {
            //Cuerpo con html y comillas dobles para las variables
            $mailBody = "Hola, {$user->name} te notificamos que se han realizado exitosamente las afiliaciones del trabajador:
                <br/><br/>
                <b>Nombre:</b> {$datos_basicos->nombres} {$datos_basicos->primer_apellido} {$datos_basicos->segundo_apellido}
                <br/>
                <b>Identificación:</b> {$datos_basicos->tipo_documento} {$datos_basicos->cedula}
                <br/>
                <b>Requerimiento:</b> {$req}
                <br/>
                <b>Cargo:</b> {$datos_basicos->cargo_especifico}
                <br/>
                <b>Cliente:</b> {$datos_basicos->cliente_nombre}
                <br/><br/>

                <b>Soportes de afiliación:</b>
                <br/>
                {$lista_documentos}
                <br/>

                O también puedes consultar la documentación digital haciendo clic en el siguiente botón: “Soportes afiliación”
                ";

            $triEmail = triPostmaster::makeEmail($mailTemplate, $mailConfiguration, $mailTitle, $mailBody, $mailButton);

            Mail::send($triEmail->view, ['data' => $triEmail->data], function($message) use($user, $asunto) {

                    $message->to($user->email, "T3RS")
                    ->subject($asunto)
                    ->getHeaders()
                    ->addTextHeader('X-SES-CONFIGURATION-SET', 'watch_emails_t3rs');
            });
        }
        /*
        Mail::send('admin.email_notificacion_afiliaciones', [         
            'datos_basicos' => $datos_basicos,
            'candidato' => $candidato,
            'req' => $req,
            'req_can' => $req_can,
            'documentos' => $documentos,
            'user' => $user,
        ],function ($message) use ($user, $datos_basicos, $documentos) {
            //$message->to("erickloyo50@gmail.com", "T3RS")
            $message->to([$user->email], "T3RS")
            ->subject("Confirmación afiliación trabajador ". $datos_basicos->cedula)
            ->getHeaders()
            ->addTextHeader('X-SES-CONFIGURATION-SET', 'watch_emails_t3rs');
        });
        */
    }

    public function reporte_confirmacion_afiliaciones(Request $request) {
        $sitio = Sitio::first();
        $nombre = "Desarrollo";
        if(isset($sitio->nombre) && $sitio->nombre != "") {
            $nombre = $sitio->nombre;
        }
        $formato    = $request->formato;

        $candidatos = $this->obtenerDataAfiliados($request, 'excel');

        Excel::create('reporte-afiliaciones', function ($excel) use ($candidatos, $headers, $formato, $nombre) {
            $excel->setTitle('Reporte Afiliaciones');
            $excel->setCreator("$nombre")
                ->setCompany("$nombre");
            $excel->setDescription('Reporte Afiliaciones');
            $excel->sheet('Reporte Afiliaciones', function ($sheet) use ($candidatos, $headers, $formato) {
                $sheet->setOrientation("landscape");
                $sheet->loadView('admin.afiliaciones.include.grilla_reporte_afiliaciones', [
                    'candidatos'    => $candidatos
                ]);
            });
        })->export($formato);
    }

    private function obtenerDataAfiliados(Request $data, $vista) {
        //filtro de fecha firma
        $fecha_inicio_firma = "";
        $fecha_final_firma = "";
        if($data->rango_fecha_firma != ""){
            $rango_fecha_firma = explode(" | ", $data->rango_fecha_firma);
            $fecha_inicio_firma = $rango_fecha_firma[0];
            $fecha_final_firma  = $rango_fecha_firma[1];
        }

        if (($data->has('cedula') && $data->get('cedula') != '') || ($fecha_inicio_firma != "" && $fecha_final_firma != "")) {
            $candidatos = FirmaContratos::join('requerimientos', 'requerimientos.id', '=', 'firma_contratos.req_id')
                ->leftjoin('datos_basicos', 'datos_basicos.user_id', '=', 'firma_contratos.user_id')
                ->leftjoin('tipo_identificacion', 'tipo_identificacion.id', '=', 'datos_basicos.tipo_id')
                ->leftjoin("requerimiento_contrato_candidato", "requerimiento_contrato_candidato.id", "=", "firma_contratos.req_contrato_cand_id")
                ->leftjoin("ciudad", function ($join) {
                    $join->on("ciudad.cod_pais", "=", "requerimientos.pais_id")
                        ->on("ciudad.cod_ciudad", "=", "requerimientos.ciudad_id")
                        ->on("ciudad.cod_departamento", "=", "requerimientos.departamento_id");
                })
                ->leftjoin('entidades_afp', 'entidades_afp.id', '=', 'requerimiento_contrato_candidato.fondo_pensiones_id')
                ->leftJoin("entidades_eps", "entidades_eps.id", "=", "requerimiento_contrato_candidato.eps_id")
                ->join("cargos_especificos", "cargos_especificos.id", "=", "requerimientos.cargo_especifico_id")
                ->leftJoin("caja_compensacion", "caja_compensacion.id", "=", "requerimiento_contrato_candidato.caja_compensacion_id")
                ->join("negocio", "negocio.id", "=", "requerimientos.negocio_id")
                ->join("clientes", "clientes.id", "=", "negocio.cliente_id")
                ->leftjoin('centros_trabajo', 'centros_trabajo.id', '=', 'requerimiento_contrato_candidato.centro_trabajo_id')
                ->whereIn("firma_contratos.estado", [0, 1])
                ->whereIn("firma_contratos.terminado", [1,2])
                ->whereNotNull("firma_contratos.fecha_firma")
                ->whereIn("clientes.id", $this->clientes_user)
                ->where(function ($sql) use ($data, $fecha_inicio_firma, $fecha_final_firma) {

                    if ($data->has("cedula") && $data->get("cedula") != "") {
                        $sql->where("datos_basicos.numero_id", $data->get("cedula"));
                        $sql->whereIn("firma_contratos.estado_afiliado", [0,1]);
                    }

                    if ($fecha_inicio_firma != '' && $fecha_final_firma != '') {
                        $sql->whereBetween("firma_contratos.fecha_firma", [$fecha_inicio_firma . ' 00:00:00', $fecha_final_firma . ' 23:59:59']);
                        $sql->whereIn("firma_contratos.estado_afiliado", [0,1]);
                    }

                    if (empty($data->cedula) && empty($data->rango_fecha_firma)){
                        $sql->whereIn("firma_contratos.estado_afiliado", [0]);
                    }
                })
                ->where(function ($query) use ($request) {
                    $ids_clientes_prueba = [];
                    if ($this->sinClientesPruebas($ids_clientes_prueba)) {
                        $query->whereNotIn("clientes.id", $ids_clientes_prueba);
                    }
                })
                ->select(
                    'datos_basicos.user_id',
                    'datos_basicos.email',
                    'datos_basicos.nombres',
                    'datos_basicos.primer_apellido',
                    'datos_basicos.segundo_apellido',
                    'datos_basicos.numero_id',
                    'datos_basicos.telefono_movil',
                    'datos_basicos.barrio',
                    'datos_basicos.direccion',
                    'tipo_identificacion.cod_tipo',
                    'tipo_identificacion.descripcion as tipo_documento',
                    "ciudad.nombre as nombre_ciudad",
                    'requerimiento_contrato_candidato.fecha_fin_contrato',
                    'requerimiento_contrato_candidato.requerimiento_candidato_id',
                    'firma_contratos.req_id',
                    'firma_contratos.user_id as candidato_id',
                    'firma_contratos.id as contrato_id',
                    'firma_contratos.fecha_firma',
                    'firma_contratos.estado as estado_contrato',
                    "entidades_afp.descripcion as fondo_pension",
                    "entidades_eps.descripcion as eps",
                    "requerimiento_contrato_candidato.tipo_ingreso as tipo_ingreso",
                    "requerimiento_contrato_candidato.requerimiento_candidato_id as req_can_id",
                    "requerimiento_contrato_candidato.salario as salario",
                    "cargos_especificos.descripcion as cargo",
                    "caja_compensacion.descripcion as caja_compensacion",
                    "requerimiento_contrato_candidato.fecha_ingreso",
                    'firma_contratos.estado_afiliado',
                    'centros_trabajo.nombre_ctra as riesgo_arl'
                )
            ->orderBy("firma_contratos.fecha_firma", 'ASC');
        } else {
            $candidatos = FirmaContratos::join('requerimientos', 'requerimientos.id', '=', 'firma_contratos.req_id')
                ->leftjoin('datos_basicos', 'datos_basicos.user_id', '=', 'firma_contratos.user_id')
                ->leftjoin('tipo_identificacion', 'tipo_identificacion.id', '=', 'datos_basicos.tipo_id')
                ->leftjoin("requerimiento_contrato_candidato", "requerimiento_contrato_candidato.id", "=", "firma_contratos.req_contrato_cand_id")
                ->leftjoin("ciudad", function ($join) {
                    $join->on("ciudad.cod_pais", "=", "requerimientos.pais_id")
                        ->on("ciudad.cod_ciudad", "=", "requerimientos.ciudad_id")
                        ->on("ciudad.cod_departamento", "=", "requerimientos.departamento_id");
                })
                ->leftjoin('entidades_afp', 'entidades_afp.id', '=', 'requerimiento_contrato_candidato.fondo_pensiones_id')
                ->leftJoin("entidades_eps", "entidades_eps.id", "=", "requerimiento_contrato_candidato.eps_id")
                ->join("cargos_especificos", "cargos_especificos.id", "=", "requerimientos.cargo_especifico_id")
                ->leftJoin("caja_compensacion", "caja_compensacion.id", "=", "requerimiento_contrato_candidato.caja_compensacion_id")
                ->join("negocio", "negocio.id", "=", "requerimientos.negocio_id")
                ->join("clientes", "clientes.id", "=", "negocio.cliente_id")
                ->leftjoin('centros_trabajo', 'centros_trabajo.id', '=', 'requerimiento_contrato_candidato.centro_trabajo_id')
                ->whereIn("firma_contratos.estado", [0, 1])
                ->whereIn("firma_contratos.terminado", [1,2])
                ->whereNotNull("firma_contratos.fecha_firma")
                ->whereIn("clientes.id", $this->clientes_user)
                ->where(function ($sql) use ($data, $fecha_inicio_firma, $fecha_final_firma) {

                    if ($data->has("cedula") && $data->get("cedula") != "") {
                        $sql->where("datos_basicos.numero_id", $data->get("cedula"));
                        $sql->whereIn("firma_contratos.estado_afiliado", [0,1]);
                    }

                    if ($fecha_inicio_firma != '' && $fecha_final_firma != '') {
                        $sql->whereBetween("firma_contratos.fecha_firma", [$fecha_inicio_firma . ' 00:00:00', $fecha_final_firma . ' 23:59:59']);
                        $sql->whereIn("firma_contratos.estado_afiliado", [0,1]);
                    }

                    if (empty($data->cedula) && empty($data->rango_fecha_firma)){
                        $sql->whereIn("firma_contratos.estado_afiliado", [0]);
                    }
                })
                ->where(function ($query) use ($request) {
                    $ids_clientes_prueba = [];
                    if ($this->sinClientesPruebas($ids_clientes_prueba)) {
                        $query->whereNotIn("clientes.id", $ids_clientes_prueba);
                    }
                })
                ->select(
                    'datos_basicos.user_id',
                    'datos_basicos.email',
                    'datos_basicos.nombres',
                    'datos_basicos.primer_apellido',
                    'datos_basicos.segundo_apellido',
                    'datos_basicos.numero_id',
                    'datos_basicos.telefono_movil',
                    'datos_basicos.barrio',
                    'datos_basicos.direccion',
                    'tipo_identificacion.cod_tipo',
                    'tipo_identificacion.descripcion as tipo_documento',
                    "ciudad.nombre as nombre_ciudad",
                    'requerimiento_contrato_candidato.fecha_fin_contrato',
                    'requerimiento_contrato_candidato.requerimiento_candidato_id',
                    'firma_contratos.req_id',
                    'firma_contratos.user_id as candidato_id',
                    'firma_contratos.id as contrato_id',
                    'firma_contratos.fecha_firma',
                    'firma_contratos.estado as estado_contrato',
                    "entidades_afp.descripcion as fondo_pension",
                    "entidades_eps.descripcion as eps",
                    "requerimiento_contrato_candidato.tipo_ingreso as tipo_ingreso",
                    "requerimiento_contrato_candidato.requerimiento_candidato_id as req_can_id",
                    "requerimiento_contrato_candidato.salario as salario",
                    "cargos_especificos.descripcion as cargo",
                    "caja_compensacion.descripcion as caja_compensacion",
                    "requerimiento_contrato_candidato.fecha_ingreso",
                    'firma_contratos.estado_afiliado',
                    'centros_trabajo.nombre_ctra as riesgo_arl'
                )
                ->orderBy("firma_contratos.fecha_firma", 'ASC')
            ->groupBy("firma_contratos.req_id", "firma_contratos.user_id");
        }

        if ($vista == 'excel') {
            return $candidatos->get();
        } else {
            return $candidatos->paginate(12);
        }
    }
}
