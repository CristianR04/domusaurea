<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Owner_Register_Property;

class Owner_Register_Contract extends Model
{
     protected $table = 'owner_register_contracts';

    protected $primaryKey = 'id_contrato';

    protected $fillable = [
        'id_propiedad',
        'propietario',
        'inquilino',
        'fecha',
        'detalles',
        'archivo_pdf',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Owner_Register_Property::class, 'id_propiedad', 'id_propiedad');
    }

    
}
