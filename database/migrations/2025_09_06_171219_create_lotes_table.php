<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Eliminar tabla anterior si existe
        Schema::dropIfExists('lote');
        
        // Crear nueva tabla con estructura del formulario + imagen
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_lote', 50)->unique();
            $table->string('tipo_cultivo', 100);
            $table->string('variedad', 100)->nullable();
            $table->date('fecha_cosecha');
            $table->decimal('cantidad_kg', 10, 2);
            $table->string('ubicacion_origen', 200);
            $table->enum('estado', ['cosechado', 'procesando', 'almacenado', 'entregado']);
            $table->text('observaciones')->nullable();
            $table->string('responsable', 100);
            $table->decimal('precio_kg', 8, 2)->nullable();
            $table->string('imagen_url', 500)->nullable(); // Para app móvil
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};