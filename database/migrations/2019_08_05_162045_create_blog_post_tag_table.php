<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('blog_post_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();
            $table->timestamps();

            $table->foreign('blog_post_id')->references('id')
                ->on('blog_posts')
                ->onDelete('cascade');

            $table->foreign('tag_id')->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post_tag');
    }
}
