<?php

namespace Database\Seeders;

use App\Models\Motive;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Motive::factory()->count(3)->create();
    }
}
