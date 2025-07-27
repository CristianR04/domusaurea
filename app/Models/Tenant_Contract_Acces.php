<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant_Contract_Acces extends Model
{
     protected $table = 'tenant_contract_acces';

    protected $primaryKey = 'id_accesC';

 protected $fillable = [
    'contrato_id',
    'propiedad_id',
    'archivo_pdf'
];
}
