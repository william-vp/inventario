<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'descripcion' => $faker->name,
        'precio_compra' => $faker->numberBetween( $min= 1000.00, $max= 100000.00),
        'precio_venta' => $faker->numberBetween( $min= 1000.00, $max= 100000.00),
        'mostrador' => $faker->numberBetween($min= 2, $max= 80),
        'existencias' => $faker->numberBetween($min= 2, $max= 500),
        'vencimiento' => $faker->date('Y-m-d'),
        'categoria_id' =>  \App\Categoria::all()->random()->id,
        'medida_id' => \App\UnidadMedida::all()->random()->id,
        'estado' => $faker->boolean,
    ];
});
