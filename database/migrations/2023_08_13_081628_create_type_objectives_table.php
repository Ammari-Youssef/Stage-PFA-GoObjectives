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
        Schema::create('type_objectives', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('number_value',10,2)->nullable();
            $table->time('initial_time')->nullable();
            $table->time('target_time')->nullable();
            $table->boolean('logic_option')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_objectives');
    }
};
