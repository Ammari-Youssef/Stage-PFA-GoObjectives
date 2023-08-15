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
            $table->string('ObjectiveTitle');
            $table->string('Description');
            $table->string('Category');
            $table->boolean('isDone');
            $table->boolean('ExpectedResult');
            $table->string('Type');
            $table->date('DateDebut');
            $table->integer('Importance');
            $table->string('Planning');
            $table->string('PlanningType', 50);
            $table->integer('PlanningDays');
            $table->integer('RestDays');
            $table->string('DureeEstimee', 50);
            $table->unsignedBigInteger('UserID');
            $table->foreign('UserID')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate(); //Fach tms7 / tmodifi id user ga3 les objectif ytsupprimaw / id ytmodifa 
            $table->timestamps();
           
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
