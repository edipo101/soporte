<?php

use Illuminate\Database\Seeder;

class DireccionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SIS\Direccion::class,100)->create();
    }
}
