<?php

namespace Database\Seeders;

use App\Models\Clientes;
use App\Models\Empresa;
use Database\Factories\EmpresaFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(ParentescoSeeder::class);
        $this->call(Empresas::class);
        $this->call(RolSeeder::class);
        $this->call(UsuariosSeeder::class);

        Clientes::factory(50)->create();
    }
}
