<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'placa' =>  strtoupper($this->faker->unique()->bothify('####???')),
            'tipo' => $this->faker->randomElement(['vagoneta', 'camioneta', 'motocicleta', 'camion', 'automovil']),
            'marca' => $this->faker->randomElement(['toyota', 'nissan', 'mitsubishi', 'susuki', 'honda']),
            'b_sisa' => (bool)random_int(0, 1),
            'cliente_id' => random_int(1,20)
        ];
    }
}
