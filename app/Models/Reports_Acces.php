<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reports_Acces extends Model
{
    protected $primaryKey = 'id_reportsa';
     protected $fillable = [
        'reporte_id',
        'id_propiedad',
        'archivo_pdf',
    ];
}
