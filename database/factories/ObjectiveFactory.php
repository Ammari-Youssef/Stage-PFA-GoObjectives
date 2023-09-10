<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Planning;
use App\Models\TypeObjective;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Objective>
 */
class ObjectiveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            "Health & Fitness", "Relationships", "Environnement",
            "Spirituality", "Free Time", "Work & Business",
            "Feelings", "Money & Finance"
        ];
        $category = $this->faker->randomElement($categories);

        $titlePatterns = [
            "Health & Fitness" => ['Workout', 'Exercise', 'Healthy Habits'],
            "Relationships" => ['Bonding', 'Communication', 'Quality Time'],
            "Environnement" => ['Sustainability', 'Eco-friendly Actions', 'Green Choices'],
            "Spirituality" => ['Meditation', 'Spiritual Growth', 'Inner Peace'],
            "Free Time" => ['Hobbies', 'Leisure Activities', 'Personal Development'],
            "Work & Business" => ['Productivity', 'Career Goals', 'Business Growth'],
            "Feelings" => ['Emotional Well-being', 'Self-Awareness', 'Positive Mindset'],
            "Money & Finance" => ['Financial Freedom', 'Savings', 'Investment Strategies'],
        ];
        $titlePattern = $this->faker->randomElement($titlePatterns[$category]);

        $objectiveTitle = $titlePattern . ' ' . $this->faker->randomNumber(1);

        $types = ['number', 'time', 'essential', 'behavioral'];
        $type = $this->faker->randomElement($types);

        
    
        $planningTypes = ['daily', 'weekly', 'periodically'];
        $planningType = $this->faker->randomElement($planningTypes);

        return [
            'title' => $objectiveTitle,
            'description' => $this->faker->paragraph,
            'desired_result' => $this->faker->boolean,
            'importance' => $this->faker->numberBetween(1, 5),
            'start_date' => $this->faker->date,
            'estimated_duration' => $this->faker->randomElement(['1 week','2 week','1 month', '2 months', '3 months','6 months','1 year']),
            'end_date' => $this->faker->date,
            'is_done' => false,
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            //   return  1;
            },
            'objective_parent_id' => null,
            'category_id' => function () {
                // Retrieve an existing category ID randomly
                return Category::inRandomOrder()->first()->id;
            },
            'type' => $type,
            'planning_id' => function () {
                // Retrieve an existing category ID randomly
                return Planning::inRandomOrder()->first()->id;
            },
        ];
    }
}
