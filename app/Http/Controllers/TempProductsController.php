<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Contracts\Session\Session;
use App\Caja;
use App\TempProducts;
use Illuminate\Http\Request;


class TempProductsController extends Controller
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

    public function addProduct(Request $request)
    {
        $exist= TempProducts::where('producto_id','=',$request->id)
            ->where('caja_id','=',session()->get('caja_id'))->count();

        if ($exist > 0){
            $tmp= TempProducts::where('producto_id','=',$request->id)
                ->where('caja_id','=',session()->get('caja_id'))->firstOrFail();
            $tmp->precio= $request->precio;
            $tmp->cantidad= $request->cantidad;
            $tmp->save();
        }else{
            $tmp= New TempProducts();
            $tmp->producto_id= $request->id;
            $tmp->precio= $request->precio;
            $tmp->cantidad= $request->cantidad;
            $tmp->caja_id= session()->get('caja_id');
            $tmp->save();
        }

        $productosAdds = TempProducts::select('products.id as idProd', 'products.codigo','products.nombre','categorias.impuesto','temp_products.id as idTemp','temp_products.cantidad','temp_products.precio')
            ->join('products', 'products.id','=','temp_products.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('caja_id','=',session()->get('caja_id'))
            ->orderBy('temp_products.created_at','ASC')->distinct()->get();

        return ($productosAdds);
    }

    public function editProductTmp(Request $request)
    {
        $tmp= TempProducts::find($request->id);
        $tmp->cantidad= $request->cantidad;
        $tmp->save();

        $productosAdds = TempProducts::select('products.id as idProd','products.codigo','products.nombre','categorias.impuesto','temp_products.id as idTemp','temp_products.cantidad','temp_products.precio')
            ->join('products', 'products.id','=','temp_products.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('caja_id','=',session()->get('caja_id'))
            ->orderBy('temp_products.created_at','ASC')->distinct()->get();
        return ($productosAdds);
    }

    public function removeProduct(Request $request){
        $producto= TempProducts::find($request->id);
        if ($producto->delete()){
            $productosAdds = TempProducts::select('products.id as idProd','products.codigo','products.nombre','categorias.impuesto','temp_products.id as idTemp','temp_products.cantidad','temp_products.precio')
                ->join('products', 'products.id','=','temp_products.producto_id')
                ->join('categorias', 'categorias.id','=','products.categoria_id')
                ->where('caja_id','=', $request->caja_id)
                ->orderBy('temp_products.created_at','ASC')->distinct()->get();
            return ($productosAdds);
        }else{
            return ('');
        }
    }

    public function removeAll(Request $request){
        $productosCaja= TempProducts::where('caja_id','=', $request->caja_id)->get();

        foreach($productosCaja as $productos){
            $ids[]=$productos->id;
        }
        $eliminados = TempProducts::destroy($ids);
        if ($eliminados){
            return ("exito");
        }else{
            return ("error");
        }
    }

    public function queryProducts(){
        $productosAdds = TempProducts::select('products.id as idProd','products.codigo','products.nombre','categorias.impuesto','temp_products.id as idTemp','temp_products.cantidad','temp_products.precio')
            ->join('products', 'products.id','=','temp_products.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('caja_id','=',session()->get('caja_id'))
            ->orderBy('temp_products.created_at','ASC')->distinct()->get();
        return ($productosAdds);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\TempProducts  $tempProducts
     * @return \Illuminate\Http\Response
     */
    public function show(TempProducts $tempProducts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TempProducts  $tempProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(TempProducts $tempProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TempProducts  $tempProducts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TempProducts $tempProducts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TempProducts  $tempProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(TempProducts $tempProducts)
    {
        //
    }
}
