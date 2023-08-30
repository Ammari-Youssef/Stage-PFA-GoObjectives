<?php

namespace Database\Factories;

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

        $types = ['number', 'time', 'essential', 'logic'];
        $type = $this->faker->randomElement($types);

        $expectedResults = [true, false];
        $expectedResult = $this->faker->randomElement($expectedResults);

        $importance = $this->faker->numberBetween(1, 5);

        $planningTypes = ['daily', 'weekly', 'periodically'];
        $planningType = $this->faker->randomElement($planningTypes);

        return [
            'ObjectiveTitle' => $objectiveTitle,
            'Description' => $this->faker->paragraph,
            'Category' => $category,
            'isDone' => $this->faker->boolean,
            'ExpectedResult' => $expectedResult,
            'Type' => $type,
            'DateStart' => $this->faker->date,
            'DateDeadline' => $this->faker->date,
            'Importance' => $importance,
            'Planning' => $this->faker->sentence,
            'PlanningType' => $planningType,
            'PlanningDays' => $this->faker->numberBetween(1, 30),
            'RestDays' => $this->faker->numberBetween(0, 5),
            'DureeEstimee' => $this->faker->randomFloat(2, 1, 100),
            'UserID' => \App\Models\User::factory()->create()->id,
        ];
    }
}
