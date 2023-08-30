<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Objective;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Motive>
 */
class MotiveFactory extends Factory
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
            'MotiveType' => $this->faker,
            'MotiveTitle' =>
            $this->faker->sentence,
            'MotiveDescription' =>
            $this->faker->paragraph,
           
        ];
    }
}
