<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Objective;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
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
            'ResultValue' => $this->faker->randomFloat(2, 0, 10),
            'ResultComment' =>
            $this->faker->paragraph,
        ];
    }
}
