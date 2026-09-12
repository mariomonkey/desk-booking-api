<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Desk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create a specific Admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Always hash passwords!
            'role' => 'admin',
        ]);

        // 2. Create a specific regular User
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // 3. Generate 12 random desks using the factory we just built
        Desk::factory(12)->create();
    }
}