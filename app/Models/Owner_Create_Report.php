<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner_Create_Report extends Model
{
    protected $table = 'owner_create_reports';

    protected $primaryKey = 'id_report';

    protected $fillable = [
        // Datos generales
        'id_propiedad',
        'nombre_propiedad',
        'direccion',
        'matricula_inmobiliaria',
        'tipo_propiedad',
        'uso_inmueble',
        'estado',
        'id_inquilino',
        'inquilino',

        // Ingresos
        'arriendo_mensual',
        'estado_pago',

        // Egresos
        'mantenimiento',
        'administracion',
        'impuestos',
        'servicios_publicos',

        // Saldos
        'ingreso_mensual',
        'egreso_mensual',

        // Seguimiento
        'contrato',
        'observaciones',

        // ✅ Ruta del archivo PDF
        'archivo_pdf',
    ];

    public function propiedad()
{
    return $this->belongsTo(Property::class, 'id_propiedad');
}
}
