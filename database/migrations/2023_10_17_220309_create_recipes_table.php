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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('source')->nullable();
            $table->string('image')->nullable();
            $table->json('diet_labels')->nullable();
            $table->json('health_labels')->nullable();
            $table->float('calories')->nullable();
            $table->decimal('price',20,2)->nullable();
            $table->integer('total_time')->default(0);
            $table->float('weight')->nullable();
            $table->string('cuisine_type')->nullable();
            $table->string('meal_type')->nullable();
            $table->string('dish_type')->nullable();
            $table->json('ingredients')->nullable();
            $table->json('nutrients')->nullable();
            $table->json('cautions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
