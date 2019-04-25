<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table= "cajas";
    protected $fillable = [
        'apertura','cierre','user_id','base','total','descripcion'
    ];
}
