<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant_Create_Recordatories_CxP extends Model
{
     protected $table = 'tenant_create_recordatories_cx_p_s';

    protected $primaryKey = 'id_recordatorioT';

    protected $fillable = [
        'id_inquilino',
        'id_propiedad',
        'concepto',
        'monto',
        'fecha_recordatorio',
        'repetir_mensualmente',
        'notas',
        'visto',
    ];

    protected $casts = [
        'fecha_recordatorio' => 'date',
        'repetir_mensualmente' => 'boolean',
        'visto' => 'boolean',
    ];
}
