<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ci' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'puntos' => $this->faker->numberBetween(1,99),
            'telefono' => $this->faker->numberBetween(60000000, 79999999),
            'estado' => (bool)random_int(0, 1),
        ];
    }
}
