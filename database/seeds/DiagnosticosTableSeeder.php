<?php

use Illuminate\Database\Seeder;

class DiagnosticosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SIS\Diagnostico::create([
        	'nombre' => 'VIRUS',
        	'descripcion' => 'El equipo posiblemente tenga virus',
        ]);
        SIS\Diagnostico::create([
        	'nombre' => 'NO ENCIENDE',
        	'descripcion' => 'El equipo no enciende',
        ]);
        SIS\Diagnostico::create([
        	'nombre' => 'SE REINICIA',
        	'descripcion' => 'El equipo se reinicia automaticamente',
        ]);
        SIS\Diagnostico::create([
        	'nombre' => 'INSTALACION DE PROGRAMAS',
        	'descripcion' => 'Se necesita instalar programas en el equipo',
        ]);
        SIS\Diagnostico::create([
        	'nombre' => 'SIGMA, RUAT',
        	'descripcion' => 'Se necesita instalacion y configuracion de SIGMA y/o RUAT en el equipo',
        ]);
        SIS\Diagnostico::create([
        	'nombre' => 'HARDWARE',
        	'descripcion' => 'Necesita revision y/o reparacion de la parte fisica del equipo',
        ]);
        SIS\Diagnostico::create([
        	'nombre' => 'REDES E INTERNET',
        	'descripcion' => 'El equipo necesita la configuracion y/o habilitacion de internet',
        ]);
        SIS\Diagnostico::create([
        	'nombre' => 'SOFTWARE',
        	'descripcion' => 'Se necesita revision y/o mantenimiento del software desarrollado por la Jefatura de Tecnologia',
        ]);
        SIS\Diagnostico::create([
        	'nombre' => 'CAMARAS',
        	'descripcion' => 'Se necesita la revision y/o reparacion,cambio de camaras de seguridad',
        ]);
        SIS\Diagnostico::create([
        	'nombre' => 'OTROS',
        	'descripcion' => 'El equipo posiblemente tenga virus',
        ]);
    }
}
