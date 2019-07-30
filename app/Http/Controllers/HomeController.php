<?php

namespace App\Http\Controllers;

use App\Credito;
use App\Factura;
use App\Detalle;
use App\General;
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

    public function getDateSuscription(){
        $date= General::select('end_subscription', 'start_subscription')->limit(1)->orderBy('id','DESC')->first();
        $date_ini= $date->start_subscription;
        $date_end= $date->end_subscription;

        //dd(date_format(date_create($date_ini), ''));
        $fechaIniString= gmmktime(
            date_format(date_create($date_ini), 'g'),
            date_format(date_create($date_ini), 'i'),
            date_format(date_create($date_ini), 's'),
            date_format(date_create($date_ini), 'm'),
            date_format(date_create($date_ini), 'd'),
            date_format(date_create($date_ini), 'Y'));

        $fechaFinString= gmmktime(
            date_format(date_create($date_end), 'g'),
            date_format(date_create($date_end), 'i'),
            date_format(date_create($date_end), 's'),
            date_format(date_create($date_end), 'm'),
            date_format(date_create($date_end), 'd'),
            date_format(date_create($date_end), 'Y'));

        $date_start= date_format(date_create($date_ini), 'g:ia \o\n l jS F Y');
        $date_end= date_format(date_create($date_end), 'g:ia \o\n l jS F Y');

        setlocale(LC_TIME, 'es_ES');
        return ["start_subscription"=> $date_start,
                'end_subscription'=> $date->end_subscription,
                'lc' => setlocale(LC_TIME, 'es_ES'),
                'start_date_string'=> strftime("%A, %d de %B de %Y", $fechaIniString),
                'end_date_string'=> strftime("%A, %d de %B de %Y", $fechaFinString)];
    }

    function currency(Request $request)
    {
        $from= $request->from;
        $to= $request->to;
        $amount= $request->valor;
        $this->leer_archivo($amount, $from, $to);
    }

}
