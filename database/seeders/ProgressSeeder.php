<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Progress;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\Progress::factory(5)->create();

        Progress::create([
            'UserID' => 21,
            'health_fitness' => 80.25,
            'relationships' => 70.50,
            'spirituality' => 60.75,
            'environment' => 40.00,
            'free_time' => 75.50,
            'work_business' => 55.25,
            'feelings' => 90.00,
            'money_finance' => 65.75,
        ]);
    }
    
}
