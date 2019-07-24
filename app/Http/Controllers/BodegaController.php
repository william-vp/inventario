<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Product;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    public function index()
    {
        $bodegas= Bodega::orderBy('id','ASC')->get();

        foreach ($bodegas as $bodega){
            $productos= Product::where('bodega_id', $bodega->id)->count();
            $bodega->cantidad= $productos;
        }
        return view('bodegas.index')->with('bodegas',$bodegas);
    }

    public function store(Request $request)
    {
        $numBodega = Bodega::where("codigo","=",$request->codigo)->count();
        if ($numBodega > 0) {
            return ("dup");
        }

        $bodega= new Bodega;
        $bodega->codigo= $request->codigo;
        $bodega->nombre= mb_strtoupper($request->nombre, 'utf-8');
        $bodega->descripcion= $request->descripcion;

        if ($bodega->save()){
            return ("exito");
        }else{
            return ("error");
        }
    }

    public function update(Request $request, $id)
    {

        $bodega= Bodega::find($id);

        if ($request->codigo != $bodega->codigo){
            $numProducto = Bodega::where("codigo","=",$request->codigo)
                ->where('id','!=', $id)
                ->count();
            if ($numProducto > 0) {
                return ("dup");
            }
        }

        $bodega->codigo= $request->codigo;
        $bodega->nombre= mb_strtoupper($request->nombre, 'utf-8');
        $bodega->descripcion= $request->descripcion;

        if ($bodega->save()){
            return ("exito");
        }else{
            return ("error");
        }
    }

    public function destroy($id)
    {
        $bodega= Bodega::find($id);
        $productos= Product::where('bodega_id', $bodega->id)->count();
        if ($productos > 0){
            $notification = array(
                'message' => 'No es posible eliminar esta bodega. Hay productos asociados.',
                'alert-type' => 'error'
            );
        }else{
            if ($bodega->delete()){
                $notification = array(
                    'message' => 'Bodega eliminada.',
                    'alert-type' => 'success'
                );
            }else{
                $notification = array(
                    'message' => 'Error eliminando Bodega.,',
                    'alert-type' => 'error'
                );
            }
        }
        return back()->with($notification);


    }
}
