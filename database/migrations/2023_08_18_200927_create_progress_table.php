<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserID'); // User's foreign key
            $table->decimal('health_fitness', 8, 2);
            $table->decimal('relationships', 8, 2);
            $table->decimal('spirituality', 8, 2);
            $table->decimal('environment', 8, 2);
            $table->decimal('free_time', 8, 2);
            $table->decimal('work_business', 8, 2);
            $table->decimal('feelings', 8, 2);
            $table->decimal('money_finance', 8, 2);
            $table->timestamps();

            // Define foreign key relationship
            $table->foreign('UserID')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
