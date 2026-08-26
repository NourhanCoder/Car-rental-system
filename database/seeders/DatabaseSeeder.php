<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'full_name' => 'Admin System',
            'user_name' => 'admin',
            'email' => 'admin@carrental.com',
            'password' => Hash::make('password123'),
            'is_admin' => true,
            'is_active' => true,
        ]);

        
        User::create([
            'full_name' => 'John Doe',
            'user_name' => 'johndoe',
            'email' => 'user@carrental.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'is_active' => true,
        ]);
    }
}
