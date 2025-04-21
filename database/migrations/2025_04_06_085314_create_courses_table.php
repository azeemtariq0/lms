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
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->integer('category_id')->nullable();
            $table->integer('mollim_id')->nullable();
            $table->string('course_name')->nullable();
            $table->string('course_name_ur')->nullable();
            $table->string('course_requirement',2000)->nullable();
            $table->string('course_detail',2000)->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('status')->default(0);
            $table->string('image')->nullable();
            $table->string('path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
