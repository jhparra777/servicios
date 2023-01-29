<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequerimientoContratoCandidato extends Model
{
    protected $table      = 'requerimiento_contrato_candidato';
    protected $fillable   = [
    	'requerimiento_id',
    	'candidato_id',
        'requerimiento_candidato_id',
    	'centro_costo_id',
    	'arl_id',
    	'eps_id',
    	'fondo_pensiones_id',
    	'caja_compensacion_id',
    	'fondo_cesantia_id',
    	'user_gestiono_id',
    	'fecha_ultimo_contrato',
    	'fecha_ingreso',
    	'observaciones',
    	'hora_ingreso',
    	'auxilio_transporte',
    	'nombre_banco',
    	'tipo_cuenta',
    	'numero_cuenta',
    	'fecha_fin_contrato',
		'nivel_5_id',
		'nivel_6_id',
		'nivel_7_id',
		'nivel_8_id',
		'nomina_cliente_id',
		'objeto_contrato_id',
		'subtipo_cotizante_id',
		'tipo_empleado_id',
		'salario',
		'centro_trabajo_id',
		'centro_trabajo',
    	'created_at',
    	'updated_at'
    ];
}
