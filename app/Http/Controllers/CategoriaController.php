<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias= Categoria::orderBy('id','ASC')->get();
        return view('categorias.index')->with('categorias',$categorias);
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
        $categoria= new Categoria();
        $categoria->nombre= mb_strtoupper($request->nombre, 'utf-8');
        $categoria->impuesto= $request->impuesto;

        if ($categoria->save()){
            return ("exito");
        }else{
            return ("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria= Categoria::find($id);
        $categoria->nombre= mb_strtoupper($request->nombre, 'utf-8');
        $categoria->impuesto= $request->impuesto;

        if ($categoria->save()){
            return ("exito");
        }else{
            return ("error");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = array(
            'message' => 'Accion no disponible.,',
            'alert-type' => 'error'
        );
        return back()->with($notification);

        $categoria= Categoria::find($id);

        if ($categoria->delete()){
            $notification = array(
                'message' => 'Categoria eliminada.',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Error eliminando categoria.,',
                'alert-type' => 'error'
            );
        }

        return back()->with($notification);
    }
}
