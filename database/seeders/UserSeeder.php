<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@minidivar.test',
            'phone' => '9120000000',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'test@minidivar.test',
            'phone' => '9120000001',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}
