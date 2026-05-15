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
        // Evitar Celdas vacias o campos mal leidos
        if (!isset($row['edad']) || $row['edad'] === null) {
            return null;
        }
        return new Persona([
            'edad'                 => (int) $row['edad'], // Se fuerza edad a  entero
            'sexo'                 => $row['sexo'],
            'estado_civil'         => $row['estado_civil'],
            'departamento'         => $row['departamento'],
            'municipio'            => $row['municipio'] ?? $row['municipio_1_6788'] ?? $row['municipio_1'] ?? null,
            'zona'                 => $row['zona'],
            'colonia_barrio_aldea' => $row['colonia_barrio_o_aldea'],
            'direccion'            => $row['direccion_exacta_avenida_calle_casa'],
        ]);
    }
}