<?php

namespace Database\Seeders;

use App\Models\TypeObjective;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeObjective::factory()->count(5)->create();
    }
}
