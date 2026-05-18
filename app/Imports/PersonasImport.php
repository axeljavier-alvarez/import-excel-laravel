<?php

namespace App\Imports;

use App\Models\Persona;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class PersonasImport implements ToModel, WithHeadingRow, WithCalculatedFormulas 
{
    public function model(array $row)
    {
        // Evita vacios validando campos como código o DPI
        if (!isset($row['codigo']) && !isset($row['dpi_cui'])){
            return null;
        }

        // FORMATEAR MARCA TEMPORAL (Fecha y Hora)  
        $marcaTemporal = null;
        if (!empty($row['marca_temporal'])) {
            if (is_numeric($row['marca_temporal'])) {
                $marcaTemporal = Date::excelToDateTimeObject($row['marca_temporal'])->format('d/m/Y H:i:s');
            } else {
                $marcaTemporal = $row['marca_temporal'];
            }
        }

        // FORMATEAR FECHA DE NACIMIENTO
        $fechaNacimiento = null;
        if (!empty($row['fecha_de_nacimiento'])) {
            // Si viene como número serial de Excel
            if (is_numeric($row['fecha_de_nacimiento'])) {
                $fechaNacimiento = Date::excelToDateTimeObject($row['fecha_de_nacimiento'])->format('d/m/Y');
            } else {
                // Si viene como texto limpio
                $fechaNacimiento = $row['fecha_de_nacimiento'];
            }
        }
        /**
         * Escáner Dinámico de Columnas Condicionales para Municipio.
         * Recorre todas las columnas de la fila actual buscando variaciones generadas por formularios condicionales.
         */
        $municipioDetectado = null;
        // 1. Recorremos toda la fila actual asociando el nombre de la columna ($columna) con su celda ($valor)
        foreach ($row as $columna => $valor) {            
            // 2. Condición: ¿El nombre de la columna empieza exactamente con la palabra 'municipio'? 
            // Y además, ¿el usuario ingresó algún texto en esa opción específica?
            if (str_starts_with($columna, 'municipio') && !empty($valor)) {                
                // 3. Al encontrar la columna activa, guarda el municipio seleccionado
                $municipioDetectado = $valor;                
                // 4. Detiene el bucle (break) para optimizar memoria al haber hallado la respuesta correcta
                break; 
            }
        }

        return new Persona([
            'codigo'               => $row['codigo'] ?? null,
            'marca_temporal'       => $marcaTemporal,
            'dpi_cui'              => $row['dpi_cui'] ?? null,
            'primer_nombre'        => $row['primer_nombre'] ?? null,
            'segundo_nombre'       => $row['segundo_nombre'] ?? null,
            'primer_apellido'      => $row['primer_apellido'] ?? null,
            'segundo_apellido'     => $row['segundo_apellido'] ?? null,
            'telefono_de_contacto' => $row['telefono_de_contacto'] ?? null,
            'correo_electronico'   => $row['correo_electronico'] ?? null,
            'fecha_de_nacimiento'  => $fechaNacimiento,
            'edad'                 => isset($row['edad']) ? (int) $row['edad'] : null,
            'sexo'                 => $row['sexo'] ?? null,
            'estado_civil'         => $row['estado_civil'] ?? null,
            'departamento'         => $row['departamento'] ?? null,
            'municipio'            => $municipioDetectado, 
            'zona'                 => $row['zona'] ?? null,
            'colonia_barrio_aldea' => $row['colonia_barrio_o_aldea'] ?? null,
            'direccion'            => $row['direccion_exacta_avenida_calle_casa'] ?? null,
        ]);
    }
}