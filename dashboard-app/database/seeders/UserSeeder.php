<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        /*
        |--------------------------------------------------------------------------
        | PENGGUNA

        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Shintya',
            'email' => 'pengguna@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'pengguna'
        ]);
    }
}