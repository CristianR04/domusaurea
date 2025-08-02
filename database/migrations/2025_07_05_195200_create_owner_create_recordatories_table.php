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
            $table->id('id_recordatorio');

            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_propiedad');

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
