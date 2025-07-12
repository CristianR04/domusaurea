<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('owner__create__reports', function (Blueprint $table) {
            $table->id('id_report');
            //Datos Generales de la Propiedad
            $table->string('nombre_propiedad');
            $table->string('direccion');
            $table->string('matricula_inmobiliaria');
            $table->string('tipo_propiedad');
            $table->string('uso_inmueble');
            $table->string('estado');
            $table->integer('id_inquilino');
            $table->string('inquilino');
            // Ingresos
            $table->biginteger('arriendo_mensual');
            $table->string('estado_pago');
            //Egresos
            $table->biginteger('mantenimiento');
            $table->biginteger('administracion');
            $table->biginteger('impuestos');
            $table->biginteger('servicios_publicos');
            //Saldos
            $table->biginteger('ingreso_mensual');
            $table->biginteger('egreso_mensual');
            //Seguimiento
            $table->string('contrato');
            $table->string('impuestos');
            $table->mediumText('observaaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner__create__reports');
    }
};
