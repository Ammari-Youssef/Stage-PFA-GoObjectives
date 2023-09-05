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
        return [
            //
           'objective_id' => Objective::factory(),
            'number_value' => $this->faker->randomFloat(2, 0, 100),
            'experience_time_value' => $this->faker->time('H:i:s'),
            'logic_result' => $this->faker->boolean,
            'result_date' => $this->faker->date(),
            'comment' => $this->faker->text(50),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        ];
    }
}
