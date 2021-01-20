<?php

use Illuminate\Database\Seeder;

class TecnicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SIS\Tecnico::create([
	        'carnet' => '1',
	        'nombre' => 'Administrador',
	        'apellidos' => 'Sistemas',
	        'cargo' => 'Administrador',
	        'titulo' => 'Ing.',
    	]);

        SIS\Tecnico::create([
            'carnet' => '5689051',
            'nombre' => 'Carlos Alfredo',
            'apellidos' => 'Manjon Sanchez',
            'cargo' => 'Jefe de Tecnologias de la Informacion',
            'titulo' => 'Ing.',
        ]);

        SIS\Tecnico::create([
            'carnet' => '4094188',
            'nombre' => 'Rufino',
            'apellidos' => 'Saavedra Calvimontes',
            'cargo' => 'Encargado Tecnico de Soporte Tecnico',
            'titulo' => 'Tec.',
        ]);

        SIS\Tecnico::create([
            'carnet' => '3655484',
            'nombre' => 'Maria Elena',
            'apellidos' => 'Bellido Diaz',
            'cargo' => 'Tecnico de Soporte',
            'titulo' => 'Ing.',
        ]);

        SIS\Tecnico::create([
            'carnet' => '4094215',
            'nombre' => 'Santos Leonardo',
            'apellidos' => 'Lancho Gomez',
            'cargo' => 'Tecnico de Soporte',
            'titulo' => 'Tec.',
        ]);

        SIS\Tecnico::create([
            'carnet' => '3649594',
            'nombre' => 'Aldo Dorian',
            'apellidos' => 'Mejia Barrientos',
            'cargo' => 'Tecnico de Soporte',
            'titulo' => 'Ing.',
        ]);

        SIS\Tecnico::create([
            'carnet' => '1090925',
            'nombre' => 'Oscar',
            'apellidos' => 'Torrez Llanos',
            'cargo' => 'Tecnico de Soporte',
            'titulo' => 'Tec.',
        ]);

        SIS\Tecnico::create([
            'carnet' => '3626707',
            'nombre' => 'H. Mireya',
            'apellidos' => 'Martinez Estrada',
            'cargo' => 'Tecnico de Soporte',
            'titulo' => 'Ing.',
        ]);
        SIS\Tecnico::create([
            'carnet' => '2',
            'nombre' => 'Invitado',
            'apellidos' => 'Guest',
            'cargo' => 'Sin Cargo',
            'titulo' => 'Prof.',
        ]);
    }
}
