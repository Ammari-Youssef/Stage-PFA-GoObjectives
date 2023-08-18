<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Objective;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'TaskTitle' => $this->faker->sentence,
            'TaskDescription' => $this->faker->paragraph,
            'TaskDate' => Carbon::now(),
            'ObjectiveID' => Objective::factory(), // Creating a related objective using its factory
        ];
    }
}
