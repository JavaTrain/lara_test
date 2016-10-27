<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
// composer require laracasts/testdummy

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        \App\User::create([
            'email' => 'user1@mail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
