<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@precisionlogistic.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@precisionlogistic.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);

        User::create([
            'name'     => 'Siti Rahayu',
            'email'    => 'siti@precisionlogistic.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);
    }
}
