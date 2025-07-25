
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('owner_register_properties', function (Blueprint $table) {
            $table->id('id_propiedad');

            // Información del inmueble
            $table->integer('numero_matricula');
            $table->integer('id_catastral');
            $table->string('direccion_inmueble');
            $table->string('area_terreno');
            $table->string('uso');
            $table->string('estrato');

            // Datos del propietario
            $table->string('nombre_propietario');
            $table->string('tipo_id');
            $table->integer('numero_id');
            $table->string('estado_civil');
            $table->string('direccion_propietario');
            $table->integer('telefono');
            $table->string('correo');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('owner_register_properties');
    }
};
