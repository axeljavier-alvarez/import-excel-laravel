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
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // 10MB Max
        ]);

        try {
            Excel::import(new PersonasImport, $this->file->getRealPath());
            
            session()->flash('message', '¡Datos importados correctamente!');
            $this->reset('file');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error en la importación: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.upload-excel');
    }
}
