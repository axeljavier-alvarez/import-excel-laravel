<?php

namespace App\Imports;

use App\Models\Persona;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas; // <--- Importar esto
class PersonasImport implements ToModel, WithHeadingRow, WithCalculatedFormulas // Celdas con logica interna
{
    public function model(array $row)
    {
        // Evita vacios validando campos como código o DPI
        if (!isset($row['codigo']) && !isset($row['dpi_cui'])){
            return null;
        }

        return new Persona([
            'codigo'               => $row['codigo'] ?? null,
            'marca_temporal'       => $row['marca_temporal'] ?? null,
            'dpi_cui'              => $row['dpi_cui'] ?? null,
            'primer_nombre'        => $row['primer_nombre'] ?? null,
            'segundo_nombre'       => $row['segundo_nombre'] ?? null,
            'primer_apellido'      => $row['primer_apellido'] ?? null,
            'segundo_apellido'     => $row['segundo_apellido'] ?? null,
            'telefono_de_contacto' => $row['telefono_de_contacto'] ?? null,
            'correo_electronico'   => $row['correo_electronico'] ?? null,
            'fecha_de_nacimiento'  => $row['fecha_de_nacimiento'] ?? null,
            'edad'                 => isset($row['edad']) ? (int) $row['edad'] : null,
            'sexo'                 => $row['sexo'] ?? null,
            'estado_civil'         => $row['estado_civil'] ?? null,
            'departamento'         => $row['departamento'] ?? null,
            
            // Mapeo dinámico para todas las variantes de columnas de municipio del formulario
            'municipio'            => $row['municipio'] 
                                      ?? $row['municipio_1_6788'] 
                                      ?? $row['municipio_1_6780'] 
                                      ?? $row['municipio_1_6540'] 
                                      ?? $row['municipio_1'] 
                                      ?? null,
                                      
            'zona'                 => $row['zona'] ?? null,
            'colonia_barrio_aldea' => $row['colonia_barrio_o_aldea'] ?? null,
            'direccion'            => $row['direccion_exacta_avenida_calle_casa'] ?? null,
        ]);
    }
}