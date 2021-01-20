<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SIS\User::create([
        	'tecnico_id' => '1',
        	'nickname' => 'admin',
        	'password' => 'S1st3m4s',
        	'remember_token' => str_random(10),
        ]);

        SIS\User::create([
            'tecnico_id' => '2',
            'nickname' => 'cmanjon',
            'password' => '5689051',
            'remember_token' => str_random(10),
        ]);

        SIS\User::create([
            'tecnico_id' => '3',
            'nickname' => 'rsaavedra',
            'password' => '4094188',
            'remember_token' => str_random(10),
        ]);

        SIS\User::create([
            'tecnico_id' => '4',
            'nickname' => 'mbellido',
            'password' => '3655484',
            'remember_token' => str_random(10),
        ]);

        SIS\User::create([
            'tecnico_id' => '5',
            'nickname' => 'slancho',
            'password' => '4094215',
            'remember_token' => str_random(10),
        ]);

        SIS\User::create([
            'tecnico_id' => '6',
            'nickname' => 'amejia',
            'password' => '3649594',
            'remember_token' => str_random(10),
        ]);

        SIS\User::create([
            'tecnico_id' => '7',
            'nickname' => 'otorrez',
            'password' => '1090925',
            'remember_token' => str_random(10),
        ]);

        SIS\User::create([
            'tecnico_id' => '8',
            'nickname' => 'hmartinez',
            'password' => '3626707',
            'remember_token' => str_random(10),
        ]);

        SIS\User::create([
            'tecnico_id' => '9',
            'nickname' => 'invitado',
            'password' => '123456',
            'remember_token' => str_random(10),
        ]);
    }
}
