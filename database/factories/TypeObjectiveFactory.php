<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeObjective>
 */
class TypeObjectiveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['number', 'time', 'essential', 'logic'];
        $type = $this->faker->randomElement($types);
        return [
            //
            'name' => $type,
            'number_value' => $this->faker->randomFloat(2, 0, 999999.99),
            'initial_time' => $this->faker->time,
            'target_time' => $this->faker->time,
            'logic_option' => $this->faker->boolean,
      
        ];
    }
}
