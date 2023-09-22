<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Objective;
use Carbon\Carbon;

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
        $numberValue = null;
        $experienceTimeValue = null;
        $behaviorResult = null;

        $randomColumn = $this->faker->randomElement(['number_value', 'experience_time_value', 'behavior_result']);

        switch ($randomColumn) {
            case 'number_value':
                $numberValue = $this->faker->randomFloat(2, 0, 100);
                break;
            case 'experience_time_value':
                $experienceTimeValue = $this->faker->time('H:i:s');
                break;
            case 'behavior_result':
                $behaviorResult = $this->faker->boolean;
                break;
        }

        return [
            'number_value' => $numberValue,
            'experience_time_value' => $experienceTimeValue,
            'behavior_result' => $behaviorResult,
            'result_date' => $this->faker->date,
            'comment' => $this->faker->text(10),
            // 'objective_id' => Objective::factory(), //Make objective and associate it with result
            'objective_id' => Objective::pluck('id')->random(), // Get a random existing objective ID
        ];
    
    }
}
