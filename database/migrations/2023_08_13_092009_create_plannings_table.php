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
            $table->string('type'); // weekly or multiple_times_a_week, daily, periodic
            $table->string('week_days')->nullable(); // JSON array of selected weekdays
            $table->integer('number_of_days')->nullable(); // Number of days for periodic type
            $table->integer('number_of_rest_days')->nullable(); // Number of rest days for periodic type            
            $table->timestamps();
            
           
           
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
