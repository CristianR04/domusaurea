<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contract_file extends Model
{
    protected $fillable = [
'nombre',
'descripcion',
'ruta_archivo',
'tipo_mime',
];
}
