<?php

namespace App\Http\Controllers;

use App\TmpProductosPedido;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class TmpProductosPedidoController extends Controller
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
        //
    }

    public function addProduct(Request $request){
        $exist= TmpProductosPedido::where('producto_id','=',$request->id)
            ->where('user_id','=',Auth()->user()->id )->count();

        if ($exist > 0){
            $tmp= TmpProductosPedido::where('producto_id','=',$request->id)
                ->where('user_id','=',Auth()->user()->id)->firstOrFail();
            $tmp->precio= $request->precio;
            $tmp->cantidad= $request->cantidad;
            $tmp->save();
        }else{
            $tmp= New TmpProductosPedido();
            $tmp->producto_id= $request->id;
            $tmp->precio= $request->precio;
            $tmp->cantidad= $request->cantidad;
            $tmp->user_id= Auth()->user()->id;
            $tmp->save();
        }

        $productosAdds = TmpProductosPedido::select('products.id as idProd','products.nombre','categorias.impuesto','tmp_productos_pedidos.id as idTemp','tmp_productos_pedidos.cantidad','tmp_productos_pedidos.precio')
            ->join('products', 'products.id','=','tmp_productos_pedidos.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('user_id','=', Auth()->user()->id)
            ->orderBy('tmp_productos_pedidos.created_at','ASC')->distinct()->get();

        return ($productosAdds);
    }

    public function editProductTmp(Request $request){
        $tmp= TmpProductosPedido::find($request->id);
        $tmp->cantidad= $request->cantidad;
        $tmp->precio= $request->precio;
        $tmp->save();

        $productosAdds = TmpProductosPedido::select('products.id as idProd','products.nombre','categorias.impuesto','tmp_productos_pedidos.id as idTemp','tmp_productos_pedidos.cantidad','tmp_productos_pedidos.precio')
            ->join('products', 'products.id','=','tmp_productos_pedidos.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('user_id','=', Auth()->user()->id)
            ->orderBy('tmp_productos_pedidos.created_at','ASC')->distinct()->get();

        $producto= Product::find($tmp->producto_id);
        $producto->precio_compra= $request->precio;
        $producto->save();

        return ($productosAdds);
    }


    public function queryProducts(){
        $productosAdds = TmpProductosPedido::select('products.id as idProd','products.nombre','categorias.impuesto','tmp_productos_pedidos.id as idTemp','tmp_productos_pedidos.cantidad','tmp_productos_pedidos.precio')
            ->join('products', 'products.id','=','tmp_productos_pedidos.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('user_id','=', Auth()->user()->id)
            ->orderBy('tmp_productos_pedidos.created_at','ASC')->distinct()->get();
        return ($productosAdds);
    }

    public function removeProduct(Request $request){
        $producto= TmpProductosPedido::find($request->id);
        if ($producto->delete()){
            $productosAdds = TmpProductosPedido::select('products.id as idProd','products.nombre','categorias.impuesto','tmp_productos_pedidos.id as idTemp','tmp_productos_pedidos.cantidad','tmp_productos_pedidos.precio')
                ->join('products', 'products.id','=','tmp_productos_pedidos.producto_id')
                ->join('categorias', 'categorias.id','=','products.categoria_id')
                ->where('user_id','=', Auth()->user()->id)
                ->orderBy('tmp_productos_pedidos.created_at','ASC')->distinct()->get();
            return ($productosAdds);
        }else{
            return ('');
        }
    }

    public function removeAll(Request $request){
        $productosPedido= TmpProductosPedido::where('user_id','=', Auth()->user()->id)->get();
        foreach($productosPedido as $productos){
            $ids[]=$productos->id;
        }
        $eliminados = TmpProductosPedido::destroy($ids);
        if ($eliminados){
            return ("exito");
        }else{
            return ("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TmpProductosPedido  $tmpProductosPedido
     * @return \Illuminate\Http\Response
     */
    public function show(TmpProductosPedido $tmpProductosPedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TmpProductosPedido  $tmpProductosPedido
     * @return \Illuminate\Http\Response
     */
    public function edit(TmpProductosPedido $tmpProductosPedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TmpProductosPedido  $tmpProductosPedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TmpProductosPedido $tmpProductosPedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TmpProductosPedido  $tmpProductosPedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(TmpProductosPedido $tmpProductosPedido)
    {
        //
    }
}
