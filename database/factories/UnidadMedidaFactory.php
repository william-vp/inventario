<?php

use Faker\Generator as Faker;

$factory->define(App\UnidadMedida::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
    ];
});
