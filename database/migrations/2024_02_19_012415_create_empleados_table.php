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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->string('identidad', 13)->unique();
            $table->string('telefono', 8)->unique();
            $table->string('correo_electronico')->unique();
            $table->text('direccion');
            $table->date('fecha_nacimiento');
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro']);
            $table->enum('estado_civil', ['Casado(a)', 'Soltero(a)', 'Viudo(a)']);
            $table->string('foto_perfil')->nullable();
            $table->enum('estado', ['Activo', 'Inactivo', 'Suspendido']);
            $table->date('fecha_contratacion')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
