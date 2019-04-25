<?php

namespace App\Http\Controllers;

use App\UnidadMedida;
use Illuminate\Http\Request;

class UnidadMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades= UnidadMedida::orderBy('id','ASC')->get();
        return view('unidades.index')-> with('unidades',$unidades);
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
        $unidad= new UnidadMedida();
        $unidad->nombre= mb_strtoupper($request->nombre, 'utf-8');

        if ($unidad->save()){
            return ("exito");
        }else{
            return ("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function show(UnidadMedida $unidadMedida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function edit(UnidadMedida $unidadMedida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $unidad= UnidadMedida::find($id);
        $unidad->nombre= mb_strtoupper($request->nombre, 'utf-8');

        if ($unidad->save()){
            return ("exito");
        }else{
            return ("error");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = array(
            'message' => 'Accion no disponible.,',
            'alert-type' => 'error'
        );
        return back()->with($notification);

        $unidad= UnidadMedida::find($id);

        if ($unidad->delete()){
            $notification = array(
                'message' => 'Unidad de Medida eliminada.',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Error eliminando Unidad de Medida.',
                'alert-type' => 'error'
            );
        }

        return back()->with($notification);
    }
}
