<?php

namespace Database\Seeders;

use App\Models\UserTurno;
use Illuminate\Database\Seeder;

class UserTurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserTurno::create([
            'user_id' =>'1',
            'turno_id' => '1',
        ]); 

        UserTurno::create([
            'user_id' =>'2',
            'turno_id' => '2',
        ]); 

        UserTurno::create([
            'user_id' =>'3',
            'turno_id' => '3',
        ]);

        UserTurno::create([
            'user_id' =>'4',
            'turno_id' => '1',
        ]);

        UserTurno::create([
            'user_id' =>'5',
            'turno_id' => '2',
        ]);
    }
}


