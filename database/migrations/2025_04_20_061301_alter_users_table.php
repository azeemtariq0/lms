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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mollim_details')->nullable()->after('is_mollim');
            $table->string('facebook_link')->nullable()->after('mollim_details');
            $table->string('twitter_link')->nullable()->after('facebook_link');
            $table->string('google_link')->nullable()->after('twitter_link');
            $table->string('instagram_link')->nullable()->after('google_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'facebook_link',
                'twitter_link',
                'google_link',
                'instagram_link'
            ]);
        });
    }
};
