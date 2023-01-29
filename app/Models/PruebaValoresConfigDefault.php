<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaValoresConfigDefault extends Model
{
    protected $table    = 'prueba_valores_1_config_default';
    protected $fillable = [
        'cargo_generico_id',
        'valor_verdad',
        'valor_amor',
        'valor_rectitud',
        'valor_paz',
        'valor_no_violencia',
        'tiempo_maximo',
        'gestiono'
    ];
}
