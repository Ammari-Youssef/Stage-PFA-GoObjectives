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
        Schema::create('objectives', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->boolean('desired_result');
            $table->string('type');
            $table->decimal('number_value', 10, 2)->nullable();
            $table->time('initial_time')->nullable();
            $table->time('target_time')->nullable();
            $table->boolean('behavior_option');
            $table->integer('importance');
            $table->date('start_date');
            $table->string('estimated_duration', 50);
            $table->date('end_date');
            $table->boolean('is_done')->default(false);
            $table->timestamps();

            // FK relationships...

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('objective_parent_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('planning_id');

            
            $table->foreign('objective_parent_id')->references('id')->on('objectives')->onDelete('cascade')->cascadeOnUpdate();
            
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('category_id')->references('id')->on('categories');

            $table->foreign('planning_id')->references('id')->on('plannings');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objectives');
    }
};
