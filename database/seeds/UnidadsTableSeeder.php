<?php

use Illuminate\Database\Seeder;

class UnidadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SIS\Unidad::class,50)->create();
    }
}
