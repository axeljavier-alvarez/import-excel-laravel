<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = [
        'edad',
        'sexo',
        'estado_civil',
        'departamento',
        'municipio',
        'zona',
        'colonia_barrio_aldea',
        'direccion',
    ];
}
