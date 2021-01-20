<?php

use Illuminate\Database\Seeder;

class ComponentesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SIS\Componente::create([
        	'nombre'=> 'CPU'
        ]);
        SIS\Componente::create([
        	'nombre'=> 'Portatil'
        ]);
        SIS\Componente::create([
        	'nombre'=> 'Impresora'
        ]);
        SIS\Componente::create([
        	'nombre'=> 'Fotocopiadora'
        ]);
        SIS\Componente::create([
        	'nombre'=> 'Electronica'
        ]);
        SIS\Componente::create([
        	'nombre'=> 'Redes'
        ]);
        SIS\Componente::create([
        	'nombre'=> 'Software'
        ]);
    }
}
