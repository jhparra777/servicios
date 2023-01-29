<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Clientes;
use App\Models\DatosBasicos;
use App\Models\DocumentosVerificados;
use App\Models\RegistroProceso;
use App\Models\Sitio;
use App\Models\TipoDocumento;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReporteContratadoHojaVidaController extends Controller
{
    protected function sinClientesPruebas(&$ids_clientes_prueba) {
        $sitio = Sitio::first();
        if ($sitio->filtro_cliente == 'enabled' && $sitio->clientes_prueba_id != null && $sitio->clientes_prueba_id != '') {
            $ids_clientes_prueba = explode(",", $sitio->clientes_prueba_id);
            return true;
        }
        return false;
    }

    public function contratado_hoja_vida(Request $request)
    {
        $clientes = ["" => "Seleccionar"] + Clientes::orderBy('nombre')->pluck("clientes.nombre", "clientes.id")
        ->toArray();

        $usuarios_envio = ["" => "- Seleccionar -"] + User::join('role_users', 'role_users.user_id', '=', 'users.id')
            ->whereRaw('users.id in(select distinct(usuario_envio) from procesos_candidato_req)')
            ->where('role_users.role_id', 19)
            ->pluck("users.name", "users.id")
        ->toArray();

        $usuarios_aprueba = ["" => "- Seleccionar -"] + User::whereRaw('users.id in(select distinct(user_autorizacion) from procesos_candidato_req)')->pluck("users.name", "users.id")
        ->toArray();

        $headers   = $this->getHeaderContratadoHV($request);
        $data      = $this->getDataContratadoHV($request);

        return view('admin.reportes.contratados_hoja_vida.reporte_contratados_hv')->with([
            'data'              => $data,
            'headers'           => $headers,
            'clientes'          => $clientes,
            'usuarios_envio'    => $usuarios_envio,
            'usuarios_aprueba'  => $usuarios_aprueba
        ]);
    }

    public function contratado_hoja_vida_excel(Request $request)
    {
        $headers  = $this->getHeaderContratadoHV($request);
        $data     = $this->getDataContratadoHV($request);
        $formato  = $request->formato;

        if ($data == 'vacio') {
            $clientes  = ["" => "Seleccionar"] + Clientes::orderBy('nombre')->pluck("clientes.nombre", "clientes.id")
            ->toArray();

            $usuarios_envio = ["" => "- Seleccionar -"] + User::join('role_users', 'role_users.user_id', '=', 'users.id')
                ->whereRaw('users.id in(select distinct(usuario_envio) from procesos_candidato_req)')
                ->where('role_users.role_id', 19)
                ->pluck("users.name", "users.id")
            ->toArray();

            $usuarios_aprueba = ["" => "- Seleccionar -"] + User::whereRaw('users.id in(select distinct(user_autorizacion) from procesos_candidato_req)')->orderBy('name')->pluck("users.name", "users.id")
            ->toArray();

            return view('admin.reportes.contratados_hoja_vida.reporte_contratados_hv')->with([
                'data'              => $data,
                'headers'           => $headers,
                'clientes'          => $clientes,
                'usuarios_envio'    => $usuarios_envio,
                'usuarios_aprueba'  => $usuarios_aprueba
            ]);
        }

        $sitio = Sitio::first();
        $nombre = "Proservis";
        if(isset($sitio->nombre)){
            if($sitio->nombre != ""){
                $nombre = $sitio->nombre;
            }
        }

        Excel::create('reporte-excel-contratos-hoja-vida', function ($excel) use ($data, $headers, $formato) {
            $excel->setTitle('Contratos y Hoja de Vida');
            $excel->setCreator("$nombre")
                ->setCompany("$nombre");
            $excel->setDescription('Contratos y Hoja de Vida');
            $excel->sheet('Hoja de Vida', function ($sheet) use ($data, $headers, $formato) {
                $sheet->setOrientation("landscape");
                $sheet->loadView('admin.reportes.contratados_hoja_vida.include.grilla_detalle_section_hv', [
                    'data'    => $data,
                    'headers' => $headers['titulo_hoja_vida'],
                    'formato' => $formato,
                ]);
            });
            $excel->sheet('Contratos', function ($sheet) use ($data, $headers, $formato) {
                $sheet->setOrientation("landscape");
                $sheet->loadView('admin.reportes.contratados_hoja_vida.include.grilla_detalle_section_contratados', [
                    'data'    => $data,
                    'headers' => $headers['titulo_contratados'],
                    'formato' => $formato,
                ]);
            });
        })->export($formato);
    }

    

    private function getHeaderContratadoHV($request)
    {
        $headersr['titulo_contratados'] = [];

        $headersr['titulo_contratados'] = array(
            'Nit Cliente',
            'Nomina',
            'Identificación',
            'Sueldo',
            'FIngreso',
            'FRetiro',
            'EPS',
            'AFP',
            'ARP',
            'CAJA',
            'sCESANTIAS',
            'CentroTrabajo',
            'TarifaARP',
            'CentroCosto',
            'Nivel5',
            'Nivel6',
            'Nivel7',
            'Nivel8',
            'Cargo',
            'TipoContrato',
            'Tiempo',
            'TipoEmpleado',
            'Banco',
            'CuentaBanco',
            'FormaPago',
            'FormaSalario',
            'TipoSalario',
            'Funciones',
            'Objeto',
            'Descripcion',
            'Restriccion',
            'SubtipoCotizante',
            'Manejo',
            'Zona',
            'TipoCuentaBanco',
            'PaisTributo',
            'DptoTributo',
            'CiudadTributo',
            'TrabajoAltura',
            'Certificado',
            'FechaCertificado',
            'SueldoAfiliacion'
        );

        $headersr['titulo_hoja_vida'] = [];

        $headersr['titulo_hoja_vida'] = array(
            'Identificación',
            '1Nombre',
            '2Nombre',
            '1Apellido',
            '2Apellido',
            'Direccion',
            'Telefono1',
            'Telefono2',
            'TipoId',
            'Correo',
            'DV',
            'Celular',
            'Pais Vive',
            'Dpto Vive',
            'Ciudad Vive',
            'MujerCF',
            'Etnico',
            'Social',
            'Estrato',
            'Sexo',
            'Estado',
            'GrupoS',
            'Peso',
            'Estatura',
            'Profesión',
            'Zapatos',
            'Pantalon',
            'Camisa',
            'NivelEducativo',
            'Pais Nació',
            'Dpto Nació',
            'Ciudad Nació',
            'FExpedicion',
            'FNacido',
            'FRegistro',
            'LMilitar',
            'LConducir',
            'Avecindad',
            'Barrio',
            'FFechaCertificadoJudicial',
            'Judicial',
            'Distrito',
            'CiudadExpide (Escrita)',
            'Categoria',
            'ClasificacionCasa',
            'TipoIngreso'
        );

        return $headersr;
    }

    /*
    *   Contenido de tabla o archivo excel
    */
    private function getDataContratadoHV($request)
    {
        $req_id = $request->req_id;
        $numero_id = $request->numero_id;
        $cliente_id = $request->cliente_id;
        $usuario_aprueba = $request->usuario_aprueba;
        $usuario_envio = $request->usuario_envio;
        $generar_datos = $request->generar_datos;
        $formato      = ($request->has('formato')) ? $request->formato : 'html';

        $fecha_inicio = "";
        $fecha_final  = "";

        if($request->rango_fecha != ""){
            $rango = explode(" | ", $request->rango_fecha);
            $fecha_inicio = $rango[0];
            $fecha_final  = $rango[1];
        }

        $fecha_inicio_firma = "";
        $fecha_final_firma  = "";

        if($request->rango_fecha_firma != ""){
            $rango_firma = explode(" | ", $request->rango_fecha_firma);
            $fecha_inicio_firma = $rango_firma[0];
            $fecha_final_firma  = $rango_firma[1];
        }

        $data = "vacio";

        if($fecha_inicio!="" || $fecha_final!="" || $fecha_inicio_firma!="" || $fecha_final_firma!="" ||  $cliente_id!="" || $usuario_envio!="" || $usuario_aprueba!="" || $req_id!="") {

            $data = RegistroProceso::join("requerimiento_cantidato", "requerimiento_cantidato.id", '=', "procesos_candidato_req.requerimiento_candidato_id")
                ->join("requerimientos","requerimientos.id","=","procesos_candidato_req.requerimiento_id")
                ->join('negocio', 'requerimientos.negocio_id', '=', 'negocio.id')
                ->join('clientes', 'negocio.cliente_id', '=', 'clientes.id')
                ->join("datos_basicos", "datos_basicos.user_id", "=", "requerimiento_cantidato.candidato_id")
                ->join('cargos_especificos','requerimientos.cargo_especifico_id','=','cargos_especificos.id')
                ->leftjoin("ciudad", function ($join) {
                    $join->on("ciudad.cod_pais", "=", "requerimientos.pais_id")
                        ->on("ciudad.cod_ciudad", "=", "requerimientos.ciudad_id")
                        ->on("ciudad.cod_departamento", "=", "requerimientos.departamento_id");
                })
                //->leftjoin('agencias', 'ciudad.agencia', '=', 'agencias.id')
                ->leftjoin("tipo_identificacion", "tipo_identificacion.id", "=", "datos_basicos.tipo_id")
                ->leftjoin("generos", "generos.id", "=", "datos_basicos.genero")
                ->leftjoin('tipos_salarios', 'tipos_salarios.id', '=', 'requerimientos.tipo_salario')
                ->leftjoin('motivo_requerimiento', 'motivo_requerimiento.id', '=', 'requerimientos.motivo_requerimiento_id')
                ->leftjoin('requerimiento_contrato_candidato', 'requerimiento_contrato_candidato.requerimiento_candidato_id', '=', 'procesos_candidato_req.requerimiento_candidato_id')
                ->leftjoin('centros_costos_produccion', 'centros_costos_produccion.id', '=', 'requerimiento_contrato_candidato.centro_costo_id')
                ->leftjoin('firma_contratos', function($join){
                    $join->on('firma_contratos.req_id', '=', 'requerimientos.id')
                        ->on('firma_contratos.user_id', '=', 'datos_basicos.user_id');
                })
                ->leftjoin("entidades_afp", "entidades_afp.id", "=", "requerimiento_contrato_candidato.fondo_pensiones_id")
                ->leftjoin("entidades_eps", "entidades_eps.id", "=", "requerimiento_contrato_candidato.eps_id")
                ->leftjoin("fondo_cesantias", "fondo_cesantias.id", "=", "requerimiento_contrato_candidato.fondo_cesantia_id")
                ->leftjoin("caja_compensacion", "caja_compensacion.id", "=", "requerimiento_contrato_candidato.caja_compensacion_id")
                ->leftjoin("bancos", "bancos.id", "=", "requerimiento_contrato_candidato.nombre_banco")
                ->leftjoin("nominas_clientes", "nominas_clientes.id", "=", "requerimiento_contrato_candidato.nomina_cliente_id")
                ->leftjoin("objetos_contrato", "objetos_contrato.id", "=", "requerimiento_contrato_candidato.objeto_contrato_id")
                ->leftjoin("subtipo_cotizante", "subtipo_cotizante.id", "=", "requerimiento_contrato_candidato.subtipo_cotizante_id")
                ->leftJoin("nivel_5", "nivel_5.id", "=", "requerimiento_contrato_candidato.nivel_5_id")
                ->leftJoin("nivel_6", "nivel_6.id", "=", "requerimiento_contrato_candidato.nivel_6_id")
                ->leftJoin("nivel_7", "nivel_7.id", "=", "requerimiento_contrato_candidato.nivel_7_id")
                ->leftJoin("nivel_8", "nivel_8.id", "=", "requerimiento_contrato_candidato.nivel_8_id")
                ->leftjoin("tipos_contratos", "tipos_contratos.id", "=", "requerimientos.tipo_contrato_id")
                ->leftjoin("tipos_empleados", "tipos_empleados.id", "=", "requerimiento_contrato_candidato.tipo_empleado_id")
                ->leftjoin('estados_requerimiento', 'estados_requerimiento.req_id', '=', 'requerimientos.id')
                ->leftjoin('centros_trabajo', 'centros_trabajo.id', '=', 'requerimiento_contrato_candidato.centro_trabajo_id')
                ->leftjoin('agencias', 'agencias.id', '=', 'requerimiento_contrato_candidato.centro_trabajo')
                ->leftjoin('talla_zapatos', 'talla_zapatos.id', '=', 'datos_basicos.talla_zapatos')
                ->leftjoin('talla_camisa', 'talla_camisa.id', '=', 'datos_basicos.talla_camisa')
                ->leftjoin('talla_pantalon', 'talla_pantalon.id', '=', 'datos_basicos.talla_pantalon')
                ->leftjoin('estrato', 'estrato.id', '=', 'datos_basicos.estrato')
                ->leftjoin('peso', 'peso.id', '=', 'datos_basicos.peso_id')
                ->leftjoin('estatura', 'estatura.id', '=', 'datos_basicos.estatura_id')
                ->leftjoin('tipos_vivienda', 'tipos_vivienda.id', '=', 'datos_basicos.tipo_vivienda_id')
                ->leftjoin("cabeza_familia", "cabeza_familia.id", "=", "datos_basicos.cabeza_familia_id")
                ->leftjoin("grupos_poblacionales", "grupos_poblacionales.id", "=", "datos_basicos.grupo_poblacional")
                ->leftjoin("profesiones_sorttime", "profesiones_sorttime.id", "=", "datos_basicos.profesion_sorttime_id")
                ->where("proceso","ENVIO_CONTRATACION")
                ->where("firma_contratos.estado", 1)
                ->whereIn("firma_contratos.terminado", [1,2])
                ->whereRaw('estados_requerimiento.id=(select max(estados_requerimiento.id) from estados_requerimiento where estados_requerimiento.req_id=requerimientos.id)')
                ->whereRaw('requerimiento_contrato_candidato.id=(select max(requerimiento_contrato_candidato.id) from requerimiento_contrato_candidato where requerimiento_contrato_candidato.requerimiento_candidato_id=procesos_candidato_req.requerimiento_candidato_id)')
                ->where(function ($where) use ($fecha_inicio,$fecha_final, $fecha_inicio_firma,$fecha_final_firma, $cliente_id,$req_id,$usuario_envio,$usuario_aprueba) {
                    if ($fecha_inicio != "" && $fecha_final != "") {
                        $where->whereBetween("procesos_candidato_req.created_at",[$fecha_inicio . ' 00:00:00', $fecha_final . ' 23:59:59']);
                    }

                    if ($fecha_inicio_firma != "" && $fecha_final_firma != "") {
                        $where->whereBetween("firma_contratos.fecha_firma",[$fecha_inicio_firma. ' 00:00:00', $fecha_final_firma. ' 23:59:59']);
                    }

                    if ($cliente_id != null && $cliente_id != "") {
                        $where->where("negocio.cliente_id", $cliente_id);
                    }

                    if ($req_id !=null && $req_id != "") {
                        $where->where("requerimientos.id", $req_id);
                    }

                    if ($usuario_envio != null && $usuario_envio != "") {
                        $where->where("procesos_candidato_req.usuario_envio",$usuario_envio);
                    }

                    if ($usuario_aprueba != null && $usuario_aprueba != "") {
                        $where->where("procesos_candidato_req.user_autorizacion",$usuario_aprueba);
                    }                   
                })
                ->where(function ($query) use ($cliente_id) {
                    if($cliente_id == '' || $cliente_id == null) {
                        $ids_clientes_prueba = [];
                        if ($this->sinClientesPruebas($ids_clientes_prueba)) {
                            $query->whereNotIn("negocio.cliente_id", $ids_clientes_prueba);
                        }
                    }
                })
                ->select(
                    'datos_basicos.user_id as user_id',
                    'datos_basicos.numero_libreta as libreta',
                    'datos_basicos.clase_libreta as clase_libreta',
                    'datos_basicos.distrito_militar as distrito_militar',
                    'datos_basicos.telefono_movil as telefono_movil',
                    'datos_basicos.telefono_fijo',
                    'datos_basicos.direccion as direccion',
                    'datos_basicos.fecha_nacimiento as fecha_nacimiento',
                    'datos_basicos.numero_id as cedula',
                    'datos_basicos.nombres as nombres',
                    'datos_basicos.primer_nombre',
                    'datos_basicos.segundo_nombre',
                    'datos_basicos.primer_apellido',
                    'datos_basicos.segundo_apellido',
                    'datos_basicos.fecha_nacimiento',
                    'datos_basicos.fecha_expedicion',
                    'datos_basicos.genero as genero',
                    'datos_basicos.email as correo',
                    'datos_basicos.grupo_sanguineo',
                    'datos_basicos.rh',
                    'datos_basicos.numero_licencia',
                    'datos_basicos.barrio',
                    'datos_basicos.created_at as fecha_registro',
                    'datos_basicos.tiene_estudio',
                    'clientes.nit as nit_cliente',
                    //'requerimientos.salario as salario',
                    'agencias.homologa_id as codigo_agencia',
                    'centros_costos_produccion.codigo as codigo_centro_costo',
                    'cargos_especificos.homologa_id as codigo_cargo',
                    'tipos_salarios.homologa_id as codigo_salario',
                    'motivo_requerimiento.homologa_id as codigo_motivo_req',
                    'tipo_identificacion.homologa_id as codigo_tipo_id',
                    'generos.homologa_id as codigo_sexo',
                    'talla_pantalon.homologa_id as codigo_pantalon',
                    'talla_camisa.homologa_id as codigo_camisa',
                    'talla_zapatos.homologa_id as codigo_zapatos',
                    'peso.homologa_id as codigo_peso',
                    'estatura.homologa_id as codigo_estatura',
                    'tipos_vivienda.homologa_id as codigo_tipo_vivienda',
                    'requerimiento_contrato_candidato.fecha_ingreso',
                    'entidades_afp.homologa_id as entidad_afp',
                    'entidades_eps.homologa_id as entidad_eps',
                    'fondo_cesantias.homologa_id as fondo_cesantia',
                    'caja_compensacion.homologa_id as caja_compensacion',
                    'bancos.homologa_id as codigo_banco',
                    'requerimiento_contrato_candidato.numero_cuenta',
                    'requerimiento_contrato_candidato.salario',
                    'requerimiento_contrato_candidato.auxilio_transporte',
                    'estrato.homologa_id as codigo_estrato',
                    'centros_trabajo.homologa_id as codigo_centro_trabajo',
                    'cabeza_familia.homologa_id as codigo_cabeza_familia',
                    'grupos_poblacionales.homologa_id as codigo_grupo_poblacional',
                    'profesiones_sorttime.homologa_id as codigo_profesion_sorttime',
                    'nominas_clientes.homologa_id as codigo_nomina_cliente',
                    'objetos_contrato.homologa_id as codigo_objeto_contrato',
                    'subtipo_cotizante.homologa_id as codigo_subtipo_cotizante',
                    'nivel_5.homologa_id as codigo_nivel_5',
                    'nivel_6.homologa_id as codigo_nivel_6',
                    'nivel_7.homologa_id as codigo_nivel_7',
                    'nivel_8.homologa_id as codigo_nivel_8',
                    'tipos_empleados.homologa_id as codigo_tipo_empleado',
                    'ciudad.homologa_id as codigo_ciudad_requerimiento',
                    'requerimientos.id as req_id',
                    'tipos_contratos.homologa_id as codigo_contrato',
                    DB::raw('(SELECT paises.homologa_id FROM paises WHERE cod_pais = requerimientos.pais_id LIMIT 1) as codigo_pais_requerimiento'),
                    DB::raw('(SELECT departamentos.homologa_id FROM departamentos WHERE cod_pais = requerimientos.pais_id AND cod_departamento = requerimientos.departamento_id LIMIT 1) as codigo_departamento_requerimiento'),
                    /*DB::raw('(SELECT ciudad.homologa_id FROM ciudad WHERE cod_pais = requerimientos.pais_id AND cod_departamento = requerimientos.departamento_id AND cod_ciudad = requerimientos.ciudad_id LIMIT 1) as codigo_ciudad_requerimiento'),*/
                    /*DB::raw('(SELECT tipos_contratos.homologa_id FROM tipos_contratos WHERE id = requerimientos.tipo_contrato_id LIMIT 1) as codigo_contrato'),*/
                    DB::raw('(SELECT tipos_jornadas.homologa_id FROM tipos_jornadas WHERE id = requerimientos.tipo_jornadas_id LIMIT 1) as codigo_jornada'),
                    DB::raw('(SELECT formas_pago.homologa_id FROM formas_pago WHERE id = requerimiento_contrato_candidato.forma_pago_id LIMIT 1) as codigo_forma_pago'),
                    DB::raw('(SELECT tipos_ingreso.homologa_id FROM tipos_ingreso WHERE id = requerimiento_contrato_candidato.tipo_ingreso LIMIT 1) as codigo_tipo_ingreso'),
                    DB::raw('(SELECT paises.homologa_id FROM paises WHERE cod_pais = datos_basicos.pais_residencia LIMIT 1) as codigo_pais_vive'),
                    DB::raw('(SELECT departamentos.homologa_id FROM departamentos WHERE cod_pais = datos_basicos.pais_residencia AND cod_departamento = datos_basicos.departamento_residencia LIMIT 1) as codigo_departamento_vive'),
                    DB::raw('(SELECT ciudad.homologa_id FROM ciudad WHERE cod_pais = datos_basicos.pais_residencia AND cod_departamento = datos_basicos.departamento_residencia AND cod_ciudad = datos_basicos.ciudad_residencia LIMIT 1) as codigo_ciudad_vive'),
                    DB::raw('(SELECT paises.homologa_id FROM paises WHERE cod_pais = datos_basicos.pais_nacimiento LIMIT 1) as codigo_pais_nacimiento'),
                    DB::raw('(SELECT departamentos.homologa_id FROM departamentos WHERE cod_pais = datos_basicos.pais_nacimiento AND cod_departamento = datos_basicos.departamento_nacimiento LIMIT 1) as codigo_departamento_nacimiento'),
                    DB::raw('(SELECT ciudad.homologa_id FROM ciudad WHERE cod_pais = datos_basicos.pais_nacimiento AND cod_departamento = datos_basicos.departamento_nacimiento AND cod_ciudad = datos_basicos.ciudad_nacimiento LIMIT 1) as codigo_ciudad_nacimiento'),
                    DB::raw('(SELECT grupo_sanguineo.homologa_id FROM grupo_sanguineo WHERE id = datos_basicos.tipo_sangre_id LIMIT 1) as codigo_grupo_sanguineo'),
                    DB::raw('(SELECT estados_civiles.homologa_id FROM estados_civiles WHERE id = datos_basicos.estado_civil LIMIT 1) as codigo_estado_civil'),
                    DB::raw("(SELECT niveles_estudios.homologa_id FROM niveles_estudios WHERE niveles_estudios.id = 14) as codigo_nivel_educativo_sin_definir"),
                    DB::raw('(SELECT niveles_estudios.homologa_id FROM estudios INNER JOIN niveles_estudios ON niveles_estudios.id = estudios.nivel_estudio_id WHERE estudios.user_id = datos_basicos.user_id AND niveles_estudios.active = 1 ORDER BY niveles_estudios.jerarquia DESC LIMIT 1) as codigo_nivel_educativo'),
                    DB::raw('(SELECT ciudad.nombre FROM ciudad WHERE cod_pais = datos_basicos.pais_id AND cod_departamento = datos_basicos.departamento_expedicion_id AND cod_ciudad = datos_basicos.ciudad_expedicion_id LIMIT 1) as ciudad_expedicion')
                )
                ->orderBy("firma_contratos.id", "desc")
            ->groupBy("firma_contratos.user_id");

            if (isset($request['formato']) and ($formato == "xlsx" || $formato == "pdf")) {
                $data = $data->get();
            } else {
                $data = $data->paginate(5);
            }
        } else if (isset($generar_datos)) {
            session()->flash('mensaje_warning', 'Debe ingresar algún filtro');
        }

        return $data;
    }
}
