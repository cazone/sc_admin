<?php

namespace Database\Seeders;

use App\Models\Parentesco;
use Illuminate\Database\Seeder;

class ParentescoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Parentesco::create([
        'nombre' => 'PADRE',
    ]);
    Parentesco::create([
        'nombre' => 'MADRE',
    ]);
    Parentesco::create([
        'nombre' => 'PRIMO',
    ]);
    Parentesco::create([
        'nombre' => 'AMIGO',
    ]);
    Parentesco::create([
        'nombre' => 'VECINO',
    ]);
    }
}
