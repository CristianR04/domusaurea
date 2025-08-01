<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Owner_Register_Property;
use App\Models\User;

class Owner_Create_Recordatory extends Model
{
     protected $table = 'owner_create_recordatories';

    protected $primaryKey = 'id_recordatorio';

    protected $fillable = [
        'id_inquilino',
        'id_propiedad',
        'concepto',
        'monto',
        'fecha_recordatorio',
        'repetir_mensualmente',
        'notas',
        'visto',
    ];

    protected $casts = [
        'fecha_recordatorio' => 'date',
        'repetir_mensualmente' => 'boolean',
        'visto' => 'boolean',
    ];

    public function propiedad()
{
    return $this->belongsTo(Owner_Register_Property::class, 'id_propiedad');
}

public function inquilino()
{
    return $this->belongsTo(User::class, 'id_user');
}

}
