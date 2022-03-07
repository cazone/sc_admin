<?php

namespace App\Http\Controllers;

use App\Models\Cotizaciones;
use App\Models\DetalleCotizacion;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
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
        $clientes = Cotizaciones::with('detalleCotizacion', 'cliente')
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
        return Inertia::render('Cotizaciones/Index',[
            'cotizaciones' =>  $clientes,
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
            return redirect()->back()->with(['message'=> $e->getMessage()]);
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
    public function edit($cotizacione)
    {
        $cotizacion = Cotizaciones::with('detalleCotizacion', 'cliente')->find($cotizacione);

        return Inertia::render('Cotizaciones/Editar',[
            'proveedores'=> Proveedores::all('id','nombre'),
            'cotizacion' => $cotizacion,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cotizaciones  $cotizaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cotizacione)
    {
        try {
            DB::beginTransaction();
            $cotizacion =  Cotizaciones::find($cotizacione);
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
                if($producto['id']){
                    $detalle =  DetalleCotizacion::find($producto['id']);
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
                }else{
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
                foreach ($request->ids_delete as $productoDelete) {

                    if($productoDelete){

                     DetalleCotizacion::where('id','=' ,$productoDelete)->delete();


                    }
                }


            }
            DB::commit();
            return redirect()->route('cotizaciones.index')->with(['success'=> 'Cotizacion creada con exito. ']);

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message'=> $e->getMessage()]);
        }
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
    public function dowload ($cotizacion){

        $pdf = \PDF::loadView('pdf.cotizacion', [
            'cotizacion' => Cotizaciones::with('detalleCotizacion', 'cliente')->find($cotizacion)
        ]);



   return $pdf->stream('cotizacion.pdf');
}
}
