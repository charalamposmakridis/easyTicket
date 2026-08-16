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
            'name'     => 'Admin User',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Agent User',
            'email'    => 'agent@example.com',
            'password' => Hash::make('password123'),
            'role'     => 'agent',
        ]);

        User::create([
            'name'     => 'Test Client',
            'email'    => 'client@example.com',
            'password' => Hash::make('password123'),
            'role'     => 'client',
        ]);
    }
}
