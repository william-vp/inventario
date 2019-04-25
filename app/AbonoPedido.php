<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbonoPedido extends Model
{
    protected $table= "abono_pedidos";
    protected $fillable = [
        'fecha','valor','credito_id','caja_id',
    ];
}

