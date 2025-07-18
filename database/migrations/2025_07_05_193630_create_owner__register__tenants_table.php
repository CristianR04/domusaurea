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
        Schema::create('owner__register__tenants', function (Blueprint $table) {
            $table->id('id_Rinquilino');
             $table->foreignId('id_propiedad');
            $table->foreignId('id_inquilino');
            $table->integer('numero_id');
            $table->string('usuario');
            $table->string('correo');
            $table->integer('telefono');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner__register__tenants');
    }
};
