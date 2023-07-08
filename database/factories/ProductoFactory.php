<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{

    protected $model = Producto::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $precio = random_int(9,350);
        return [
            'nombre' => $this->faker->word(),
            'precio_compra' => $precio,
            'precio_venta' => $precio + ($precio*0.10),
            'cantidad' => random_int(0,50),
            'estado' => true,
            'descripcion' => $this->faker->text(50),
        ];
    }
}
