<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            // 'progress_value' => $this->faker->randomFloat(2, 0, 10),
            
        ];
            // 'UserID' => function () {
            //     return \App\Models\User::factory()->create()->id;
            // },
            // 'CategoryID' => function () {
            //     return \App\Models\Category::factory()->create()->id;
            // },
    }
}
