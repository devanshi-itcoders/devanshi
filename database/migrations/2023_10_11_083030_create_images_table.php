<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('btn_text');
            $table->string('btn_link');
            $table->text('image');
            $table->tinyInteger('is_daily_darshan')->default(0);
            $table->tinyInteger('is_gallery')->default(0);
            $table->tinyInteger('is_pages')->default(0);
            $table->tinyInteger('is_home_slider')->default(0);
            $table->enum('status', ['ACTIVE', 'INACTIVE']);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
