<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts', function(Blueprint $table) {

            // Becouse sqlite need to default value for colums
            if(env('DB_CONNECTION') === 'sqlite_testing') {
                $table->bigInteger('user_id')->unsigned()->default(0);
            } else {
                $table->bigInteger('user_id')->unsigned();
            }

            $table->foreign('user_id')
            ->references('id')
            ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
