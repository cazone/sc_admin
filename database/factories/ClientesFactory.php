<?php

namespace Database\Factories;

use App\Models\Clientes;
use App\Models\Convenio;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientesFactory extends Factory
{
    protected $model = Clientes::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'empresas_id' => Empresa::all()->first()->id,
            'nombre' => $this->faker->name,
            'apaterno' => $this->faker->lastName,
            'amaterno' => $this->faker->lastName,
            'rfc' => $this->faker->swiftBicNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber,
            'celular' => $this->faker->phoneNumber,
            'clabe' => $this->faker->swiftBicNumber,
            'calle' => $this->faker->streetName,
            'colonia' => $this->faker->streetName,
            'estado' => $this->faker->state,
            'municipio' => $this->faker->city,
            'cp' => $this->faker->postcode,
            'fecha_ingreso' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'cuenta'=> $this->faker->creditCardNumber,
            'sucursal'=> $this->faker->numberBetween(1, 10),
            'id_user_alta'=>  User::all()->random(1)->first()->id,
            'id_user_mod'=> User::all()->random(1)->first()->id,
            'num_empleado'=> $this->faker->userName,
            'convenios_id' => Convenio::all()->first()->id, 

        ];
    }
  
}
