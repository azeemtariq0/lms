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
        Schema::create('batches', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('batch_title',255)->nullable();
            $table->integer('course_id')->nullable();
            $table->string('course_duration',255)->nullable();
            $table->integer('course_duration_days')->nullable();
            $table->integer('no_of_questions')->nullable();
            $table->decimal('total_marks')->nullable();
            $table->integer('time_limit')->nullable();
            $table->integer('no_of_easy_question')->nullable();
            $table->integer('no_of_medium_question')->nullable();
            $table->integer('no_of_hard_question')->nullable();
            $table->integer('year')->nullable();
            $table->integer('month')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
