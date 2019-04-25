<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table= "facturas";
    protected $fillable = [
        'id','fecha','observacion','cliente_id','caja_id','subtotal','descuento','iva','total'
    ];
}
