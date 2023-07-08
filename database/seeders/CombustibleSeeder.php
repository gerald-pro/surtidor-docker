<?php

namespace Database\Seeders;

use App\Models\Combustible;
use Illuminate\Database\Seeder;

class CombustibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $combustible = new Combustible();
        $combustible->nombre = 'Gasolina premium';
        $combustible->tipo = 'gasolina';
        $combustible->precio_compra = 4;
        $combustible->precio_venta = 5;
        $combustible->save();

        $combustible = new Combustible();
        $combustible->nombre = 'Gasolina especial';
        $combustible->tipo = 'gasolina';
        $combustible->precio_compra = 3;
        $combustible->precio_venta = 4;
        $combustible->save();

        $combustible = new Combustible();
        $combustible->nombre = 'Etanol';
        $combustible->tipo = 'etanol';
        $combustible->precio_compra = 5.2;
        $combustible->precio_venta = 6.1;
        $combustible->save();

        $combustible = new Combustible();
        $combustible->nombre = 'Diesel oil';
        $combustible->tipo = 'diesel';
        $combustible->precio_compra = 4.5;
        $combustible->precio_venta = 5.2;
        $combustible->save();
    }
}
