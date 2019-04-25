<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoCredito extends Model
{
    protected $table= "pedidos_credito";
    protected $fillable = [
        'id','fecha','observacion','proveedor_id','user_id','subtotal','descuento','iva','total','estado_credito','estado'
    ];
}
