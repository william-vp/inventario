<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesPedidoCredito extends Model
{
	protected $table= "detalles_pedidos_credito";
    protected $fillable = [
        'id','producto_id','credito_id','cantidad','valor_unitario'
    ];
    
}
