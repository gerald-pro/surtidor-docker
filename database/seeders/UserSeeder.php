<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        User::create([
            'name'=>'Cristian Arauz Ramirez',
            'email'=> 'cristhianarauz06@gmail.com',
            'password'=>bcrypt('123456789')
        ])->assignRole('Administrador');
        
        User::create([
            'name'=>'Gerald José',
            'email'=> 'geraldjoseavalosseveriche@gmail.com',
            'password'=>bcrypt('123456789')
        ])->assignRole('Administrador');
        
        User::create([
            'name'=>'Veronica Antezana',
            'email'=> 'ruth.veronica.9906@gmail.com',
            'password'=>bcrypt('123456789')
        ])->assignRole('Administrador');

        User::create([
            'name'=>'Jose Luis Padilla Yapura',
            'email'=> 'jpadillayapura@gmail.com',
            'password'=>bcrypt('211047864')
        ])->assignRole('Administrador');

        User::create([
            'name'=>'Julio Gonzales Estrada',
            'email'=> 'Juliogonzales1302@gmail.com',
            'password'=>bcrypt('123456789')
        ])->assignRole('Administrador');

        //creando usuarios generados
        User::factory(2)->create();
    }
}
