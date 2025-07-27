<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner_Register_Contract extends Model
{
     protected $table = 'owner_register_contracts';

    protected $primaryKey = 'id_contrato';

    protected $fillable = [
        'propietario',
        'inquilino',
        'fecha',
        'detalles',
        'archivo_pdf',
    ];
}
