<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roleAdmin = Role::create(['name'=> 'Admin']);
      $roleNormal = Role::create(['name'=> 'Normal']);

      Permission::create(['name' => 'user.index'])->assignRole($roleAdmin);
      Permission::create(['name' => 'user.create'])->assignRole($roleAdmin);
      Permission::create(['name' => 'user.edit'])->assignRole($roleAdmin);
      Permission::create(['name' => 'user.destroy'])->assignRole($roleAdmin);
  

    }
}
