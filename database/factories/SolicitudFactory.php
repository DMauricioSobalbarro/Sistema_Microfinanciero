<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Solicitud>
 */
class SolicitudFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'cliente_id'=>fake()->regexify('[0-9]{13}'),
            'empleado_id'=>fake()->regexify('[0-9]{13}'),
            'tasa_interes_solicitado' => fake()->randomFloat(2, 0, 100),
            'tasa_interes_autorizado' => fake()->randomFloat(2, 0, 100),
            'valor_solicitado' => fake()->randomFloat(2, 0, 10000),
            'valor_autorizado' => fake()->randomFloat(2, 0, 10000),
            'estado' => fake()->randomElement(['Borrador', 'Solicitud', 'Verificado', 'Autorizado', 'Denegado']),
            'fecha_solicitud' => fake()->date(),
            'fecha_autorizacion' => fake()->date(),
            'fecha_desembolso' => fake()->date(),
            'plazo' => fake()->word(),
            'tipo_prestamo_id' => fake()->numberBetween(1,4),
            'capital_inicial' => fake()->randomFloat(2, 0, 10000),
            'interes_inicial' => fake()->randomFloat(2, 0, 1000),
        ];
    }
}
