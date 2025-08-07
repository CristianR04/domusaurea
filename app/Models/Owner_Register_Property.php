<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\document_property;
use App\Models\Owner_Create_Recordatory;
use App\Models\Owner_Payment_Control;

class Owner_Register_Property extends Model
{
    protected $table = 'owner_register_properties';

    protected $primaryKey = 'id_propiedad';

    protected $fillable = [
        'numero_matricula',
        'id_catastral',
        'direccion_inmueble',
        'area_terreno',
        'uso',
        'estrato',
        'nombre_propietario',
        'tipo_id',
        'numero_id',
        'estado_civil',
        'direccion_propietario',
        'telefono',
        'correo',
    ];

    public function documentos()
    {
            return $this->hasMany(document_property::class, 'id_documento');
    }
    public function contratos()
    {
        return $this->hasMany(contract_file::class, 'id_archivoC');
    }
    public function recordatorios()
    {
        return $this->hasMany(Owner_Create_Recordatory::class, 'id_recordatorio');
    }
    public function pagos()
    {
        return $this->hasMany(Owner_Payment_Control::class, 'id_pagoc');
    }
    public function reportes()
{
    return $this->hasMany(Owner_Create_Report::class, 'id_propiedad');
}

}
