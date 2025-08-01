<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Owner_Register_Property;

class contract_file extends Model
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
        return $this->belongsTo(Owner_Register_Property::class, 'id_propiedad');
    }
    
}
