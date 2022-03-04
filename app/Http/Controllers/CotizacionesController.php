<?php

namespace App\Http\Controllers;

use App\Models\Cotizaciones;
use App\Models\DetalleCotizacion;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Exception;

class CotizacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Cotizaciones/Index',[
            'cotizaciones' => Cotizaciones::with('detalleCotizacion', 'cliente')->paginate(10),
        ]);


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


        try {
            DB::beginTransaction();
            $cotizacion = new Cotizaciones();
            $cotizacion->subtotal = $request->subtotal;
            $cotizacion->utilidad = $request->utilidad;
            $cotizacion->total = $request->total;
            $cotizacion->iva = $request->iva;
            $cotizacion->estatus = Cotizaciones::COTIZACION;
            $cotizacion->terminos = $request->terminos;
            $cotizacion->fecha = $request->fecha;
            $cotizacion->cliente_id = $request->cliente_id;
            $cotizacion->save();

            foreach ($request->productos as $producto) {

                $detalle = new DetalleCotizacion();
                $detalle->cantidad = $producto['cantidad'];
                $detalle->sku = $producto['sku'];
                $detalle->url_imagen = $producto['url'];
                $detalle->descripcion = $producto['descripcion'];
                $detalle->utilidad = $producto['utilidad'];
                $detalle->precio = $producto['precio'];
                $detalle->iva = $producto['iva'];
                $detalle->isIva = $producto['isIva'];
                $detalle->cotizaciones_id = $cotizacion->id;
                $detalle->proveedores_id = $producto['proveedor'];
                $detalle->save();

            }
            DB::commit();
            return redirect()->route('cotizaciones.index')->with(['success'=> 'Cotizacion creada con exito. ']);

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['success'=> $e->getMessage()]);
            //throw $th;
        }
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
