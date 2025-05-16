<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
///holla mundo
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
            'nombre'=> $this->faker->text(),
            'apellido' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'telefono' => $this->faker->phoneNumber,
            'DNI' => $this->faker->unique()->bothify('########'),
        ];
    }
}
