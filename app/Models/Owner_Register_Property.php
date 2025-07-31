<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function contrato(){
        return $this->belongsTo(contract_file::class, "id_archivoC");
    }

    public function documentos()
    {
        return $this->hasMany(DocumentProperty::class, 'id_propiedad');
    }
  public function contratos()
{
    return $this->hasMany(contract_file::class, 'id_propiedad');
}
 public function recordatorios()
{
    return $this->hasMany(OwnerCreateRecordatory::class, 'id_propiedad');
}
public function pagos()
{
    return $this->hasMany(OwnerPaymentControl::class, 'id_propiedad');
}

}
