<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner_Create_Report extends Model
{
protected $primaryKey = "id_report ";

    protected $fillable = [  
 //Datos Generales de la Propiedad 
"nombre_propiedad",
"direccion",
"matricula_inmobiliaria",
"tipo_propiedad",
"uso_inmueble",
"estado",
"id_inquilino",
"inquilino",
 // Ingresos
"arriendo_mensual",
"estado_pago",
  //Egresos
"mantenimiento",
"administracion",
"impuestos",
"servicios_publicos",
 //Saldos
"ingreso_mensual",
"egreso_mensual",
//Seguimiento
"contrato",
"impuestos",
"observaaciones"
    ];
}
