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
        Schema::create('contract_files', function (Blueprint $table) {
        $table->id('id_archivoC');
        $table->string('nombre'); 
        $table->text('descripcion')->nullable(); 
        $table->string('ruta_archivo'); 
        $table->string('tipo_mime'); 
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_files');
    }
};
