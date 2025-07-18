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
        Schema::create('owner__payment__controls', function (Blueprint $table) {
             $table->id('id_pago');
            $table->foreignId('id_propiedad')->constrained()->onDelete('cascade');

            $table->string('servicio')->nullable();           // agua, luz, etc.
            $table->string('concepto')->nullable();           // "Pago de julio"
            $table->decimal('monto', 10, 2);
            $table->date('fecha_pago');           
            $table->text('observaciones')->nullable();

            // Soporte (1 solo archivo por pago)
            $table->string('archivo_url')->nullable();        // URL pública
            $table->string('nombre_archivo')->nullable();     // nombre original
            $table->string('tipo_mime')->nullable();          // tipo MIME

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner__payment__controls');
    }
};
