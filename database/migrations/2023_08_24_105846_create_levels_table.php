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
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Default');
            $table->text('description')->default('No description');
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('planning_id')->nullable();
            $table->unsignedBigInteger('objective_id')->nullable(); 

            $table->foreign('objective_id')->references('objective')->on('id')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('planning_id')->references('planning')->on('id')->onDelete('cascade')->onUpdate('cascade');
   
            $table->timestamps();
            


          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};
