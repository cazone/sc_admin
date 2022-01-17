<?php

namespace App\Http\Controllers;

use App\Models\Referencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReferenciaController extends Controller
{
           /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'nombre_completo' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'celular' => 'required',
            'parentesco_id' => ['required', 'string', 'email'],
            'cliente_id' => 'required',
        ]);



      Referencia::create([
            'nombre_completo' => $request['nombre'],
            'email' => $request['email'],
            'telefono' => $request['telefono'],
            'celular' => $request['celular'],
            'parentesco_id' => $request['parentesco_id'],
            'cliente_id' => $request['id'],

        ]);

        return redirect()->back()->with(['success'=> 'Referencia creada.']);

    }
        /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show($referencium)
    {
       return Referencia::with('parentesco')->where('cliente_id','=',$referencium)->get();
    }
       /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $referencia= Referencia::find($id);
        $referencia->delete();
        return redirect()->back()->with(['success'=> 'Referencia eliminado.']);
    }
}
