<?php

namespace App\Http\Controllers;

use App\Abono;
use App\credito;
use App\DetalleCredito;
use App\Factura;
use App\Detalle;
use Illuminate\Http\Request;

class AbonoController extends Controller
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
    public function create($id)
    {
        if (session()->get('caja_id') == null){
            $notification = array(
                    'message' => 'Antes de realizar un abono debes abrir la caja.',
                    'alert-type' => 'error'
            );
            return redirect()->action('CajaController@index')->with($notification);
        }

        $credito = Credito::select('creditos.id','creditos.fecha','creditos.caja_id','creditos.total','creditos.observacion','creditos.estado','creditos.cliente_id','clientes.nombre')
            ->join('clientes', 'clientes.id','=','creditos.cliente_id')
            ->where('creditos.id','=',$id)->orderBy('id','DESC')->firstOrFail();
        //dd($credito);

        $abonos= Abono::where('credito_id','=',$id)->get();

        return view('abonos.create')
            ->with('credito', $credito)
            ->with('abonos', $abonos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if($request->checkPayAll and $request->checkPayAll == "on"){
            $credito= Credito::find($id);
            $abonos= Abono::where('credito_id','=',$id)->get();

            $rest= 0;
            foreach ($abonos as $ab) {
                $rest+= number_format($ab->valor,'0',',','');
            }
            $totalC= $credito->total;
            $totalC= number_format($totalC,'0',',','');
            $valorRest= $totalC - $rest;

            $abono= new Abono;
            $abono->valor= $valorRest;
            $abono->fecha= date('Y-m-d H:i:s');
            $abono->credito_id= $id;
            $abono->caja_id= session()->get('caja_id');

            if ($abono->save()){
                $noF= Factura::orderBy('id','DESC')->first();
                $factura= New Factura;
                $factura->fecha= date('Y-m-d H:i:s');
                $factura->observacion= $credito->observacion;
                $factura->cliente_id= $credito->cliente_id;
                $factura->caja_id= session()->get('caja_id');
                $factura->forma_pago= 0;
                $factura->subtotal= $credito->subtotal;
                $factura->descuento= 0;
                $factura->iva= $credito->iva;
                $factura->total= $credito->total;
                $factura->save();

                $credito->estado= 1;
                $credito->factura_id= $factura->id;
                $credito->save();

                $detallesCredito= DetalleCredito::where('credito_id','=',$credito->id)->get();
                
                foreach ($detallesCredito as $detalleC) {
                    $total= $detalleC->cantidad * $detalleC->valor_unitario;
                    $detalle= New Detalle;
                    $detalle->id= null;
                    $detalle->cantidad= $detalleC->cantidad;
                    $detalle->valor_unitario= $detalleC->valor_unitario;
                    $detalle->valor_total= $detalleC->valor_total;
                    $detalle->producto_id= $detalleC->producto_id;
                    $detalle->factura_id= $factura->id;
                    $detalle->save();
                }

                return ("exito");
            }else{
                return ("error");
            }


        }else{
            $abono= new Abono;
            $abono->valor= $request->valor_abono;
            $abono->fecha= date('Y-m-d H:i:s');
            $abono->credito_id= $id;
            $abono->caja_id= session()->get('caja_id');

            if ($abono->save()){
                return ("exito");
            }else{
                return ("error");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Abono  $abono
     * @return \Illuminate\Http\Response
     */
    public function show(Abono $abono)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Abono  $abono
     * @return \Illuminate\Http\Response
     */
    public function edit(Abono $abono)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Abono  $abono
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Abono $abono)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Abono  $abono
     * @return \Illuminate\Http\Response
     */
    public function destroy(Abono $abono)
    {
        //
    }
}
