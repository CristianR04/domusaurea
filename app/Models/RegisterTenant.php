<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class registertenant extends Model
{
protected $fillable = [
"tipo_usuario" ,
"usuario"  ,     
"contrasena" ,   
"correo"  , 
"telefono"  ,  
"tipo_id"  ,     
"numero_id"  ,   
"fecha_nacimiento"
];
}
