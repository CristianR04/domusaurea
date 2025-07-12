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
        Schema::create('register_owners', function (Blueprint $table) {
            $table->id('id_owner');
            $table->string('tipo_usuario');
            $table->string('usuario');
            $table->string('contrasena');
            $table->string('correo');
            $table->string('tipo_id');
            $table->string('numero_id');
            $table->date('fecha_nacimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_owners');
    }
};
