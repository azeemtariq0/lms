<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id'); // Using increments for an auto-incrementing primary key
            $table->string('name', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('path', 255)->nullable();
            $table->integer('status')->default(0);
            $table->char('created_by',40)->nullable();
            $table->char('updated_by',40)->nullable();
            $table->decimal('sort_order', 11, 3)->default(0.000);
            $table->timestamps();        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
