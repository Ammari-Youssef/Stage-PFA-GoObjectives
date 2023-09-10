<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            [
                'name' => 'Health & Fitness',
                'description' => 'This category is all about achieving physical well-being, including goals like improving fitness, maintaining a healthy diet, enhancing mental health, and overall wellness.',
            ],
            [
                'name' => 'Relationships',
                'description' => 'Within this category, individuals seek to build and maintain meaningful connections, fostering harmonious family bonds, nurturing friendships, cultivating loving relationships, and developing strong interpersonal skills.',
            ],
            [
                'name' => 'Spirituality',
                'description' => 'Objectives in this category often revolve around personal beliefs, spiritual growth, finding inner peace, practicing mindfulness, and exploring a deeper sense of purpose in life.',
            ],
            [
                'name' => 'Environment',
                'description' => 'Within this category, objectives are centered on improving your living environment, which may include goals related to changing homes, enhancing the quality of the living space, and creating a better living environment.',
            ],
            [
                'name' => 'Free Time',
                'description' => 'In this category, people aim to make the most of their leisure time by pursuing hobbies, enjoying entertainment, exploring new interests, and finding relaxation and joy in their free moments.',
            ],
            [
                'name' => 'Work & Business',
                'description' => 'Objectives within work and business cover career advancement, entrepreneurial aspirations, effective management, achieving professional success, and financial growth.',
            ],
            [
                'name' => 'Feelings',
                'description' => 'Goals in this category focus on emotional well-being, self-awareness, coping strategies, and achieving a state of emotional balance and contentment.',
            ],
            [
                'name' => 'Money & Finance',
                'description' => 'Financial objectives involve managing money wisely, setting and achieving financial goals, saving for the future, investing for growth, and achieving financial security.',
            ],
        ];

       
        foreach ($categories as $category) {
            Category::create($category);
        }

        // single record add 
        // Category::create([
        //     'name'=>"Test category"
        // ]);

    }
}
