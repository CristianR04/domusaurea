<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner_Register_Tenant extends Model
{
     protected $table = 'owner_register_tenants';

    protected $primaryKey = 'id_Rinquilino';

    protected $fillable = [
        'id_propiedad',
        'id_inquilino',
        'numero_id',
        'usuario',
        'correo',
        'telefono',
    ];
}
