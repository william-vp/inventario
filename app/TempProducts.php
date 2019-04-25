<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempProducts extends Model
{
    protected $table= "temp_products";

    protected $fillable= [
      'id','producto_id','precio','cantidad','caja_id'
    ];
}
