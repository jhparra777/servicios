<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaLogo extends Model
{
    //
    protected $table    = 'empresa_logos';
    protected $fillable = [
    	"nombre_empresa",
        "codigo",
    	"nit",
    	"direccion",
    	"ciudad",
    	"telefono",
    	"logo",
        "representante",
        "cedula",
        "firma",
        "web_corporativa",
        "email_corporativo"
    ];
}
