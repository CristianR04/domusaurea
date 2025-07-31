<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_properties', function (Blueprint $table) {
            $table->id('id_documento');
            $table->unsignedBigInteger('id_propiedad');
            $table->string('nombre_original');
            $table->string('ruta');
            $table->text('descripcion')->nullable();
            $table->string('tipo_mime');
            $table->timestamps();

            $table->foreign('id_propiedad')
                ->references('id_propiedad')
                ->on('owner_register_properties')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_properties');
    }
};
