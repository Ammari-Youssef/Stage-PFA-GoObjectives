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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->double('number_value')->nullable();
            $table->time('experience_time_value')->nullable();
            $table->boolean('behavior_result')->nullable();
            $table->date('result_date');;
            $table->string('comment', 255)->nullable();
            $table->timestamps();
            
            $table->unsignedBigInteger('objective_id'); // Foreign key to link with objectives table

            // Define the foreign key relationship to the objectives table
            $table->foreign('objective_id')->references('id')->on('objectives')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
