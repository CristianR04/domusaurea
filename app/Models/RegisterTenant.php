<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterTenant extends Model
{
    protected $table = 'register_tenants';

    protected $primaryKey = 'id_tenant';

protected $fillable = [
"tipo_usuario" ,
"usuario"  ,     
"contrasena" ,   
"correo"  , 
"telefono"  ,  
"tipo_id"  ,     
"numero_id"  ,   
"fecha_nacimiento",
"nombre"
];
}
