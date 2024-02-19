<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' =>  fake()->firstName()." ".fake()->firstName,
            'apellidos' => fake()->lastName()." ".fake()->lastName,
            'identidad' => fake()->numerify('#############'),
            'telefono'=> fake()->numerify('########'),
            'correo_electronico' => fake()->email,
            'direccion' => fake()->word,
            'fecha_nacimiento' => fake()->date,
            'genero'=>fake()->randomElement(['Femenino', 'Masculino', 'Otro']),
            'estado_civil' => fake()->randomElement(['Casado(a)', 'Soltero(a)', 'Viudo(a)']),
            'estado'=> fake()->randomElement(['Activo', 'Inactivo', 'Suspendido']),
            'fecha_contratacion' => fake()->date,
            'notas' => fake()->word,


        ];
    }
}
