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
        Schema::create('progress', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->unsignedBigInteger('user_id'); // Foreign key for users table
            $table->unsignedBigInteger('category_id'); // Foreign key for categories table
            $table->decimal('rating', 5, 2)->default(0); // Decimal field for the rating (5 digits, 2 decimal places)
            $table->timestamps(); // Created_at and updated_at timestamps
            // Define foreign key cons*traints
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
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
