<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant_Register_Payment extends Model
{
    protected $fillable = [
        'id_propiedad',
        'servicio',
        'concepto',
        'monto',
        'fecha_pago',
        'observaciones',
        'archivo_url',
        'nombre_archivo',
        'tipo_mime',
    ];
}
