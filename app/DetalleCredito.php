<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCredito extends Model
{
    protected $table= "detalle_creditos";
    protected $fillable = [
        'id','producto_id','credito_id','cantidad','valor_unitario','valor_total'
    ];
}
