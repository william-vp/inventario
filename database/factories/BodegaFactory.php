<?php

use Faker\Generator as Faker;

$factory->define(App\Bodega::class, function (Faker $faker) {
    return [
        //'id' => ,
        'codigo' => $faker->ean8,
        'nombre' => $faker->address,
        'descripcion' => $faker->text
    ];
});
