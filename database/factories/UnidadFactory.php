<?php

use Faker\Generator as Faker;

$factory->define(SIS\Unidad::class, function (Faker $faker) {
    return [
        'nombre' => $faker->company,
    ];
});
