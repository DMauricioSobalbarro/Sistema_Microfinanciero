<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tipo>
 */
class TipoFactory extends Factory
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
            'tipo_prestamo'=>fake()->randomElement
            (['Préstamo Diario','Préstamo Semanal', 'Préstamo Quincenal', 'Préstamo Mensual']),
        ];
    }
}
