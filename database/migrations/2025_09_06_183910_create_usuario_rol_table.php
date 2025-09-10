<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario_rol', function (Blueprint $table) {
            $table->id('usuario_rol_id');
            $table->foreignId('usuario_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('rol_id')->constrained('rol', 'rol_id')->onDelete('cascade');
            
            $table->unique(['usuario_id', 'rol_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario_rol');
    }
};