<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterOwner extends Model
{
     protected $table = 'register_owners';

    protected $primaryKey = 'id_owner';

protected $fillable = [
"tipo_usuario" ,
"usuario"  ,     
"contrasena" ,   
"correo"  ,      
"tipo_id"  ,     
"numero_id"  ,   
"fecha_nacimiento",
"nombre"
];
    

}
