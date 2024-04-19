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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_usuario');
            $table->string('email_usuario')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('telefono_usuario')->nullable();
            $table->string('tipo_documento_usuario')->unique()->nullable();
            $table->string('password');
            $table->unsignedBigInteger('rol_id')->default(2);
            $table->foreign('rol_id')->references('id')->on('rol_usuarios');
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
