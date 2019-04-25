<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\Factura;
use App\Pedido;
use App\PedidoCredito;
use App\Detalle;
use App\DetallesPedido;
use App\DetalleCredito;
use Dompdf\Options;

class PdfController extends Controller
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


    public function verPDF($factura, $productos, $usuario, $vistaurl)
    {

        $view =  \View::make($vistaurl)
            ->with('factura',$factura)
            ->with('productos',$productos)
            ->with('usuario',$usuario)->render();
        $paper_size = array(0,0,360,360);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('A7','portrait');
        $pdf->loadHTML($view);
        
        return $pdf->stream('Factura de venta No '.$factura->id);
    }

    public function descargarPDF($datos,$vistaurl)
    {

        $data = $datos;
        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('data', 'date'))->render();
        $paper_size = array(0,0,360,360);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('A7','portrait');
        $pdf->loadHTML($view);
        
        return $pdf->download('reporte.pdf');
    }


    public function verFactura($id){

        $vistaurl="pdf.Factura";
        $datos= Factura::find($id);

         $factura = Factura::select('facturas.id','facturas.fecha','facturas.forma_pago','facturas.observacion','facturas.subtotal','facturas.descuento','facturas.iva','facturas.total','facturas.caja_id','facturas.cliente_id','clientes.nombre as nombreCliente','clientes.telefono','clientes.direccion')
            ->join('clientes', 'clientes.id','=','facturas.cliente_id')
            ->where('facturas.id','=',$id)
            ->orderBy('id','DESC')->firstOrFail();

        $usuario= User::select('users.id','users.name')
            ->join('cajas', 'cajas.user_id','=','users.id')
            ->where('cajas.id','=',$factura->caja_id)->firstOrFail();

        $productos= Detalle::select('products.id','products.nombre','categorias.impuesto','products.categoria_id','detalles.producto_id','detalles.cantidad','detalles.valor_unitario','detalles.valor_total')
            ->join('products', 'products.id','=','detalles.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('detalles.factura_id','=',$id)->get(); 
        return $this->verPDF($factura, $productos, $usuario, $vistaurl);
    }

    public function verPedido($id){

        $vistaurl="pdf.pedido";
        $datos= Pedido::find($id);


         $pedido = Pedido::select('pedidos.id','pedidos.fecha','pedidos.forma_pago','pedidos.estado_pedido','pedidos.observacion','pedidos.subtotal','pedidos.descuento','pedidos.iva','pedidos.total','pedidos.user_id','pedidos.proveedor_id','proveedores.nombre as nombreProv','proveedores.telefono','proveedores.direccion')
            ->join('proveedores', 'proveedores.id','=','pedidos.proveedor_id')
            ->where('pedidos.id','=',$id)
            ->orderBy('id','DESC')->firstOrFail();

        $usuario= User::select('users.id','users.name')
            ->where('users.id','=',$pedido->user_id)->firstOrFail();

        $productos= DetallesPedido::select('products.id','products.nombre','categorias.impuesto','products.categoria_id','detalles_pedidos.producto_id','detalles_pedidos.cantidad','detalles_pedidos.valor_unitario')
            ->join('products', 'products.id','=','detalles_pedidos.producto_id')
            ->join('categorias', 'categorias.id','=','products.categoria_id')
            ->where('detalles_pedidos.pedido_id','=',$id)->get(); 
        return $this->verPDF($pedido, $productos, $usuario, $vistaurl);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
