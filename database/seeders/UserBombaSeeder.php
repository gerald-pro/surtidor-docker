<?php

namespace Database\Seeders;

use App\Models\UserBomba;
use Illuminate\Database\Seeder;

class UserBombaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserBomba::create([
            'fecha_asignacion' => now(),
            'user_id' => 1,
            'bomba_id' => 1,
        ]);
        UserBomba::create([
            'fecha_asignacion' => now(),
            'user_id' => 2,
            'bomba_id' => 2,
        ]);
        UserBomba::create([
            'fecha_asignacion' => now(),
            'user_id' => 3,
            'bomba_id' => 3,
        ]);
        UserBomba::create([
            'fecha_asignacion' => now(),
            'user_id' => 4,
            'bomba_id' => 4,
        ]);
        UserBomba::create([
            'fecha_asignacion' => now(),
            'user_id' => 5,
            'bomba_id' => 5,
        ]);
    }
}
