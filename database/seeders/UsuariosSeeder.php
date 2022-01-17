<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> 'Carlos Arenas Zamora',
            'email'=> 'caz@caz.com',
            'password'=> bcrypt('password')
        ])->assignRole('Admin');

        User::create([
            'name'=> 'Carlos Arenas Zamora',
            'email'=> 'caz1@caz.com',
            'password'=> bcrypt('password')
        ])->assignRole('Normal');

        User::create([
            'name'=> 'Carlos Arenas Zamora',
            'email'=> 'caz2@caz.com',
            'password'=> bcrypt('password')
        ])->assignRole('Normal');


    }
}
