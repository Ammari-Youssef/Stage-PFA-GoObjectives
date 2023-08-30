<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Progress>
 */
class ProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'health_fitness' => $this->faker->randomFloat(2, 0, 10),
            'relationships' => $this->faker->randomFloat(2, 0, 10),
            'spirituality' => $this->faker->randomFloat(2, 0, 10),
            'environment' => $this->faker->randomFloat(2, 0, 10),
            'free_time' => $this->faker->randomFloat(2, 0, 10),
            'work_business' => $this->faker->randomFloat(2, 0, 10),
            'feelings' => $this->faker->randomFloat(2, 0, 10),
            'money_finance' => $this->faker->randomFloat(2, 0, 10),
            'UserID' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'CategoryID' => function () {
                return \App\Models\Category::factory()->create()->id;
            },
        ];
    }
}
