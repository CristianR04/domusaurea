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
            $table->unsignedBigInteger('id_propiedad');
            $table->string('propietario');
            $table->string('inquilino');
            $table->date('fecha');
            $table->text('detalles');
            $table->string('archivo_pdf');
            $table->timestamps();

            $table->foreign('id_propiedad')
                ->references('id_propiedad')
                ->on('owner_register_properties')
                ->onDelete('cascade');
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
