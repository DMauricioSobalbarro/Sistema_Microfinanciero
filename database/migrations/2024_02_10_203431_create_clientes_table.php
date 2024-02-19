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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();//Autoincrementable
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->string('identidad', 13)->unique();
            $table->string('telefono', 8);
            $table->enum('genero', ['Masculino', 'Femenino','Prefiero no decirlo']);
            $table->string('estado_civil');
            $table->string('ocupacion');
            $table->string('empresa');
            $table->string('ciudad');
            $table->string('foto_perfil');
            $table->enum('estado', ['activo', 'inactivo','suspendido']);
            $table->text('notas')->nullable();
            $table->text('direccion');
            $table->date('fecha_nacimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
