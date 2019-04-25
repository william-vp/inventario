<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table= "detalles";
    protected $fillable = [
        'id','producto_id','factura_id','cantidad','valor_unitario','valor_total'
    ];
}
