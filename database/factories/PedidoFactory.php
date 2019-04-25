<?php

use Faker\Generator as Faker;

$factory->define(App\Pedido::class, function (Faker $faker) {
    return [
        'fecha' => $faker->date('Y-m-d'),
        'observacion' => $faker->text,
        'proveedor_id' =>  \App\Proveedor::all()->random()->id,
        'user_id' =>  \App\User::all()->random()->id,
        'forma_pago' =>  '1',
        'subtotal' => $faker->numberBetween( $min= 1000.00, $max= 100000.00),
        'descuento' => '0',
        'iva' => '0',
        'total' => $faker->numberBetween( $min= 1000.00, $max= 100000.00),
        'estado_pedido' => '0'
    ];
});
