<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Credito;
use App\Factura;
use App\Product;
use App\Detalle;
use App\TempProducts;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facturas = Factura::select('facturas.id','facturas.estado','facturas.updated_at','facturas.fecha','facturas.forma_pago','facturas.caja_id','facturas.cliente_id','clientes.nombre')
            ->join('clientes', 'clientes.id','=','facturas.cliente_id')
            ->orderBy('id','ASC')->get();

        $creditos = Factura::select('facturas.id','creditos.id as CreditoId','facturas.fecha','facturas.forma_pago','facturas.caja_id','facturas.cliente_id','clientes.nombre')
              ->join('clientes', 'clientes.id','=','facturas.cliente_id')
              ->join('creditos', 'creditos.factura_id','=','facturas.id')
              ->orderBy('id','ASC')->get();

        return view('ventas.index')
            ->with('facturas',$facturas)
            ->with('creditos',$creditos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (session()->get('caja_id') == null){
            $notification = array(
                    'message' => 'Antes de realizar una venta debes abrir la caja.',
                    'alert-type' => 'error'
            );
            return redirect()->action('CajaController@index')->with($notification);
        }

        $productos = Product::where('estado','=',1)->orderBy('id','DESC')->get();
        $clientes= Cliente::all();
        $noF= Factura::orderBy('id','DESC')->first();
        $noC= Credito::orderBy('id','DESC')->first();

        return view('ventas.create')
            ->with("clientes", $clientes)
            ->with('productos',$productos)
            ->with("noF", $noF)
            ->with("noC", $noC);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $noFac= Factura::where('id','=',$request->idFac)->get();
        if ($noFac->count() > 0){
            $idFac= null;
        }else{
            $idFac= $request->idFac;
        }

        $idProductos= explode(',', $request->ids);
        $cantProductos= explode(',', $request->cants);
        $precioProductos= explode(',', $request->precios);

        $factura= New Factura;
        $factura->id= $idFac;
        $factura->fecha= date('Y-m-d H:i:s');
        $factura->observacion= $request->observacion;
        $factura->cliente_id= $request->cliente;
        $factura->caja_id= session()->get('caja_id');
        $factura->forma_pago= 1;
        $factura->subtotal= $request->subtotal;
        $factura->descuento= $request->descuento;
        $factura->iva= $request->iva;
        $factura->total= $request->total;
        $factura->estado= "PAGADA";

        if ($factura->save()){
            for ($i= 0; $i < count($idProductos); $i++ ){
                $total= $cantProductos[$i] * $precioProductos[$i];
                $detalle= New Detalle;
                $detalle->cantidad= $cantProductos[$i];
                $detalle->valor_unitario= $precioProductos[$i];
                $detalle->valor_total= $total;
                $detalle->producto_id= $idProductos[$i];
                $detalle->factura_id= $factura->id;
                $detalle->save();
            }

            $productosCaja= TempProducts::where('caja_id','=', session()->get('caja_id'))->get();
            foreach($productosCaja as $productos){
                $ids[]=$productos->id;
            }
            $eliminados = TempProducts::destroy($ids);

            return ("exito");
        }else{
            return ("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $factura = Factura::select('facturas.id', 'facturas.estado','facturas.updated_at','facturas.fecha','facturas.forma_pago','facturas.observacion','facturas.subtotal','facturas.iva','facturas.total','facturas.caja_id','facturas.descuento','facturas.cliente_id','clientes.nombre as nombreCliente','clientes.telefono','clientes.direccion')
            ->join('clientes', 'clientes.id','=','facturas.cliente_id')
            ->where('facturas.id','=',$id)
            ->orderBy('id','DESC')->firstOrFail();

        $productos= Detalle::select('products.id', 'products.codigo','products.nombre','categorias.impuesto','products.categoria_id','detalles.producto_id','detalles.cantidad','detalles.valor_unitario','detalles.valor_total')
            ->join('products', 'products.id','=','detalles.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('detalles.factura_id','=',$id)->get();

        return view('ventas.show')
            ->with('factura',$factura)
            ->with('productos',$productos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        $notification = array(
            'message' => 'Accion no disponible.,',
            'alert-type' => 'error'
        );
        return back()->with($notification);

        $factura= Factura::find($id);
        if ($factura->delete()){
            $notification = array(
                'message' => 'Factura eliminada.',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Error eliminando factura.,',
                'alert-type' => 'error'
            );
        }

        return back()->with($notification);
    }

    public function anular(Request $request){
        $factura= Factura::Find($request->id);
        //$factura->estado= "ANULADA";

        $productos= Detalle::select('products.id', 'detalles.id as dId','products.nombre','categorias.impuesto','products.categoria_id','detalles.producto_id','detalles.cantidad','detalles.valor_unitario','detalles.valor_total')
            ->join('products', 'products.id','=','detalles.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('detalles.factura_id','=',$request->id)->get();
        foreach($productos as $producto){
            echo $ids[]=$producto->dId;
        }
        //$eliminados= Detalle::destroy($ids);

        if ($factura->save()){
            return ("ok");
        }else{
            return ("error");
        }


    }
}
