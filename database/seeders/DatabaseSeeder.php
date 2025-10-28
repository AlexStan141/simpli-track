<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create([
            'role' => 'User'
        ]);

        User::factory(2)->create([
            'role' => 'Lease Admin'
        ]);

        User::factory(2)->create([
            'role' => 'Portofolio Manager'
        ]);

        User::factory(2)->create([
            'role' => 'Director'
        ]);

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'role'=> 'Admin',
            'phone' => '+40729626513'
        ]);
    }
}
