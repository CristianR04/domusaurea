<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner_Payment_Control extends Model
{
    protected $table = 'tenant_register_payments';

    protected $primaryKey = 'id_pago';

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
