<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Clientes;
use App\Models\Convenio;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Clientes::query()
        ->filter(request()->only("search"))
        ->orderBy('created_at', 'desc')
        ->paginate(8);
        return Inertia::render('Clientes/Index',[
          'clientes'=>$clientes

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return Inertia::render('Clientes/Nuevo',[
            'empresas' => [],
            'convenios' => [],

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {

        $Cliente = Clientes::create($request->all());
        return redirect()->route('clientes.index')->with(['success'=> 'Cliente '. $Cliente->nombre . ' creado con exito. ']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show($clientes)
    {
        return  Clientes::with('convenio')->where( DB::raw( 'CONCAT(nombre, " ", apaterno, " ", amaterno)' ), 'LIKE', '%'. $clientes .'%')
        ->orWhere('num_empleado', 'LIKE', '%'. $clientes.'%')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($cliente)
    {

        return Inertia::render('Clientes/Editar',[
            'empresas' => [],
            'cliente' => Clientes::findOrFail($cliente),
            'convenios' => [],

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, $cliente)
    {
      $updateCliente =  Clientes::findOrFail($cliente);
      $updateCliente->update($request->all());
      return redirect()->route('clientes.index')->with(['success'=> 'Cliente '. $updateCliente->nombre . ' actualizado con exito. ']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente= Clientes::find($id);
        $cliente->delete();
        return redirect()->back()->with(['success'=> 'Cliente eliminado.']);
    }
}
