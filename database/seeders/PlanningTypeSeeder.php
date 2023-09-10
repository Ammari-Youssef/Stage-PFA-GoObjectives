<?php

namespace Database\Seeders;

use App\Models\PlanningType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanningTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'daily',
                'description' => 'This plan provides users with data updates on a daily basis, ensuring they receive fresh information every day.',
            ],
            [
                'name' => 'weekly or multiple times a week',
                'description' => 'This versatile plan offers users the flexibility to choose between weekly updates or even more frequent updates, depending on their specific needs and preferences. Whether they want information once a week or several times a week, this plan caters to their requirements.',
            ],
            [
                'name' => 'periodic',
                'description' => 'The periodic plan allows users to receive updates at intervals that suit their individual schedules. They can define the frequency and timing of updates, making it ideal for those who need data refreshes at irregular intervals.',
            ],
        ];

        foreach ($plans as $plan) {
            PlanningType::create($plan);
        }
    }
}
