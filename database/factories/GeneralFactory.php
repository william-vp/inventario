<?php

use Faker\Generator as Faker;

$factory->define(App\General::class, function (Faker $faker) {
    return [
        'nombre' => 'Invent',
        'logo' => 'logo.png',
        'portada' => 'portada.png',
        'email' => 'empresa@mail.com',
        'telefono' => '7255555'
    ];
});
