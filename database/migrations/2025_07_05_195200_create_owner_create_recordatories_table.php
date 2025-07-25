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
        Schema::create('owner_create_recordatories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_inquilino')->constrained('inquilinos')->onDelete('cascade');
            $table->foreignId('id_propiedad')->constrained('owner_register_properties')->onDelete('cascade');

            $table->string('concepto'); // Arriendo, servicios, etc.
            $table->decimal('monto', 10, 2)->nullable();
            $table->date('fecha_recordatorio'); // fecha específica que el usuario elige
            $table->boolean('repetir_mensualmente')->default(false); // si se repite cada mes
            $table->text('notas')->nullable(); // descripción opcional

            $table->boolean('visto')->default(false); // si el usuario ya lo vio
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_create_recordatories');
    }
};
