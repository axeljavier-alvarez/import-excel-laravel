<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\PersonasImport;
use Maatwebsite\Excel\Facades\Excel;

class UploadExcel extends Component
{
    use WithFileUploads;

    public $file;

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ], [
            'file.required' => 'Por favor, seleccione un archivo antes de continuar.',
            'file.mimes'    => 'El archivo debe ser un formato válido de Excel (.xlsx, .xls) o CSV.',
            'file.max'      => 'El archivo es demasiado grande. El límite permitido es de 10 MB.',
        ]);

        try {

            Excel::import(new PersonasImport, $this->file->getRealPath());

            session()->flash(
                'message',
                '¡Excelente! Los datos de los vecinos se han importado y estructurado correctamente.'
            );

            $this->reset('file');

        } catch (\Maatwebsite\Excel\Exceptions\NoTypeDetectedException $e) {

            session()->flash(
                'error',
                'No se pudo detectar el tipo de archivo. Asegúrese de que no esté corrupto.'
            );

        } catch (\Exception $e) {

            $errorMensaje = $e->getMessage();

            if (str_contains($errorMensaje, 'Duplicate entry')) {
                $errorMensaje = 'Se encontraron registros duplicados (DPI o códigos repetidos) que violan las restricciones del sistema.';
            }

            session()->flash(
                'error',
                'Error en la importación: ' . $errorMensaje
            );
        }
    }

    public function render()
    {
        return view('livewire.upload-excel');
    }

    public function removeFile()
    {
        $this->reset('file');
    }

}