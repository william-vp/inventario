<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\Product;
use App\Proveedor;
use App\PedidoCredito;
use App\DetallesPedido;
use App\DetallesPedidoCredito;
use App\TmpProductosPedido;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::select('pedidos.id','pedidos.fecha','pedidos.forma_pago','pedidos.estado_pedido','pedidos.proveedor_id','proveedores.nombre','users.name','pedidos.user_id')
            ->join('users', 'users.id','=','pedidos.user_id')
            ->join('proveedores', 'proveedores.id','=','pedidos.proveedor_id')
            ->where('pedidos.forma_pago','=',1)
            ->orderBy('pedidos.id','DESC')->get();

        $creditos = Pedido::select('pedidos.id','pedidos.fecha','pedidos.forma_pago','pedidos.estado_pedido','pedidos.proveedor_id','proveedores.nombre','users.name','pedidos.user_id', 'pedidos_credito.id as CreditoId')
            ->join('users', 'users.id','=','pedidos.user_id')
            ->join('proveedores', 'proveedores.id','=','pedidos.proveedor_id')
            ->join('pedidos_credito', 'pedidos_credito.pedido_id','=','pedidos.id')
            ->orderBy('pedidos.id','DESC')->get();

        return view('pedidos.index')
            ->with('pedidos',$pedidos)
            ->with('creditos',$creditos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Product::where('estado','=',1)->orderBy('id','DESC')->get();
        $proveedores= Proveedor::all();
        $noP= Pedido::orderBy('id','DESC')->first();
        $noC= PedidoCredito::orderBy('id','DESC')->first();


        return view('pedidos.create')
            ->with("proveedores", $proveedores)
            ->with('productos',$productos)
            ->with("noP", $noP)
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
        $noPedido= Pedido::where('id','=',$request->idPedido)->get();
        if ($noPedido->count() > 0){
            $idPedido= null;
        }else{
            $idPedido= $request->idFac;
        }

        $idProductos= explode(',', $request->ids);
        $cantProductos= explode(',', $request->cants);
        $precioProductos= explode(',', $request->precios);

        $pedido= New Pedido;
        $pedido->id= $idPedido;
        $pedido->fecha= date('Y-m-d H:i:s');
        $pedido->observacion= $request->observacion;
        $pedido->proveedor_id= $request->proveedor;
        $pedido->user_id= Auth()->user()->id;
        $pedido->forma_pago= 1;
        $pedido->subtotal= $request->subtotal;
        $pedido->descuento= $request->descuento;
        $pedido->iva= $request->iva;
        $pedido->total= $request->total;
        $pedido->estado_pedido= '0';

        if ($pedido->save()){
            for ($i= 0; $i < count($idProductos); $i++ ){
                $detalle= New DetallesPedido;
                $detalle->cantidad= $cantProductos[$i];
                $detalle->valor_unitario= $precioProductos[$i];
                $detalle->producto_id= $idProductos[$i];
                $detalle->pedido_id= $pedido->id;
                $detalle->save();
            }

            $productosTmp= TmpProductosPedido::where('user_id','=', Auth()->user()->id)->get();
            foreach($productosTmp as $productos){
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
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $pedido = Pedido::select('pedidos.id','pedidos.fecha','pedidos.forma_pago','pedidos.observacion','pedidos.subtotal','pedidos.iva','pedidos.total','pedidos.user_id','pedidos.descuento','pedidos.proveedor_id','proveedores.nombre as nombreProv','proveedores.telefono','proveedores.direccion')
            ->join('proveedores', 'proveedores.id','=','pedidos.proveedor_id')
            ->where('pedidos.id','=',$id)
            ->orderBy('id','DESC')->firstOrFail();

        $productos= DetallesPedido::select('products.id','products.nombre','categorias.impuesto','products.categoria_id','detalles_pedidos.producto_id','detalles_pedidos.cantidad','detalles_pedidos.valor_unitario')
            ->join('products', 'products.id','=','detalles_pedidos.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('detalles_pedidos.pedido_id','=',$id)->get(); 

        return view('pedidos.show')
            ->with('pedido',$pedido)
            ->with('productos',$productos);
    }


    public function generarPedido($id, $tipo){
        if ($tipo == "contado"){
            $datos = Pedido::select('pedidos.id','pedidos.fecha','pedidos.forma_pago','pedidos.observacion','pedidos.estado_pedido','pedidos.subtotal','pedidos.iva','pedidos.total','pedidos.user_id','pedidos.descuento','pedidos.proveedor_id','proveedores.nombre as nombreProv','proveedores.telefono','proveedores.direccion')
            ->join('proveedores', 'proveedores.id','=','pedidos.proveedor_id')
            ->where('pedidos.id','=',$id)
            ->orderBy('id','DESC')->firstOrFail();
        }else if ($tipo == "credito"){
            $datos = PedidoCredito::select('pedidos_credito.id','pedidos_credito.fecha','pedidos_credito.estado_pedido','pedidos_credito.user_id','pedidos_credito.total','pedidos_credito.observacion','pedidos_credito.estado_credito','pedidos_credito.proveedor_id','proveedores.nombre as nombreProv')
            ->join('proveedores', 'proveedores.id','=','pedidos_credito.proveedor_id')
            ->where('pedidos_credito.id','=',$id)->orderBy('id','DESC')->firstOrFail();
        }else{
            $notification = array(
                    'message' => 'Los parametros enviados son incorrectos.',
                    'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        if ($datos == null){
            $notification = array(
                    'message' => 'Los parametros enviados son incorrectos.',
                    'alert-type' => 'error'
            );
            return back()->with($notification);
        }

         return view('pedidos.generar')
            ->with('pedido',$datos)
            ->with('tipo', $tipo);
    }

    public function realizarPedido(Request $request, $id){
        if($request->_type == "contado"){
            $pedido= Pedido::Find($id);
            $pedido->estado_pedido= 1;

            if ($pedido->save()){
                $productosPedido= DetallesPedido::where('pedido_id','=', $id)->get();
                foreach($productosPedido as $productoPedido){
                    $producto= Product::Find($productoPedido->producto_id);

                    if ($request->ubicar == "0"){
                        //mostrador
                        $actual= $producto->mostrador;
                        $sumar= $productoPedido->cantidad;
                        $nuevaCantidad= $actual + $sumar;
                        $producto->mostrador= $nuevaCantidad;
                        $producto->save();
                    }else{
                        //bodega
                        $actual= $producto->existencias;
                        $sumar= $productoPedido->cantidad;
                        $nuevaCantidad= $actual + $sumar;
                        $producto->existencias= $nuevaCantidad;
                        $producto->save();
                    }
                }
                return ("exito");
            }else{
                return ("error");
            }

        }else if ($request->_type == "credito"){
            $credito= PedidoCredito::Find($id);
            $credito->estado_pedido= 1;

            if ($credito->save()){
                if ($credito->pedido_id != 0){
                    $pedido= Pedido::Find($credito->pedido_id);
                    $pedido->estado_pedido= 1;
                    $pedido->save();
                }

                $productosCredito= DetallesPedidoCredito::where('credito_id','=', $id)->get();
                foreach($productosCredito as $productoCredito){
                    $producto= Product::Find($productoCredito->producto_id);

                    if ($request->ubicar == "0"){
                        //mostrador
                        $actual= $producto->mostrador;
                        $sumar= $productoCredito->cantidad;
                        $nuevaCantidad= $actual + $sumar;
                        $producto->mostrador= $nuevaCantidad;
                        $producto->save();
                    }else{
                        //bodega
                        $actual= $producto->existencias;
                        $sumar= $productoCredito->cantidad;
                        $nuevaCantidad= $actual + $sumar;
                        $producto->existencias= $nuevaCantidad;
                        $producto->save();
                    }
                }
                return ("exito");
            }else{
                return ("error");
            }

        }else{
            $notification = array(
                    'message' => 'Los parametros enviados son incorrectos.',
                    'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        $notification = array(
            'message' => 'Accion no disponible.,',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }
}
