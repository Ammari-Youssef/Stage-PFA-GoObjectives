<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Task::factory(5)->create();

        DB::table('tasks')->insert([
            [
                'title' => 'Sample Title 3',
                'description' => 'Sample Description 1',
                'date' => now(),
                'objective_id'=>28,
            ],
            [
                'title' => 'Sample Title 4',
                'description' => 'Sample Description 2',
                'date' => now(),
                'objective_id'=>28,
            ],
            
            // Add more data as needed
        ]);
    }
}
