<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpProductosPedido extends Model
{
    protected $table= "tmp_productos_pedidos";

    protected $fillable= [
      'id','producto_id','precio','cantidad','user_id'
    ];
}
