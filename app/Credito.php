<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    protected $table= "creditos";
    protected $fillable = [
        'id','fecha','observacion','cliente_id','caja_id','subtotal','iva','total'
    ];
}
