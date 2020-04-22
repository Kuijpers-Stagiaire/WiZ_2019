<?php

use Illuminate\Database\Seeder;

class Fill_Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'id' => '1',
            'voornaam' => 'Patrick',
            'email' => 'plierop@kuijpers.com',
            'password' => Hash::make('Kuijpers'),
            'remember_token' => NULL,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'achternaam' => 'van Lierop',
            'rechten' => 'Admin',
            'vestiging' => 'Helmond',
            'avatar' => 'default.jpg',
        ],
        [
            'id' => '2',
            'voornaam' => 'Jochem',
            'email' => 'jputten@kuijpers.com',
            'password' => Hash::make('testtest'),
            'remember_token' => NULL,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'achternaam' => 'van der Putten',
            'rechten' => 'Admin',
            'vestiging' => 'Helmond',
            'avatar' => '32_avatar1583324901.jpg',
        ],
        [
            'id' => '3',
            'voornaam' => 'User',
            'email' => 'user@kuijpers.com',
            'password' => Hash::make('testuser123'),
            'remember_token' => NULL,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'achternaam' => 'default',
            'rechten' => 'user',
            'vestiging' => 'Helmond',
            'avatar' => 'default.jpg',
        ]]);
    }
}
