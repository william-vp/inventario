<?php

use Faker\Generator as Faker;

$factory->define(App\Factura::class, function (Faker $faker) {
    return [
        'fecha' => $faker->date('Y-m-d'),
        'observacion' => $faker->text,
        'cliente_id' =>  \App\Cliente::all()->random()->id,
        'caja_id' =>  \App\Caja::all()->random()->id,
        'forma_pago' =>  '1',
        'subtotal' => $faker->numberBetween( $min= 1000.00, $max= 100000.00),
        'descuento' => '0',
        'iva' => '0',
        'total' => $faker->numberBetween( $min= 1000.00, $max= 100000.00)

    ];
});
