<?php

use Faker\Generator as Faker;

$factory->define(SIS\Direccion::class, function (Faker $faker) {
    return [
        'unidad' => $faker->lastName,
        'funcionario' => $faker->name,
        'cargo' => $faker->jobTitle,
        'ipv4' => $faker->unique()->ipv4,
        'nombrepc' => $faker->unique()->userName,
        'mac' => $faker->macAddress,
        'internet' => $faker->boolean,
        'sigma' => $faker->boolean,
        'sigep' => $faker->boolean,
        'redimpresora' => $faker->localIpv4,
        'estado' => $faker->randomElement(['N','O']),
        'observacion' => $faker->sentence,
        'user_id' => rand(1,9),
    ];
});
