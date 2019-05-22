<?php

namespace App\Http\Controllers;

use App\Credito;
use App\Factura;
use App\Detalle;
use App\PedidoCredito;
use App\Product;
use App\Pedido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input; 

use App\Product as Producto;
use App\User as User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$producto= Product::all()->count();
        $user= User::all()->count();

        $date= date('Y-m-d');
        $dateI= $date. " 00:00:00";
        $dateF= date('Y-m-d H:i:s');
        $ventasContado= Factura::whereBetween('created_at', [$dateI, $dateF])->count();
        $ventasCredito= Credito::whereBetween('created_at', [$dateI, $dateF])->count();
        $ventas= $ventasContado + $ventasCredito;
        $pedidosContado= Pedido::whereBetween('created_at', [$dateI, $dateF])->count();
        $pedidosCredito= PedidoCredito::whereBetween('created_at', [$dateI, $dateF])->count();
        $pedidos= $pedidosContado + $pedidosCredito;
	        $agregados= Product::select('products.id','products.nombre','products.imagen')
	        ->orderBy('products.created_at','DESC')->take(5)->skip(0)->distinct()->get(); 
	            

        return view('index')
            ->with('usuarios',$user)
            ->with('producto',$producto)
            ->with('ventas',$ventas)
            ->with('agregados',$agregados)
            ->with('pedidos',$pedidos);
    }


    function currency(Request $request)
    {
        $from= $request->from;
        $to= $request->to;
        $amount= $request->valor;
        $this->leer_archivo($amount, $from, $to);
    }

}
