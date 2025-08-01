<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\contract_file;
use App\Models\Owner_Register_Property;

class Tenant_Contract_Acces extends Model
{
     protected $table = 'tenant_contract_acces';

    protected $primaryKey = 'id_accesC';

 protected $fillable = [
    'contrato_id',
    'propiedad_id',
    'archivo_pdf'
];

public function contrato()
{
    return $this->belongsTo(contract_file::class, 'id_contrato');
}
 public function propiedad()
    {
        return $this->belongsTo(Owner_Register_Property::class, 'id_propiedad');
    }
}
