<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'username' => 'admin',
        //     'email' => 'admin@example.com',
        //     'password' => bcrypt('password'),
        // ]);
        $this->call([
            // AdminSeeder::class,
            // UsersSeeder::class,
            // ArticlesSeeder::class,
            CommentsSeeder::class,
        ]);
    }
}
