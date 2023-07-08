<?php

namespace Database\Factories;

use App\Models\Cliente_Premio;
use Illuminate\Database\Eloquent\Factories\Factory;

class Cliente_PremioFactory extends Factory
{
    protected $model = Cliente_Premio::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cliente_id' => random_int(1, 30),
            'premio_id' => random_int(1, 5)
        ];
    }
}
