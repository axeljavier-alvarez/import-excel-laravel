<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = [
        'codigo',
        'marca_temporal',
        'dpi_cui',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'telefono_de_contacto',
        'correo_electronico',
        'fecha_de_nacimiento',
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
