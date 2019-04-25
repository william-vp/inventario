<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesPedido extends Model
{
    protected $table= "detalles_pedidos";
    protected $fillable = [
        'id','producto_id','pedido_id','cantidad','valor_unitario'
    ];
}
