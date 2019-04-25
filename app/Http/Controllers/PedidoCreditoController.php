<?php

namespace App\Http\Controllers;

use App\PedidoCredito;
use App\AbonoPedido;
use App\DetallesPedidoCredito;
use App\TmpProductosPedido;
use Illuminate\Http\Request;

class PedidoCreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos_credito = PedidoCredito::select('pedidos_credito.id','pedidos_credito.pedido_id','pedidos_credito.fecha','pedidos_credito.estado_credito','pedidos_credito.estado_pedido','pedidos_credito.user_id','pedidos_credito.proveedor_id','proveedores.nombre','users.name')
            ->join('proveedores', 'proveedores.id','=','pedidos_credito.proveedor_id')
            ->join('users', 'users.id','=','pedidos_credito.user_id')
            ->orderBy('id','DESC')->get();
        return view('pedidos_credito.index')
            ->with('pedidos_credito',$pedidos_credito);
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
        $noCredito= PedidoCredito::where('id','=',$request->idCredito)->get();
        if ($noCredito->count() > 0){
            $idCredito= null;
        }else{
            $idCredito= $request->idCredito;
        }

        $idProductos= explode(',', $request->ids);
        $cantProductos= explode(',', $request->cants);
        $precioProductos= explode(',', $request->precios);

        $credito= New PedidoCredito;
        $credito->id= $idCredito;
        $credito->fecha= date('Y-m-d H:i:s');
        $credito->observacion= $request->observacion;
        $credito->proveedor_id= $request->proveedor;
        $credito->user_id=  Auth()->user()->id;
        $credito->subtotal= $request->subtotal;
        $credito->iva= $request->iva;
        $credito->total= $request->total;
        $credito->estado_credito= 0;
        $credito->estado_pedido= 0;

        if ($credito->save()){
            for ($i= 0; $i < count($idProductos); $i++ ){
                $total= $cantProductos[$i] * $precioProductos[$i];
                $detalle= New DetallesPedidoCredito;
                $detalle->cantidad= $cantProductos[$i];
                $detalle->valor_unitario= $precioProductos[$i];
                $detalle->producto_id= $idProductos[$i];
                $detalle->credito_id= $credito->id;
                $detalle->save();
            }
            $productosCreditoPedido= TmpProductosPedido::where('user_id','=',  Auth()->user()->id)->get();
            foreach($productosCreditoPedido as $productos){
                $ids[]=$productos->id;
            }
            $eliminados = TmpProductosPedido::destroy($ids);

            return ("exito");
        }else{
            return ("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PedidoCredito  $pedidoCredito
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $credito = PedidoCredito::select('pedidos_credito.id','pedidos_credito.fecha','pedidos_credito.pedido_id','pedidos_credito.estado_pedido','pedidos_credito.estado_credito','pedidos_credito.observacion','pedidos_credito.subtotal','pedidos_credito.iva','pedidos_credito.total','pedidos_credito.user_id','pedidos_credito.proveedor_id','proveedores.nombre as nombreCliente','proveedores.telefono','proveedores.direccion')
            ->join('proveedores', 'proveedores.id','=','pedidos_credito.proveedor_id')
            ->where('pedidos_credito.id','=',$id)
            ->orderBy('id','DESC')->firstOrFail();

        $productos= DetallesPedidoCredito::select('products.id','products.nombre','categorias.impuesto','products.categoria_id','detalles_pedidos_credito.producto_id','detalles_pedidos_credito.cantidad','detalles_pedidos_credito.valor_unitario')
            ->join('products', 'products.id','=','detalles_pedidos_credito.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('detalles_pedidos_credito.credito_id','=',$id)->get(); 

        $abonos= AbonoPedido::where('credito_id','=',$id)->get();

        return view('pedidos_credito.show')
            ->with('credito',$credito)
            ->with('productos',$productos)
            ->with('abonos',$abonos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PedidoCredito  $pedidoCredito
     * @return \Illuminate\Http\Response
     */
    public function edit(PedidoCredito $pedidoCredito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PedidoCredito  $pedidoCredito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PedidoCredito $pedidoCredito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PedidoCredito  $pedidoCredito
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = array(
            'message' => 'Accion no disponible.,',
            'alert-type' => 'error'
        );
        return back()->with($notification);

        $productosCredito= DetallesPedidoCredito::where('credito_id','=', $id)->get();
            foreach($productosCredito as $productos){
                $ids[]=$productos->id;
            }
        $eliminados = DetallesPedidoCredito::destroy($ids);

        $credito= PedidoCredito::find($id);
        if ($credito->delete()){
            $notification = array(
                'message' => 'Pedido a Credito eliminado.',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Error eliminando Pedido a credito.',
                'alert-type' => 'error'
            );
        }

        return back()->with($notification);
    }
}
