<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner_Register_Contract extends Model
{
    protected $fillable = [
        'propietario',
        'inquilino',
        'fecha',
        'detalles',
        'archivo_pdf',
    ];
}
