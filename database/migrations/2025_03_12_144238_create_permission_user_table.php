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
    Schema::create('permission_user', function (Blueprint $table) {
        $table->id();
        $table->integer('user_id');
        $table->integer('permission_id');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('permission_user');
}

};
