<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'special' => 'all-access'
        ]);

        Role::create([
            'name' => 'No Acceso',
            'slug' => 'no-access',
            'special' => 'no-access'
        ]);

        Role::create([
            'name' => 'Invitado',
            'slug' => 'guest'
        ]);

        Role::create([
            'name' => 'Encargado',
            'slug' => 'encargado'
        ]);

        Role::create([
            'name' => 'Tecnico',
            'slug' => 'tecnico'
        ]);

        /**
         * Nuevos roles 2021
        */
        Role::create([
            'name' => 'Educación',
            'slug' => 'educacion'
        ]);

        Role::create([
            'name' => 'Salud',
            'slug' => 'salud'
        ]);

    }
}
