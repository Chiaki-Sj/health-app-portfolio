<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('food_name');
            $table->integer('calories');
            $table->date('date');
            $table->time('time')->nullable();
            $table->string('meal_type')->nullable();
            $table->string('image_path')->nullable();
            $table->text('notes')->nullable(); // memo
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('food_records');
    }
};
