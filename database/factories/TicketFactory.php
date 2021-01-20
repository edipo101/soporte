<?php

use Faker\Generator as Faker;

$factory->define(SIS\Ticket::class, function (Faker $faker) {
    return [
        'nro_ticket'=> $faker->unique()->numberBetween(1,200) ,
        'gestion'=> $faker->year,
        'unidad_id'=> rand(1,50),
        'user_id'=> rand(1,9),
        'solicitante'=> $faker->name,
        'telef_referencia'=> $faker->phoneNumber,
        'celular_referencia'=> $faker->e164PhoneNumber,
        'componente_id'=> rand(1,7),
        'observacion'=> $faker->sentence,
        'estado'=> $faker->randomElement(['R','A','F']),
        'fecha_asignada'=> $faker->dateTime,
        'fecha_entrega'=> $faker->dateTime,
        'empresa'=> null,
        'factura'=> null,
        'ordencompra'=> null,
        'garantia'=> null,
    ];
});
