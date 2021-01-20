<?php

use Illuminate\Database\Seeder;

class ServiciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SIS\Servicio::create([
        	'nombre'=> 'Hardware',
        	'descripcion' => 'Servicio de algun componente del equipo'
        ]);
        SIS\Servicio::create([
        	'nombre'=> 'Software',
        	'descripcion' => 'Instalacion de programa o verificacion de antivirus'
        ]);
        SIS\Servicio::create([
        	'nombre'=> 'Redes',
        	'descripcion' => 'Instalacion de red o revision de internet'
        ]);
        SIS\Servicio::create([
        	'nombre'=> 'Impresora',
        	'descripcion' => 'Mantenimiento de impresoras'
        ]);
        SIS\Servicio::create([
        	'nombre'=> 'Fotocopiadora',
        	'descripcion' => 'Mantenimiento de fotocopiadora'
        ]);
        SIS\Servicio::create([
        	'nombre'=> 'Plotter',
        	'descripcion' => 'Revision o mantenimiento de plotter'
        ]);
        SIS\Servicio::create([
        	'nombre'=> 'Otros',
        	'descripcion' => 'Otro tipo de servicio o problema en el equipo'
        ]);
    }
}
