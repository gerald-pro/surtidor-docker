<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
            'nombre' => 'Extintor pequeño',
            'precio_compra' => '70',
            'precio_venta' => '82',
            'cantidad' => '5',
            'descripcion' => 'Extintor de espuma de 1kg. Ideal para vehiculos',
        ]);

        Producto::create([
            'nombre' => 'Extintor mediano',
            'precio_compra' => '120',
            'precio_venta' => '132',
            'cantidad' => '2',
            'descripcion' => 'Extintor de espuma de 2,5kg. Ideal para vehiculos',
        ]);

        Producto::create([
            'nombre' => 'Limpiador de salpicaderos',
            'precio_compra' => '27',
            'precio_venta' => '34',
            'cantidad' => '10',
            'descripcion' => 'limpiador y protector de interiores de vehiculos',
        ]);

        Producto::create([
            'nombre' => 'Limpiador pequeño de tapicerías',
            'precio_compra' => '24',
            'precio_venta' => '32',
            'cantidad' => '8',
            'descripcion' => 'Eficaz contra las manchas y la suciedad. Este spray le da un aspecto nuevo y brillante a los asientos',
        ]);

        Producto::create([
            'nombre' => 'Limpiador mediano de tapicerías',
            'precio_compra' => '46',
            'precio_venta' => '52',
            'cantidad' => '3',
            'descripcion' => 'Eficaz contra las manchas y la suciedad. Este spray le da un aspecto nuevo y brillante a los asientos',
        ]);

        Producto::create([
            'nombre' => 'Limpiador de vidrios',
            'precio_compra' => '37',
            'precio_venta' => '42',
            'cantidad' => '11',
            'descripcion' => 'Producto formulado con alcohol de grado de perfume para garantizar que siempre reciba el mejor rendimiento de limpieza posible sin el uso de amoníaco, por lo que es seguro para los cristales entintados.',
        ]);

        Producto::create([
            'nombre' => 'Guante pequeño de lavado de microfibra',
            'precio_compra' => '55',
            'precio_venta' => '61',
            'cantidad' => '7',
            'descripcion' => 'Suave con la pintura, resistente con la suciedad.
                            Guante de lavado de autos Chenille hecho con microfibra mezclada 70/30 de primera calidad para una limpieza y limpieza extra suave y sin arañazos',
        ]);

        Producto::create([
            'nombre' => 'Guante grande de lavado de microfibra',
            'precio_compra' => '90',
            'precio_venta' => '100',
            'cantidad' => '6',
            'descripcion' => 'Suave con la pintura, resistente con la suciedad.
                            Guante de lavado de autos Chenille hecho con microfibra mezclada 70/30 de primera calidad para una limpieza y limpieza extra suave y sin arañazos',
        ]);

        Producto::create([
            'nombre' => 'Cargador de celular de 15w',
            'precio_compra' => '40',
            'precio_venta' => '47',
            'cantidad' => '10',
            'descripcion' => 'Cargador de 12v con un puerto usb para vehiculo',
        ]);

        Producto::create([
            'nombre' => 'Cargador de celular de 25w',
            'precio_compra' => '80',
            'precio_venta' => '95',
            'cantidad' => '10',
            'descripcion' => 'Cargador de 25w con dos puertos usb para vehiculo',
        ]);

        Producto::create([
            'nombre' => 'Soporte de celular para auto',
            'precio_compra' => '20',
            'precio_venta' => '26',
            'cantidad' => '9',
            'descripcion' => 'Soporte de plastico de celulares para colocación en el parabrisas',
        ]);

        Producto::create([
            'nombre' => 'Soporte ajustable de celular para auto',
            'precio_compra' => '60',
            'precio_venta' => '73',
            'cantidad' => '4',
            'descripcion' => 'Soporte de metal ajustable de celulares para colocación en el parabrisas',
        ]);

        Producto::create([
            'nombre' => 'Tapete pequeño universal de plastico',
            'precio_compra' => '40',
            'precio_venta' => '50',
            'cantidad' => '4',
            'descripcion' => 'Tapete pequeño de plastico para vehiculo',
        ]);

        Producto::create([
            'nombre' => 'Tapete pequeño universal de goma',
            'precio_compra' => '100',
            'precio_venta' => '115',
            'cantidad' => '6',
            'descripcion' => 'Tapete pequeño universal de goma para vehiculo',
        ]);

        Producto::create([
            'nombre' => 'Tapete mediano universal de plastico',
            'precio_compra' => '70',
            'precio_venta' => '82',
            'cantidad' => '5',
            'descripcion' => 'Tapete mediano de plastico para vehiculo',
        ]);

        Producto::create([
            'nombre' => 'Tapete mediano universal de goma',
            'precio_compra' => '128',
            'precio_venta' => '140',
            'cantidad' => '3',
            'descripcion' => 'Tapete mediano universal de goma para vehiculo',
        ]);

    }
}
