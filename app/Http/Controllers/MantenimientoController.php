<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Database\Eloquent\Builder;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mantenimientos  =  Mantenimiento::with('user', 'cliente')
        ->when(request()->query("id"), function (Builder $builder) {
            $builder->where( 'id', request()->query("id"));
        })
        ->when(request()->query("nombre"), function (Builder $builder) {
            $builder->whereRelation('cliente', DB::raw('CONCAT(nombre, " ",apaterno, " ", apaterno )') , 'LIKE', '%'. request()->query("nombre").'%');
        })
        ->when(request()->query("email"), function (Builder $builder) {
            $builder->whereRelation('cliente', 'email' , 'LIKE', '%'. request()->query("email").'%');
        })
             ->orderBy('updated_at', 'desc')
        ->paginate(10);
        return Inertia::render('Mantenimientos/Index',[
            'mantenimientos' =>  $mantenimientos,
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Mantenimientos/Nuevo',[


        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'serie' => ['required'],
            'marca' => ['required'],
            'modelo' => ['required'],

        ]);

        $mantenimiento = Mantenimiento::create([
            'serie' => $request->serie,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'tipo' => $request->tipo,
            'accesorios' => $request->accesorios,
            'falla' => $request->falla,
            'cliente_id' => $request->cliente_id,
            'observaciones' => $request->observaciones,
            'estatus' => Mantenimiento::ALTA,
            'fecha_alta' => date('Y-m-d'),
        ]);
        return redirect()->route('mantenimientos.index')->with(['success'=> 'Mantenimiento creada con exito. ']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Mantenimiento $mantenimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Mantenimiento $mantenimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        //
    }
    public function dowload ($cotizacion){

        $pdf = \PDF::loadView('pdf.recepcion-equipo', [
            'manto' => Mantenimiento::with('user', 'cliente')->find($cotizacion)
        ]);
        return $pdf->stream('cotizacion.pdf');
    }
}
