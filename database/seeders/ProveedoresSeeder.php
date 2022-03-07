<?php

namespace Database\Seeders;

use App\Models\Proveedores;
use Illuminate\Database\Seeder;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedores::create([
            'nombre' => 'CVA',
        ]);
        Proveedores::create([
            'nombre' => 'SYSCOM',
        ]);
        Proveedores::create([
            'nombre' => 'Abasteo',
        ]);
        Proveedores::create([
            'nombre' => 'INGRAM',
        ]);
        Proveedores::create([
            'nombre' => 'Mercado Libre',
        ]);
        Proveedores::create([
            'nombre' => 'Amazon',
        ]);
        Proveedores::create([
            'nombre' => 'Exel',
        ]);
        Proveedores::create([
            'nombre' => 'Otro',
        ]);
    }
}
