<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaCompetenciaConfigDefault extends Model
{
    protected $table    = 'prueba_competencias_config_default';
    protected $fillable = [
        'cargo_generico_id',
        'competencia_id',
        'nivel_esperado',
        'nivel_cargo',
        'margen_acertividad'
    ];
}
