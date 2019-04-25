<?php

namespace App\Http\Controllers;

use App\Credito;
use App\DetalleCredito;
use App\TempProducts;
use App\Abono;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creditos = Credito::select('creditos.id','creditos.factura_id','creditos.fecha','creditos.estado','creditos.caja_id','creditos.cliente_id','clientes.nombre')
            ->join('clientes', 'clientes.id','=','creditos.cliente_id')->orderBy('id','DESC')->get();
        return view('creditos.index')
            ->with('creditos',$creditos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $noCredito= Credito::where('id','=',$request->idCredito)->get();
        if ($noCredito->count() > 0){
            $idCredito= null;
        }else{
            $idCredito= $request->idCredito;
        }

        $idProductos= explode(',', $request->ids);
        $cantProductos= explode(',', $request->cants);
        $precioProductos= explode(',', $request->precios);

        $credito= New Credito;
        $credito->id= $idCredito;
        $credito->fecha= date('Y-m-d H:i:s');
        $credito->observacion= $request->observacion;
        $credito->cliente_id= $request->cliente;
        $credito->caja_id= session()->get('caja_id');
        $credito->subtotal= $request->subtotal;
        $credito->iva= $request->iva;
        $credito->total= $request->total;
        $credito->estado= 0;

        if ($credito->save()){
            for ($i= 0; $i < count($idProductos); $i++ ){
                $total= $cantProductos[$i] * $precioProductos[$i];
                $detalle= New DetalleCredito;
                $detalle->cantidad= $cantProductos[$i];
                $detalle->valor_unitario= $precioProductos[$i];
                $detalle->valor_total= $total;
                $detalle->producto_id= $idProductos[$i];
                $detalle->credito_id= $credito->id;
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
     * @param  \App\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $credito = Credito::select('creditos.id','creditos.fecha','creditos.factura_id','creditos.estado','creditos.observacion','creditos.subtotal','creditos.iva','creditos.total','creditos.caja_id','creditos.cliente_id','clientes.nombre as nombreCliente','clientes.telefono','clientes.direccion')
            ->join('clientes', 'clientes.id','=','creditos.cliente_id')
            ->where('creditos.id','=',$id)
            ->orderBy('id','DESC')->firstOrFail();

        $productos= DetalleCredito::select('products.id','products.nombre','categorias.impuesto','products.categoria_id','detalle_creditos.producto_id','detalle_creditos.cantidad','detalle_creditos.valor_unitario','detalle_creditos.valor_total')
            ->join('products', 'products.id','=','detalle_creditos.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('detalle_creditos.credito_id','=',$id)->get(); 

        $abonos= Abono::where('credito_id','=',$id)->get();

        return view('creditos.show')
            ->with('credito',$credito)
            ->with('productos',$productos)
            ->with('abonos',$abonos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function edit(Credito $credito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credito $credito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = array(
            'message' => 'Accion no disponible.,',
            'alert-type' => 'error'
        );
        return back()->with($notification);

        $productosCredito= DetalleCredito::where('credito_id','=', $id)->get();
            foreach($productosCredito as $productos){
                $ids[]=$productos->id;
            }
        $eliminados = DetalleCredito::destroy($ids);

        $credito= Credito::find($id);
        if ($credito->delete()){
            $notification = array(
                'message' => 'Credito eliminado.',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Error eliminando credito.,',
                'alert-type' => 'error'
            );
        }

        return back()->with($notification);
    }
}
