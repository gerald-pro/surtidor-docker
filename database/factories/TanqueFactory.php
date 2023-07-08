<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TanqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $capacidad = $this->faker->randomElement(['30000','35000','40000','45000','50000','55000']);
        
        return [
            'codigo' => 'T'.$this->faker->unique()->numberBetween(1, 20),
            'combustible_id' => $this->faker->numberBetween(1,4),
            'descripcion' => $this->faker->text(),
            'capacidad' => $capacidad,
            'cantidad_disponible' => $this->faker->numberBetween(10000,$capacidad),
            'cantidad_min' => $this->faker->numberBetween(10000, $capacidad-10000),
            'estado' => (bool)random_int(0, 1),
        ];
    }
}
