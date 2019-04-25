<?php

namespace App\Http\Controllers;

use App\Caja;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->get('caja_id') == null){
            $ultima= Caja::where('cierre','=', null)->where('user_id','=', Auth()->user()->id )->orderBy('id','ASC')->get();
            if ($ultima->count() > 0){
                $cerrar= Caja::find($ultima->last()->id);
                $cerrar->cierre= date('Y-m-d H:i:s');
                $cerrar->save();
            }
        }

        if (Auth()->user()->type == 'USER'){
            $cajas = Caja::select('cajas.id','cajas.apertura','cajas.cierre','cajas.base','cajas.total','cajas.user_id','users.name')
                ->join('users', 'users.id','=','cajas.user_id')
                ->where('user_id','=', Auth()->user()->id )->take(5)->skip(0)->orderBy('id','DESC')->get();
        }else if (Auth()->user()->type == 'ADMIN'){
            $cajas = Caja::select('cajas.id','cajas.apertura','cajas.cierre','cajas.base','cajas.total','cajas.user_id','users.name')
                ->join('users', 'users.id','=','cajas.user_id')->take(5)->skip(0)->orderBy('id','DESC')->get();
        }else if (Auth()->user()->type == 'VENDEDOR'){
            $cajas = Caja::select('cajas.id','cajas.apertura','cajas.cierre','cajas.base','cajas.total','cajas.user_id','users.name')
                ->join('users', 'users.id','=','cajas.user_id')
                ->where('user_id','=', Auth()->user()->id )->take(5)->skip(0)->orderBy('id','DESC')->get();
        }

        $actual = Caja::select('cajas.id','cajas.apertura','cajas.cierre','cajas.descripcion','cajas.base','cajas.total','cajas.user_id','users.name')
            ->join('users', 'users.id','=','cajas.user_id')
            ->where('user_id','=', Auth()->user()->id )->take(1)->orderBy('id','DESC')->get();
            //->last();

        if ($actual->count() == 0){
            $actual->id= 0;
            $actual->cierre= "nulo";
        }else{
            $actual= $actual->last();
        }

        return view('cajas.index')
            ->with('cajas', $cajas)
            ->with('actual', $actual);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($requeste)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session()->forget('caja_id');
        /*$caja= Caja::firstOrCreate([
            'apertura' => date('Y-m-d H:i:s'),
            'base' => $request->base,
            'descripcion' => $request->descripcion,
            'user_id' => Auth::user()->id,
        ]);*/
        $caja= new Caja;
        $caja->apertura= date('Y-m-d H:i:s');
        $caja->base= $request->base;
        $caja->user_id= Auth::user()->id;
        $caja->descripcion= $request->descripcion;


        if ($caja->save()){
            session()->put('caja_id', $caja->id );
            return "exito";
        }else{
            return "error";
        }

    }

    public function close(Request $request, $id){
        $caja= Caja::where('id','=',$id)->firstOrFail();
        $caja->cierre= date('Y-m-d H:i:s');
        $caja->total= $request->total;
        $caja->descripcion= $request->descripcion;
        if ($caja->save()){
            session()->forget('caja_id');
            return ("exito");
        }else{
            return ("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function show(Caja $caja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function edit(Caja $caja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caja $caja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caja $caja)
    {
        $notification = array(
            'message' => 'Accion no disponible.,',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }
}
