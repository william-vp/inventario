<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
	protected $table= "abonos";
    protected $fillable = [
        'fecha','valor','credito_id','caja_id',
    ];
}
