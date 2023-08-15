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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('TaskTitle');
            $table->text('TaskDescription');
            $table->text('TaskDate');
            $table->unsignedBigInteger('ObjectiveID');
            $table->foreign('ObjectiveID')->references('id')->on('objectives')->cascadeOnDelete()->cascadeOnUpdate;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
