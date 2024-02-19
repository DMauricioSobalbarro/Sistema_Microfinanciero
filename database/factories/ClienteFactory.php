<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombres' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'identidad' => $this->faker->unique()->regexify('[0-9]{13}'),
            'telefono' => $this->faker->numerify('########'),
            'genero' => $this->faker->randomElement(['masculino', 'femenino']),
            'estado_civil' => $this->faker->randomElement(['soltero', 'casado', 'divorciado', 'viudo']),
            'ocupacion' => $this->faker->jobTitle,
            'empresa' => $this->faker->company,
            'ciudad' => $this->faker->city,
            'foto_perfil' => $this->faker-> imageUrl(640, 480), //
            'estado' => $this->faker->randomElement(['activo', 'inactivo', 'suspendido']),
            'notas' => $this->faker->text,
            'direccion' => $this->faker->address,
            'fecha_nacimiento' => $this->faker->date,
        ];
    }
}
