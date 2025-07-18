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
        Schema::create('document_properties', function (Blueprint $table) {
        $table->id('id_documento');
        $table->string('nombre_original'); 
        $table->string('ruta'); 
        $table->text('descripcion')->nullable(); 
        $table->string('tipo_mime')->nullable(); 
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_properties');
    }
};
