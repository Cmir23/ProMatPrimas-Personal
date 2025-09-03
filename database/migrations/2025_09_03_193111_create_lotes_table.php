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
        // Primero crear tabla Usuario si no existe
        if (!Schema::hasTable('usuario')) {
            Schema::create('usuario', function (Blueprint $table) {
                $table->id('UsuarioId');
                $table->string('nombre', 100);
                $table->string('email', 150)->unique();
                $table->string('telefono', 20)->nullable();
                $table->timestamps();
            });
        }

        // Crear tabla Lote según especificación
        Schema::create('lote', function (Blueprint $table) {
            $table->id('LoteId');
            $table->unsignedBigInteger('UsuarioId');
            $table->string('Nombre', 100);
            $table->string('Ubicacion', 200);
            $table->decimal('Superficie', 10, 2);
            $table->string('Cultivo', 50);
            $table->date('FechaSiembra');
            $table->string('EstadoActual', 50)->default('Sembrado');
            $table->string('ImagenUrl', 250)->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('UsuarioId')->references('UsuarioId')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lote');
        Schema::dropIfExists('usuario');
    }
};