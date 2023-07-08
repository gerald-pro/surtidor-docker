<?php

namespace Database\Seeders;

use App\Models\Premio;
use Illuminate\Database\Seeder;

class PremioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $premio = new Premio();

        $premio->nombre = 'Promo navideña';
        $premio->puntos_requeridos = '500';
        $premio->stock = '20';
        $premio->estado = true;
        $premio->fecha_inicio = '2022-11-01';
        $premio->fecha_fin = '2022-12-01';

        $premio->save();

        $premio = new Premio();

        $premio->nombre = 'Aniversario de la estación';
        $premio->puntos_requeridos = '1000';
        $premio->stock = '10';
        $premio->estado = true;
        $premio->fecha_inicio = '2023-01-10';
        $premio->fecha_fin = '2023-01-28';

        $premio->save();
    }
}
