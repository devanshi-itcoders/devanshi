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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('e.g. Mr. John Paul');
            $table->string('designation')->comment('e.g. Senior Directory');
            $table->string('profile_image')->comment('Profile Image path');
            $table->string('email')->nullable()->comment('Email address');
            $table->string('phone_1')->nullable()->comment('Phone no 1 with country code');
            $table->string('phone_2')->nullable()->comment('Phone no 2 with country code');
            $table->string('fb_url')->nullable()->comment('Facebook profile url');
            $table->string('twitter_url')->nullable()->comment('Twitter profile url');
            $table->string('instagram_url')->nullable()->comment('Instagram profile url');
            $table->string('youtube_url')->nullable()->comment('Youtube profile url');
            $table->string('linkedin_url')->nullable()->comment('LinkedIn profile url');
            $table->string('whatsapp_url')->nullable()->comment('Whatsapp profile url');
            $table->string('status')->comment('VISIBLE, HIDDEN');
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
        Schema::dropIfExists('teams');
    }
};
