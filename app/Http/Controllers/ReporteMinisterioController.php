<?php

namespace App\Http\Controllers;

use App\Models\Sitio;

use App\Http\Requests;
use App\Models\Clientes;
use Illuminate\Http\Request;
use App\Models\FirmaContratos;
use App\Jobs\FuncionesGlobales;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ReporteMinisterioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes  = ["" => "Seleccionar"] + Clientes::orderBy('nombre')->pluck("clientes.nombre", "clientes.id")->toArray();

        $headersr  = $this->getHeaderDetalleMinisterio();
        $data      = $this->getDataDetalleMinisterio($request);
        
        return view('admin.reportes.reporte_ministerio_trabajo.index')->with([
            'data'      => $data,
            'headersr'  => $headersr,
            'clientes'  => $clientes
        ]);
    }

    public function getHeaderDetalleMinisterio()
    {
        $headersr = [
            'AÑO',
            'FECHA DESDE',
            'FECHA HASTA',
            'TIPO REG',
            'CODIGO CNO',
            'RANGO SALARIO',
            'SEXO',
            'RANGO EDAD',
            'RANGO ACAD',
            'DIAS TRAB',
            'CIIU',
            'TAMAÑO CLIENTE',
            'EMP CEDULA',
            'CONTRATO',
            'EMP FECHA INGRESO',
            'EMP FECHA RETIRO',
            'AGENCIA'
        ];
        return $headersr;
    }

    public function getDataDetalleMinisterio(Request $request)
    {
        if ( isset($request->cliente_id) ){
            $cliente = $request->cliente_id;
        }

          $rango = "";
        if($request->rango_fecha != ""){
            $rango = explode(" | ", $request->rango_fecha);
            $fecha_inicio = $rango[0];
            $fecha_final  = $rango[1];
        }

        $formato  = ($request['formato']) ? $request['formato'] : 'html';
        $generar_datos = $request->generar_datos;
        $data="vacio";
        
        if ($rango != "") {

            $data = FirmaContratos::join("requerimientos", "requerimientos.id", "=", "firma_contratos.req_id")
            ->leftjoin('ciudad', function ($join) {
                $join->on('requerimientos.ciudad_id', '=', 'ciudad.cod_ciudad')
                    ->on('requerimientos.departamento_id', '=', 'ciudad.cod_departamento')
                    ->on('requerimientos.pais_id', '=', 'ciudad.cod_pais');
            })
            ->leftjoin("agencias", "agencias.id", "=", "ciudad.agencia")
            ->join("datos_basicos", "datos_basicos.user_id", "=", "firma_contratos.user_id")
            ->leftjoin("generos", "generos.id", "=", "datos_basicos.genero")
            ->leftjoin("requerimiento_contrato_candidato", function ($join) {
                $join->on('firma_contratos.req_id', '=', 'requerimiento_contrato_candidato.requerimiento_id')
                    ->on('firma_contratos.user_id', '=', 'requerimiento_contrato_candidato.candidato_id');
                })
            ->leftjoin("negocio", "negocio.id", "=", "requerimientos.negocio_id")
            ->leftjoin("clientes", "clientes.id", "=", "negocio.cliente_id")
            ->leftJoin("rango_tamanio_cliente", "rango_tamanio_cliente.id", "=", "clientes.tamanio_cliente_id")
            ->leftjoin("cargos_especificos", "cargos_especificos.id", "=", "requerimientos.cargo_especifico_id")
            ->leftjoin("codigos_cno", "codigos_cno.id", "=", "cargos_especificos.codigo_cno_id")
            ->leftJoin("codigos_ciiu", "codigos_ciiu.id", "=", "cargos_especificos.codigo_ciiu_id")
            ->where(function ($sql) use ($fecha_inicio, $fecha_final, $cliente){
                if ($fecha_inicio != "" && $fecha_final != "") {
                    $sql->whereBetween("firma_contratos.created_at", [$fecha_inicio . ' 00:00:00', $fecha_final . ' 23:59:59']);
                }

                if ($cliente != "") {
                    $sql->where("clientes.id", $cliente);
                }
            })
            ->where("firma_contratos.estado", 1)
            ->whereIn("firma_contratos.terminado", [1,2])
            ->whereRaw('requerimiento_contrato_candidato.id=(select max(requerimiento_contrato_candidato.id) from requerimiento_contrato_candidato where requerimiento_contrato_candidato.candidato_id=firma_contratos.user_id AND requerimiento_contrato_candidato.requerimiento_id=firma_contratos.req_id)')
            ->where(function ($query) {
                $ids_clientes_prueba = [];
                if ($this->sinClientesPruebas($ids_clientes_prueba)) {
                    $query->whereNotIn("negocio.cliente_id", $ids_clientes_prueba);
                }
            })
            ->select(
                "datos_basicos.numero_id",
                "generos.descripcion as sexo",
                "requerimientos.id as id_requerimiento",
                "requerimientos.salario as salario",
                "requerimiento_contrato_candidato.fecha_ingreso as fecha_ingreso_req",
                "requerimiento_contrato_candidato.fecha_fin_contrato",
                "cargos_especificos.descripcion as cargo",
                "codigos_cno.codigo as codigo_cno",
                "codigos_ciiu.nombre as codigo_ciiu",
                "rango_tamanio_cliente.descripcion as tamanio_empresa",
                "firma_contratos.id as contrato_id",
                "agencias.descripcion as agencia_req",
                DB::raw('(SELECT rangos.descripcion FROM aspiracion_salarial as rangos 
                        WHERE rangos.active=1 AND requerimientos.salario BETWEEN rangos.limite_inferior AND rangos.limite_superior LIMIT 1) as rango_salario'),
                DB::raw('(SELECT rango_edades.descripcion FROM rango_edades WHERE round(datediff(now(),datos_basicos.fecha_nacimiento)/365)
                        BETWEEN rango_edades.limite_inferior AND rango_edades.limite_superior LIMIT 1 ) as rango_edad'),
                DB::raw('(SELECT niveles_estudios.descripcion FROM estudios INNER JOIN niveles_estudios ON niveles_estudios.id = estudios.nivel_estudio_id
                        WHERE estudios.user_id = datos_basicos.user_id ORDER BY niveles_estudios.jerarquia DESC 
                        LIMIT 1) as rango_academico'),
                DB::raw('(SELECT dt.descripcion FROM rango_dias_trabajados as dt WHERE TIMESTAMPDIFF(DAY, requerimiento_contrato_candidato.fecha_ingreso, now())
                        BETWEEN dt.limite_inferior AND dt.limite_superior LIMIT 1) as dias_trabajados'),
                DB::raw('(SELECT COUNT(*) FROM firma_contratos WHERE requerimiento_contrato_candidato.candidato_id=firma_contratos.user_id 
                        AND firma_contratos.estado = 1 AND firma_contratos.terminado IN(1,2))
                        as cantidad_contratos')
            )
            ->orderBy("firma_contratos.id", "DESC")
            //->orderBy("firma_contratos.user_id")
            ->groupBy("firma_contratos.user_id");
    
        }else if (isset($generar_datos)) {
            session()->flash('mensaje_warning', 'Debe seleccionar un rango de fechas.');
        }
    
            if($data != "vacio" && $data != null){
                if($request['formato'] and ($formato == "xlsx" || $formato == "pdf")){
                    $data = $data->get();
                }else{
                    $data = $data->paginate(10);
                }
            }
            
            return $data;
    }

    public function excel(Request $request)
    {
      $headersr  = $this->getHeaderDetalleMinisterio();
      $data      = $this->getDataDetalleMinisterio($request);
      $formato = $request->formato;

        if ($data == 'vacio') {
            return view('admin.reportes.reporte_ministerio_trabajo.index')->with([
                'data'      => $data,
                'headersr'   => $headersr
            ]);
        }

        $funcionesGlobales = new FuncionesGlobales();
        if(isset($funcionesGlobales->sitio()->nombre)){
            if($funcionesGlobales->sitio()->nombre != ""){
                $nombre = $funcionesGlobales->sitio()->nombre;
            }else{
                $nombre = "Desarrollo";
            }
        }

        Excel::create('reporte-excel-ministerio', function ($excel) use ($data, $headersr, $formato) {
            $excel->setTitle('Reporte Ministerio');
            $excel->setCreator("$nombre")
                ->setCompany("$nombre");
            $excel->setDescription('Reporte Ministerio');
            $excel->sheet('Reporte Ministerio', function ($sheet) use ($data, $headersr, $formato) {
                $sheet->setOrientation("landscape");
                $sheet->loadView('admin.reportes.reporte_ministerio_trabajo.includes.grilla_detalle_ministerio', [
                    'data'    => $data,
                    'headersr' => $headersr,
                    'formato' => $formato,
                ]);
            });
        })->export($formato);
    }

    protected function sinClientesPruebas(&$ids_clientes_prueba) {
        $sitio = Sitio::first();
        if ($sitio->filtro_cliente == 'enabled' && $sitio->clientes_prueba_id != null && $sitio->clientes_prueba_id != '') {
            $ids_clientes_prueba = explode(",", $sitio->clientes_prueba_id);
            return true;
        }
        return false;
    }

    
}
