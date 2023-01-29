<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\TusDatosKey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ControlFuncionalidad;
use App\Models\EntrevistaVirtual;
use App\Models\LlamadaMensaje;
use App\Models\PruebaIdioma;
use App\Models\TipoFuncionalidadAvanzada;
use App\Models\TrazabilidadFuncionalidad;

class CreditosFuncionalidadesController extends Controller
{
    public function index()
    {
        //
        $empresaFuncionalidades = ControlFuncionalidad::join('tipo_funcionalidad_avanzada', 'tipo_funcionalidad_avanzada.id', '=', 'control_funcionalidad.tipo_funcionalidad')
        ->where('tipo_funcionalidad_avanzada.activo', 1)
        ->select('control_funcionalidad.*','tipo_funcionalidad_avanzada.descripcion as descripcionFuncion')
        ->get();

        $mes = date('n');
        $year = date('Y');

        $consulta_seguridad = TrazabilidadFuncionalidad::whereRaw("MONTH(created_at) = $mes")
        ->whereRaw("YEAR(created_at) = $year")
        ->where('tipo_funcionalidad', 1)
        ->count();

        $consulta_tusdatos = TusDatosKey::whereRaw("MONTH(created_at) = $mes")
        ->whereRaw("YEAR(created_at) = $year")
        ->where('status', 'finalizado')
        ->count();

        $entrevista_virtual = EntrevistaVirtual::whereRaw("MONTH(created_at) = $mes")
        ->whereRaw("YEAR(created_at) = $year")
        ->count();

        $prueba_idioma = PruebaIdioma::whereRaw("MONTH(created_at) = $mes")
        ->whereRaw("YEAR(created_at) = $year")
        ->count();

        $asistente_virtual = LlamadaMensaje::whereRaw("MONTH(created_at) = $mes")
        ->whereRaw("YEAR(created_at) = $year")
        ->count();

        $consumo = [
            1 => $consulta_seguridad,
            2 => $entrevista_virtual,
            4 => $asistente_virtual,
            5 => $prueba_idioma,
            6 => $consulta_tusdatos
        ];

        return view("admin.creditos_funcionalidades.index", compact('empresaFuncionalidades', 'consumo'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, $tipo_id, $control_id, $limite)
    {
        //Obtiene el mes actual.
        $mes = date("n");

        $datosCount = TrazabilidadFuncionalidad::join('control_funcionalidad', 'control_funcionalidad.id', '=', 'trazabilidad_funcionalidades.control_id')
        ->where('control_funcionalidad.tipo_funcionalidad', $tipo_id)
        ->whereMonth('trazabilidad_funcionalidades.created_at', '=', $mes)
        ->select('trazabilidad_funcionalidades.*', 'control_funcionalidad.limite as limite')
        ->count();

        $restantes = $limite - $datosCount;        

        return view("admin.creditos_funcionalidades.show", compact('datosCount','limite','restantes'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
