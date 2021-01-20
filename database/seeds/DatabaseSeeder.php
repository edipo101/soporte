<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TecnicosTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ComponentesTableSeeder::class);
        $this->call(ServiciosTableSeeder::class);
        $this->call(DiagnosticosTableSeeder::class);
        $this->call(UnidadsTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        $this->call(DireccionsTableSeeder::class);
    }
}
