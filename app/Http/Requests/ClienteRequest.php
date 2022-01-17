<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => ['required', 'string', 'max:70'],
            'apaterno' => ['required', 'string', 'max:70'],
            'amaterno' => ['required', 'string', 'max:20'],
            'clabe' => ['required', 'string', 'max:20'],
            'cuenta' => ['required', 'string', 'max:20'],
            'rfc' => ['required', 'string', 'max:20', ],
            'cuenta' => ['required', 'string', 'max:20'],
            'colonia' => ['required', 'string', 'max:70'],
            'municipio' => ['required', 'string', 'max:70'],
            'estado' => ['required', 'string', 'max:70'],
            'cp' => ['required', 'string', 'max:20'],
            'telefono' => ['required', 'string', 'max:36'],
            'celular' => ['required', 'string', 'max:36'],
            'email' => ['required', 'email', 'max:70'],
            'fecha_ingreso' => ['required', 'string'],
            'empresas_id' => ['required', 'integer' ],
            'convenios_id' => ['required', 'integer' ],

        ];
    }
    public function messages()
    {
        return [
            'paterno.required' => 'El campo apellido paterno es requerido',
            'materno.required' => 'El campo apellido materno es requerido',

        ];
    }
}
