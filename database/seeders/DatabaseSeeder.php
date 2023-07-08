<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');

        
        $this->call(PermisosSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(CombustibleSeeder::class);
        \App\Models\Cliente::factory(20)->create();
        \App\Models\Tanque::factory(5)->create(); 
        $this->call(BombaSeeder::class);
        $this->call(UserBombaSeeder::class);
        \App\Models\Vehiculo::factory(100)->create();
        $this->call(ProductoSeeder::class);
        $this->call(PremioSeeder::class);
        $this->call(VentaProductoSeeder::class);
        $this->call(TurnoSeeder::class);
        $this->call(UserTurnoSeeder::class);
        $this->call(VentaCombustibleSeeder::class);
    }
}


