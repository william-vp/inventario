<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Detalle;
use App\Factura;
use App\Credito;
use App\Caja;
use App\User;
use DB;

class ChartController extends Controller
{
    public function productos_mas_vendidos()
    {
        if (isset($_GET['fechaIni']) and isset($_GET['fechaFin'])){
            $productos= Detalle::select('detalles.producto_id','products.nombre' , DB::raw('SUM(cantidad) as total_ventas') )
            ->join('products','products.id','=','detalles.producto_id')
            ->groupBy('detalles.producto_id','products.nombre')
            ->orderBy('detalles.cantidad', 'DESC')
            ->where('detalles.created_at', '>=', $_GET['fechaIni'])
            ->where('detalles.created_at', '<=', $_GET['fechaFin'])
            ->skip(0)->take(10)
            ->get();
        }else{
            $date= date('Y-m-d');
            $dateI= $date. " 00:00:00";
            $dateF= date('Y-m-d H:i:s');

            $productos= Detalle::select('detalles.producto_id','products.nombre' , DB::raw('SUM(cantidad) as total_ventas') )
            ->join('products','products.id','=','detalles.producto_id')
            ->whereBetween('detalles.created_at', [$dateI, $dateF])
            ->groupBy('detalles.producto_id','products.nombre')
            ->orderBy('detalles.cantidad', 'DESC')
            ->skip(0)->take(10)
            ->get();
        }
        //dd($productos[0]->total_ventas);    

    	return view('charts.productos_mas_vendidos')
    		->with('productos',$productos);
    }

    public function productos_menos_vendidos()
    {
        if (isset($_GET['fechaIni']) and isset($_GET['fechaFin'])){
            /*$productos= Detalle::select('detalles.producto_id','products.nombre' , DB::raw('SUM(cantidad) as total_ventas') )
                ->join('products','products.id','=','detalles.producto_id')
                ->groupBy('detalles.producto_id','products.nombre')
                ->orderBy('detalles.cantidad', 'ASC')
                ->where('detalles.created_at', '>=', $_GET['fechaIni'])
                ->where('detalles.created_at', '<=', $_GET['fechaFin'])
                ->where('detalles.producto_id', null)
                ->skip(0)->take(10)
                ->get();*/

            $productos= Product::select('products.nombre', 'products.id', DB::raw('SUM(cantidad) as total_ventas'))
                ->leftJoin('detalles', 'detalles.producto_id', '=', 'products.id')
                ->where('detalles.producto_id', null)
                ->groupBy('products.id','products.nombre')
                ->orderBy('detalles.cantidad', 'ASC')
                ->skip(0)->take(10)->get();

            dd($productos);
        }else {
            $date = date('Y-m-d');
            $dateI = $date . " 00:00:00";
            $dateF = date('Y-m-d H:i:s');

            $productos= Product::select('products.nombre', 'products.id', DB::raw('SUM(cantidad) as total_ventas'))
                ->leftJoin('detalles', 'detalles.producto_id', 'products.id')
                ->whereNull('detalles.producto_id')
                ->groupBy('products.id','products.nombre')
                ->orderBy('detalles.cantidad', 'ASC')
                ->skip(0)->take(10)->get();

            //dd($productos);
            /*$productos= Detalle::select('detalles.producto_id','products.nombre' , DB::raw('SUM(cantidad) as total_ventas') )
                ->join('products','products.id','=','detalles.producto_id')
                ->whereBetween('detalles.created_at', [$dateI, $dateF])
                ->groupBy('detalles.producto_id','products.nombre')
                ->orderBy('detalles.cantidad', 'ASC')
                ->skip(0)->take(10)
                ->get();*/
        }
        //dd($productos[0]->total_ventas);

        return view('charts.productos_menos_vendidos')
            ->with('productos',$productos);
    }

    public function ventas_creditos()
    {
        if (isset($_GET['fechaIni']) and isset($_GET['fechaFin'])){
            $facturas= Factura::orderBy('id','DESC')
                ->where('facturas.fecha', '>=', $_GET['fechaIni'])
                ->where('facturas.fecha', '<=', $_GET['fechaFin'])
                ->count();

            $creditos= Credito::orderBy('id','DESC')
                ->where('creditos.fecha', '>=', $_GET['fechaIni'])
                ->where('creditos.fecha', '<=', $_GET['fechaFin'])
                ->count();
        }else{
            $date= date('Y-m-d');
            $dateI= $date. " 00:00:00";
            $dateF= date('Y-m-d H:i:s');
            $facturas= Factura::whereBetween('created_at', [$dateI, $dateF])->count();
            $creditos= Credito::whereBetween('created_at', [$dateI, $dateF])->count();
        }

    	return view('charts.ventas_creditos')
    		->with('facturas',$facturas)
    		->with('creditos',$creditos);
    }

    public function utilidad_productos(){
        if (isset($_GET['fechaIni']) and isset($_GET['fechaFin'])){
            $productos= Detalle::select('detalles.producto_id','products.nombre' , DB::raw('SUM(cantidad) as total_ventas'), 'products.precio_compra', 'products.precio_venta' )
                ->join('products','products.id','=','detalles.producto_id')
                ->groupBy('detalles.producto_id','products.nombre','products.precio_compra', 'products.precio_venta')
                ->orderBy('detalles.cantidad', 'DESC')
                ->where('detalles.created_at', '>=', $_GET['fechaIni'])
                ->where('detalles.created_at', '<=', $_GET['fechaFin'])
                ->skip(0)->take(20)
                ->get();
        }else{
            $date= date('Y-m-d');
            $dateI= $date. " 00:00:00";
            $dateF= date('Y-m-d H:i:s');

            $productos= Detalle::select('detalles.producto_id','products.nombre' , DB::raw('SUM(cantidad) as total_ventas'), 'products.precio_compra', 'products.precio_venta' )
                ->join('products','products.id','=','detalles.producto_id')
                ->whereBetween('detalles.created_at', [$dateI, $dateF])
                ->groupBy('detalles.producto_id','products.nombre','products.precio_compra', 'products.precio_venta')
                ->orderBy('detalles.cantidad', 'DESC')
                ->skip(0)->take(20)
                ->get();
        }

        return view('charts.productos_utilidad')
            ->with('productos',$productos);
    }

    public function ventas_mes(){
        if (isset($_GET['fechaIni']) and isset($_GET['fechaFin'])){

            $facturas= Factura::select('facturas.id','facturas.total','facturas.cliente_id','clientes.nombre as nombreCliente')
                ->join('clientes', 'clientes.id','=','facturas.cliente_id')
                ->orderBy('id','DESC')
                ->where('facturas.fecha', '>=', $_GET['fechaIni'])
                ->where('facturas.fecha', '<=', $_GET['fechaFin'])
                ->get();
        }else{
            $date= date('Y-m-d');
            $dateI= $date. " 00:00:00";
            $dateF= date('Y-m-d H:i:s');
            $facturas= Factura::select('facturas.id','facturas.total','facturas.cliente_id','clientes.nombre as nombreCliente')
                ->join('clientes', 'clientes.id','=','facturas.cliente_id')
                ->whereBetween('facturas.created_at', [$dateI, $dateF])->get();
        }

        return view('charts.ventas_mes')
            ->with('ventas',$facturas);

    }

    public function cajas(){
        $cajas = Caja::select('cajas.id','cajas.apertura','cajas.cierre','cajas.base','cajas.total','cajas.user_id','users.name')
                ->join('users', 'users.id','=','cajas.user_id')->orderBy('apertura','ASC')->get();

        return view('charts.cajas')
            ->with('cajas',$cajas);
    }

}
