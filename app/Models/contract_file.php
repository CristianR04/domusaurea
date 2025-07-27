<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contract_files';
    protected $primaryKey = 'id_archivoC';

    protected $fillable = [
        'id_propiedad',
        'nombre',
        'descripcion',
        'ruta_archivo',
        'tipo_mime',
    ];

    public function propiedad()
    {
        return $this->belongsTo(OwnerRegisterProperty::class, 'id_propiedad');
    }
}
