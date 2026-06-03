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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('category_id');
            $table->text('description');
            $table->enum('gender', ['male', 'female', 'unisex']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('thumbnail');
            $table->integer('views')->default(0);
            
            // Fragrance notes
            $table->string('top_notes')->nullable();
            $table->string('middle_notes')->nullable();
            $table->string('base_notes')->nullable();
            
            // Performance
            $table->integer('longevity')->nullable(); // hours
            $table->integer('sillage')->nullable(); // 1-10
            $table->integer('projection')->nullable(); // 1-10
            
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_best_seller')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
