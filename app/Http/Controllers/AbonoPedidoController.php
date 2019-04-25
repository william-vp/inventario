<?php

namespace App\Http\Controllers;

use App\AbonoPedido;
use App\Pedido;
use App\PedidoCredito;
use App\DetallesPedidoCredito;
use App\DetallesPedido;
use Illuminate\Http\Request;

class AbonoPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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

        $credito = PedidoCredito::select('pedidos_credito.id','pedidos_credito.fecha','pedidos_credito.user_id','pedidos_credito.total','pedidos_credito.observacion','pedidos_credito.estado_credito','pedidos_credito.proveedor_id','proveedores.nombre')
            ->join('proveedores', 'proveedores.id','=','pedidos_credito.proveedor_id')
            ->where('pedidos_credito.id','=',$id)->orderBy('id','DESC')->firstOrFail();
        //dd($credito);

        $abonos= AbonoPedido::where('credito_id','=',$id)->get();

        return view('abonos_pedido.create')
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
            $credito= PedidoCredito::find($id);
            $abonos= AbonoPedido::where('credito_id','=',$id)->get();

            $rest= 0;
            foreach ($abonos as $ab) {
                $rest+= number_format($ab->valor,'0',',','');
            }
            $totalC= $credito->total;
            $totalC= number_format($totalC,'0',',','');
            $valorRest= $totalC - $rest;

            $abono= new AbonoPedido;
            $abono->valor= $valorRest;
            $abono->fecha= date('Y-m-d H:i:s');
            $abono->credito_id= $id;
            $abono->caja_id= session()->get('caja_id');

            if ($abono->save()){
                $noF= Pedido::orderBy('id','DESC')->first();
                $pedido= New Pedido;
                $pedido->fecha= date('Y-m-d H:i:s');
                $pedido->observacion= $credito->observacion;
                $pedido->proveedor_id= $credito->proveedor_id;
                $pedido->user_id= Auth()->user()->id;
                $pedido->forma_pago= 0;
                $pedido->subtotal= $credito->subtotal;
                $pedido->descuento= 0;
                $pedido->iva= $credito->iva;
                $pedido->total= $credito->total;
                $pedido->estado_pedido= $credito->estado_pedido;
                $pedido->save();

                $credito->estado_credito= 1;
                $credito->pedido_id= $pedido->id;
                $credito->save();

                $detallesCredito= DetallesPedidoCredito::where('credito_id','=',$credito->id)->get();
                
                foreach ($detallesCredito as $detalleC) {
                    $detalle= New DetallesPedido;
                    $detalle->id= null;
                    $detalle->cantidad= $detalleC->cantidad;
                    $detalle->valor_unitario= $detalleC->valor_unitario;
                    $detalle->producto_id= $detalleC->producto_id;
                    $detalle->pedido_id= $pedido->id;
                    $detalle->save();
                }

                return ("exito");
            }else{
                return ("error");
            }


        }else{
            $abono= new AbonoPedido;
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
     * @param  \App\AbonoPedido  $abonoPedido
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AbonoPedido  $abonoPedido
     * @return \Illuminate\Http\Response
     */
    public function edit(AbonoPedido $abonoPedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AbonoPedido  $abonoPedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AbonoPedido $abonoPedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AbonoPedido  $abonoPedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbonoPedido $abonoPedido)
    {
        //
    }
}
