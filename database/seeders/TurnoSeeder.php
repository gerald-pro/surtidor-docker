<?php

namespace Database\Seeders;

use App\Models\Turno;
use Illuminate\Database\Seeder;

class TurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Turno::create([
            'hora_entrada' =>'08:00:00',
            'hora_salida' => '16:00:00',
            'descripcion' => 'mañana',
        ]);

        Turno::create([
            'hora_entrada' =>'16:00:00',
            'hora_salida' => '00:00:00',
            'descripcion' => 'tarde',
        ]);

        Turno::create([
            'hora_entrada' =>'00:00:00',
            'hora_salida' => '08:00:00',
            'descripcion' => 'noche',
        ]);
    }
}

