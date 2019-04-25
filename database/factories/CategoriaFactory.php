<?php

use Faker\Generator as Faker;

$factory->define(App\Categoria::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'impuesto' => '19',
    ];
});
