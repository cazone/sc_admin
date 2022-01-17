<?php

namespace Database\Seeders;

use App\Models\Convenio;
use App\Models\Empresa;
use Illuminate\Database\Seeder;

class Empresas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Empresa::create([
            'nombre' => 'Ci Banco',
        ]);

        Convenio::create([
            'nombre' => 'Quincenal',
            'dispencion' => 2.81,
            'anticipo'=> 6.94

        ]);
        Convenio::create([
            'nombre' => 'Mensual',
            'dispencion' => 2.81,
            'anticipo'=> 6.94

        ]);

      }
}
