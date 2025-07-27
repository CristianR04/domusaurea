<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class document_property extends Model
{
     protected $table = 'document_properties';

    protected $primaryKey = 'id_documento';

    protected $fillable = [
    'nombre_original',
     'ruta', 
     'descripcion', 
     'tipo_mime'
    ];

}
