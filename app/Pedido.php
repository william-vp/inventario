<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table= "pedidos";
    protected $fillable = [
        'id','fecha','observacion','proveedor_id','user_id','subtotal','descuento','iva','total','estado_pedido','pedido_id'
    ];
}
