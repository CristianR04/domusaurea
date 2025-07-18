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
        Schema::create('owner__register__properties', function (Blueprint $table) {
            $table->id('id_propiedad');
            //informacion del inmueble
            $table->integer('numero_matricula');
            $table->integer('id_catasrtral');
            $table->string('direccion');
            $table->string('area_terreno');
            $table->string('uso');
            $table->string('estrato');
            $
            //datos propietario
            $table->string('nombre_propietario');
            $table->string('tipo_id');
            $table->integer('numero_id');
            $table->string('estado_civil');
            $table->string('direccion');
            $table->integer('telefono');
            $table->string('correo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner__register__properties');
    }
};
