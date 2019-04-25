<?php

use Faker\Generator as Faker;

$factory->define(App\Caja::class, function (Faker $faker) {
    return [
        'apertura' => $faker->date('Y-m-d'),
        'user_id' => \App\User::all()->random()->id,
        'base' => $faker->numberBetween( $min= 1000.00, $max= 100000.00),
        'descripcion' => $faker->text,
    ];
});
