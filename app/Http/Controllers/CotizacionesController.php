<?php

namespace App\Http\Controllers;

use App\Models\Cotizaciones;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CotizacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Cotizaciones/Nuevo',[
            'proveedores'=> Proveedores::all('id','nombre'),
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cotizaciones  $cotizaciones
     * @return \Illuminate\Http\Response
     */
    public function show(Cotizaciones $cotizaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cotizaciones  $cotizaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Cotizaciones $cotizaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cotizaciones  $cotizaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotizaciones $cotizaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cotizaciones  $cotizaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cotizaciones $cotizaciones)
    {
        //
    }
}
