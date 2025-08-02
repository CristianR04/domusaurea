<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner_Register_Property;
use Illuminate\support\Facades\Validator;

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
    return $this->belongsTo(Owner_Register_Property::class, 'id_propiedad');
}
}
