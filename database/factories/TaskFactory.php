<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Objective;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $objectives = Objective::pluck('id')->toArray(); // Get IDs of existing objectives

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

        $types = ['number', 'time', 'essential ', 'logic'];
        $type = $this->faker->randomElement($types);

        $expectedResults = [true, false];
        $expectedResult = $this->faker->randomElement($expectedResults);

        $importance = $this->faker->numberBetween(1, 5);

        $planningTypes = ['daily', 'weekly', 'periodically'];
        $planningType = $this->faker->randomElement($planningTypes);

        return [
            'ObjectiveID' => Objective::factory(), // Creating a related objective using its factory
            'TaskTitle' => $objectiveTitle . ' Task',
            'TaskDescription' => $this->faker->paragraph,
            'TaskDate' => $this->faker->date(),
            'isDone' => $this->faker->boolean,
        ];
    }
}