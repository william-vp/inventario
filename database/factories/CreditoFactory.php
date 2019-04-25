<?php

use Faker\Generator as Faker;

$factory->define(App\Credito::class, function (Faker $faker) {
    return [
        'fecha' => $faker->date('Y-m-d'),
        'observacion' => $faker->text,
        'cliente_id' =>  \App\Cliente::all()->random()->id,
        'caja_id' =>  \App\Caja::all()->random()->id,
        'subtotal' => $faker->numberBetween( $min= 1000.00, $max= 100000.00),
        'iva' => '0',
        'total' => $faker->numberBetween( $min= 1000.00, $max= 100000.00)
    ];
});
