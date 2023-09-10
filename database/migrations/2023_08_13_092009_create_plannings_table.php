<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plannings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planning_type_id'); // id of weekly or multiple_times_a_week, daily, periodic ..etc
            $table->json('selected_week_days')->nullable(); // JSON array of selected weekdays
            $table->integer('number_of_days')->nullable(); // Number of days for periodic type
            $table->integer('number_of_rest_days')->nullable(); // Number of rest days for periodic type            
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('planning_types');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plannings');
    }
};
