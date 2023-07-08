<?php

namespace Database\Seeders;

use App\Models\Bomba;
use Illuminate\Database\Seeder;

class BombaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bomba::create([
            'codigo' => 'B1',
            'nombre' => 'Bomba 1',
            'estado' => true,
            'tanque_id' => 1,
        ]);
        Bomba::create([
            'codigo' => 'B2',
            'nombre' => 'Bomba 2',
            'estado' => true,
            'tanque_id' => 1,
        ]);
        Bomba::create([
            'codigo' => 'B3',
            'nombre' => 'Bomba 3',
            'estado' => true,
            'tanque_id' => 2,
        ]);
        Bomba::create([
            'codigo' => 'B4',
            'nombre' => 'Bomba 4',
            'estado' => true,
            'tanque_id' => 3,
        ]);
        Bomba::create([
            'codigo' => 'B5',
            'nombre' => 'Bomba 5',
            'estado' => true,
            'tanque_id' => 3,
        ]);
        Bomba::create([
            'codigo' => 'B6',
            'nombre' => 'Bomba 6',
            'estado' => true,
            'tanque_id' => 4,
        ]);
    }
}
