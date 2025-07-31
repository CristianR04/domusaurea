<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner_Payment_Control extends Model
{
    protected $table = 'owner_payment_controls';

    protected $primaryKey = 'id_pagoc';

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

    public function propiedad()
{
    return $this->belongsTo(OwnerRegisterProperty::class, 'id_propiedad');
}

}
