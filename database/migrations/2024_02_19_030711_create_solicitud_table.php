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
        Schema::create('solicituds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('cliente_id');
            $table->decimal('tasa_interes_solicitado', 5,2);
            $table->decimal('tasa_interes_autorizado', 5,2)->nullable();
            $table->decimal('valor_solicitado', 10,2);
            $table->decimal('valor_autorizado', 10,2)->nullable();
            $table->enum('estado', ['Borrador', 'Solicitud', 'Verificado', 'Autorizado', 'Denegado']);
            $table->date('fecha_solicitud');
            $table->date('fecha_autorizacion')->nullable();
            $table->date('fecha_desembolso')->nullable();
            $table->string('plazo');
            $table->unsignedBigInteger('tipo_prestamo_id');
            $table->decimal('capital_inicial', 10,2);
            $table->decimal('interes_inicial', 10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicituds');
    }
};
