<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\product;
use App\Detalle;
use App\DetalleCredito;
use App\DetallesPedidoCredito;
use App\UnidadMedida;
use App\TempProducts;
use App\TmpProductosPedido;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $productos= Product::orderBy('id','ASC')->get();
        return view('productos.index')-> with('productos',$productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias= Categoria::orderBy('id','ASC')->get();
        $unidades= UnidadMedida::orderBy('id','ASC')->get();

        return view('productos.create')
            ->with('categorias',$categorias)
            ->with('unidades',$unidades);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idProducto = Product::where("id","=",$request->id)->count();
        if ($idProducto > 0) {
            return ("dup2");
        }
        $numProducto = Product::where("nombre","=",$request->nombre)->count();
        if ($numProducto > 0) {
            return ("dup");
        }


        $producto= new Product;
        $producto->id = $request->id;
        $producto->nombre = $request->nombre;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->mostrador = $request->mostrador;
        $producto->existencias = $request->existencias;
        $producto->vencimiento = $request->vencimiento;
        $producto->categoria_id = $request->categoria_id;
        $producto->medida_id = $request->medida_id;
        $producto->descripcion = $request->descripcion;
        if ($request->file('imagen') == null){
            $producto->imagen = 'product.png';
        }else{
            $producto->imagen = $request->file('imagen')->store('public/productos');
        }
        $producto->estado = $request->estado;

        if ($producto->save()){
            return ("exito");
        }else{
            return ("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto= Product::find($id);
        $categorias= Categoria::orderBy('id','ASC')->get();
        $unidades= UnidadMedida::orderBy('id','ASC')->get();
        return view('productos.edit')
            ->with('producto',$producto)
            ->with('categorias',$categorias)
            ->with('unidades',$unidades);
    }

    public function traslado($id)
    {
        $producto= Product::find($id);
        return view('productos.traslado')
            ->with('producto',$producto);
    }

    public function guardarTraslado(Request $request, $id){
        $producto= Product::find($id);
        $producto->mostrador= $request->mostrador;
        $producto->existencias= $request->existencias;

        if ($producto->save()){
            return ("exito");
        }else{
            return ("error");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->id != $id){
            $numProducto = Product::where("id","=",$request->id)->count();
            if ($numProducto > 0) {
                return ("dup");
            }
        }

        $producto= Product::find($id);

         if ($request->nombre != $producto->nombre){
            $nomProducto = Product::where("nombre","=",$request->nombre)->count();
            if ($nomProducto > 0) {
                return ("dup2");
            }
        }

        $producto->nombre = $request->nombre;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        //$producto->mostrador = $request->mostrador;
        //$producto->existencias = $request->existencias;
        $producto->vencimiento = $request->vencimiento;
        $producto->categoria_id = $request->categoria_id;
        $producto->descripcion = $request->descripcion;

        if ($request->file('imagen') == null){
            $producto->imagen = 'product.png';
        }else{
            Storage::delete($producto->imagen);
            $producto->imagen = $request->file('imagen')->store('public/productos');
        }
        $producto->medida_id = $request->medida_id;
        $producto->estado = $request->estado;

        if ($producto->save()){
            return ("exito");
        }else{
            return ("error");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = array(
            'message' => 'Accion no disponible.,',
            'alert-type' => 'error'
        );
        return back()->with($notification);

      $exist1= Detalle::where('producto_id','=',$id)->count();

      $exist2= DetalleCredito::where('producto_id','=',$id)->count();

      $exist3= DetallesPedidoCredito::where('producto_id','=',$id)->count();

      if ($exist1 == 0 and $exist2 == 0 and $exist3 == 0){

        $contTemp1= TempProducts::where('producto_id','=', $id)->count();
        if ($contTemp1 > 0){
          $productosT1= TempProducts::where('producto_id','=', $id)->get();
          foreach($productosT1 as $productos){
              $ids1[]=$productos->id;
          }
          $eliminados = TempProducts::destroy($ids1);
        }
        $contTemp2= TmpProductosPedido::where('producto_id','=', $id)->count();
        if ($contTemp2 > 0){
          $productosT2= TmpProductosPedido::where('producto_id','=', $id)->get();
          foreach($productosT2 as $productos){
              $ids2[]=$productos->id;
          }
          $eliminados = TmpProductosPedido::destroy($ids2);
        }

        $producto= Product::find($id);


        if ($producto->delete()){
            $notification = array(
                'message' => 'Producto eliminado.',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Error eliminando producto.,',
                'alert-type' => 'error'
            );
        }
      }else{
        $notification = array(
            'message' => 'No es permitido eliminar este producto.,',
            'alert-type' => 'error'
        );
      }
        return back()->with($notification);
    }

    function changeStatus($id){
        $producto= Product::find($id);

        if ($producto->estado == 1){
            $producto->estado= 0;
        }else{
            $producto->estado= 1;
        }

        if ($producto->save()){
            $notification = array(
                'message' => 'Estado del Producto Cambiado.',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Error cambiando estado del producto.,',
                'alert-type' => 'error'
            );
        }
        return back()->with($notification);
    }
}
