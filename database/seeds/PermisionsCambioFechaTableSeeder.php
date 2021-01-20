<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermisionsCambioFechaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Cambiar Fecha Informe de Bajas
        Permission::create([
            'name' => 'Cambio de Fecha del Informe',
            'slug' => 'bajas.cambiarFecha',
            'description' => 'Realiza el Cambio de Fecha del Informe',
        ]);

        //Cambiar Fecha Informe de Reparacion
        Permission::create([
            'name' => 'Cambio de Fecha del Informe',
            'slug' => 'reparacions.cambiarFecha',
            'description' => 'Realiza el Cambio de Fecha del Informe',
        ]);

        //Cambiar Fecha Informe de Recepcion
        Permission::create([
            'name' => 'Cambio de Fecha del Informe',
            'slug' => 'recepcions.cambiarFecha',
            'description' => 'Realiza el Cambio de Fecha del Informe',
        ]);

        //Cambiar Fecha Informe de Reposicion
        Permission::create([
            'name' => 'Cambio de Fecha del Informe',
            'slug' => 'reposicions.cambiarFecha',
            'description' => 'Realiza el Cambio de Fecha del Informe',
        ]);
    }
}
