<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaCombustibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path('scripts/poblar_ventas_combustible.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
