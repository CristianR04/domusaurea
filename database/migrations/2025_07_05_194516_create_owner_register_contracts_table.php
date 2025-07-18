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
        Schema::create('owner_register_contracts', function (Blueprint $table) {
            $table->id('id_contrato');
            $table->string('propietario');
            $table->string('inquilino');
            $table->date('fecha');
            $table->text('detalles');
            $table->string('archivo_pdf'); // ruta del archivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_register_contracts');
    }
};
