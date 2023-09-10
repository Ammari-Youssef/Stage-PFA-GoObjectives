<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Objective;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // CategorySeeder::class,
            // TypeObjectiveSeeder::class,
            // PlanningSeeder::class,
            // ObjectiveSeeder::class,
            // TaskSeeder::class,
            // ResultSeeder::class,
            // LevelSeeder::class,
            // MotiveSeeder::class,

        ]);
        \App\Models\User::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'firstname' => 'Youssef',
        //     'lastname' => 'Ammari',
        //     'username' => 'admin',
        //     'email' => 'admin@example.com',
        //     'password' => '12345678',
        // ]);
        // \App\Models\User::factory()->create([
        //     'firstname' => 'Skalapa',
        //     'lastname' => 'Baroni',
        //     'username' => 'Skalapa Baroni',
        //     'email' => 'sklapa@example.com',
        //     'password' => '12345678',
        // ]);
    }
}
