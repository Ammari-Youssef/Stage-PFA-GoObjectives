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
        Schema::create('motives', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->unsignedBigInteger('objective_id');
            //FK
            $table->foreign('objective_id')->references('id')->on('objectives')->onDelete('cascade')->onUpdate('cascade');
        });


    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motives');
    }
};
