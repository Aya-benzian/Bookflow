<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'nom' => 'User',
            'prenom' => 'Test',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'nom' => 'User',
            'prenom' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        $this->call(LivreSeeder::class);
    }
}
