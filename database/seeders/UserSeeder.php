<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@minidivar.test',
            'phone' => '09120000000',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        User::factory()->count(5)->create();
    }
}
