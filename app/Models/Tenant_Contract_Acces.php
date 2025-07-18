<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant_Contract_Acces extends Model
{
 protected $fillable = [
    'contrato_id',
    'propiedad_id',
    'archivo_pdf'
];
}
