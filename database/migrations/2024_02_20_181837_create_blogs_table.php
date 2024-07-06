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
    Schema::create('blogs', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('author_id');
      $table->string('title')->comment('e.g. Blog about your latest events or deals');
      $table->text('content')->comment('Blog content in details');
      $table->text('excerpt')->comment('Add a summary of the post to appear on your home page or blog.');
      $table->string('featured_image')->comment('Featured Image path');
      $table->string('tags')->comment('eg. Comma separated tags for this blog');
      $table->string('category')->comment('eg. Blog Category for blog group by');
      $table->string('status')->comment('VISIBLE, HIDDEN');
      $table->timestamp('published_at')->default(DB::raw('CURRENT_TIMESTAMP'))
            ->nullable()->comment('Published date for this blog for the scheduled');
      $table->timestamps();

      $table->index('author_id');
      $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down(Blueprint $table)
  {
    $table->dropForeign('blogs_author_id_foreign');
    $table->dropIndex('blogs_author_id_index');
    $table->dropColumn('author_id');
    Schema::dropIfExists('blogs');
  }
};
