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
        Schema::create('tenant_contract_acces', function (Blueprint $table) {
            $table->id('id_accesC');
            $table->unsignedBigInteger('id_contrato');
            $table->unsignedBigInteger('id_propiedad'); 
            $table->string('archivo_pdf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_contract_acces');
    }
};
