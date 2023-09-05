<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planning>
 */
class PlanningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $length = $this->faker->numberBetween(0, 10); // Random length between 0 and 10
        $array = [];
        $array = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        shuffle($array); // Randomize the order of elements

        $uniqueArray = array_slice($array, 0, $length);

        $type= $this->faker->randomElement(['weekly or multiple times a week', 'daily', 'periodic']);
        return [
            'type' =>$type ,
            'week_days' => $type === 'weekly or multiple times a week' ? $uniqueArray : null,
            'number_of_days' => $type === 'daily' ? null : $this->faker->randomNumber(2),
            'number_of_rest_days' => $type === 'daily' ? null : $this->faker->randomNumber(1),

        
        ];
    }
}
