<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
     protected $fillable = [
        'file_name',
        'total_rows',
        'success_rows',
        'failed_rows',
        'status',
    ];
    
    // Import.php
    public function personas()
    {
        return $this->hasMany(Persona::class);
    }

}
