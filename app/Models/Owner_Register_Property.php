<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerRegisterProperty extends Model
{
    protected $table = 'owner_register_properties';

    protected $primaryKey = 'id_propiedad';

    protected $fillable = [
        'numero_matricula',
        'id_catastral',
        'direccion_inmueble',
        'area_terreno',
        'uso',
        'estrato',
        'nombre_propietario',
        'tipo_id',
        'numero_id',
        'estado_civil',
        'direccion_propietario',
        'telefono',
        'correo',
    ];
}
