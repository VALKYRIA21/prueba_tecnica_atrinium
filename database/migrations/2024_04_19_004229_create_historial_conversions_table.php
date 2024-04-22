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
        Schema::create('historial_conversions', function (Blueprint $table) {
            $table->id();
            $table->string('moneda_origen');
            $table->string('moneda_destino');
            $table->float('monto_origen');
            $table->float('monto_final');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_conversions');
    }
};
