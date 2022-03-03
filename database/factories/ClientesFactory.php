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

            'nombre' => $this->faker->firstName,
            'apaterno' => $this->faker->lastName,
            'amaterno' => $this->faker->lastName,
            'rfc' => $this->faker->swiftBicNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber,
            'celular' => $this->faker->phoneNumber,



        ];
    }

}
