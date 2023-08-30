<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Objective;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
class LevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'ObjectiveID' => Objective::factory(),
            'LevelTitle' => $this->faker->sentence,
            'LevelDescription' => $this->faker->paragraph,
       

        ];
    }
}
