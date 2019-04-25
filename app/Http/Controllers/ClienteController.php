<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes= Cliente::orderBy('id','ASC')->get();
        return view('clientes.index')->with('clientes',$clientes);
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
        $numcli = Cliente::where("id","=",$request->id)->count();
        if ($numcli > 0) {
            return ("dup");
        }

        $cliente= new Cliente();
        $cliente->id = $request->id;
        $cliente->nombre = $request->nombre;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;

        if ($cliente->save()){
            return ("exito");
        }else{
            return ("error");
        }
    }

    public function getDataClient(Request $request){
        $cliente= Cliente::where('id','=',$request->id)->firstOrFail();
        return ($cliente);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente= Cliente::find($id);
        return view('clientes.edit')->with('cliente',$cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente= Cliente::find($id);

        if ($cliente->id != $request->id){
            $numcli = Cliente::where("id","=",$request->id)->count();
            if ($numcli > 0) {
                return ("dup");
            }
        }

        $cliente->id = $request->id;
        $cliente->nombre = $request->nombre;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;

        if ($cliente->save()){
            return ("exito");
        }else{
            return ("error");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = array(
            'message' => 'Accion no disponible.,',
            'alert-type' => 'error'
        );
        return back()->with($notification);

        $cliente= Cliente::find($id);
        if ($cliente->delete()){
            $notification = array(
                'message' => 'Proveedor eliminado.',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Error eliminando cliente.,',
                'alert-type' => 'error'
            );
        }

        return back()->with($notification);
    }
}
