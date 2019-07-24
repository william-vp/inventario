<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    protected $table= "bodegas";
    protected $fillable= ['id','codigo','nombre','descripcion'];
}
