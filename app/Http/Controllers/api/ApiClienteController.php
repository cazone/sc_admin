<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Http\Resources\ClienteResource;
use App\Models\Clientes;
use Illuminate\Http\Request;

class ApiClienteController extends Controller
{
    public function index()
    {

        //2|1sTVsKpkKV62epKbSoycUAkUeu6o1XL9sO21p5ec
         $clientes    = Clientes::all();
        return ClienteResource::collection($clientes);
    }
}
