<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document_property extends Model
{
    use HasFactory;

    protected $table = 'document_properties';
    protected $primaryKey = 'id_documento';

    protected $fillable = [
        'id_propiedad',
        'nombre_original',
        'ruta',
        'descripcion',
        'tipo_mime',
    ];

    public function propiedad()
{
    return $this->belongsTo(OwnerRegisterProperty::class, 'id_propiedad');
}
}
