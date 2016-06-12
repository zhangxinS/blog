<?php
//文章数据表
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->comment('文章编号');
            $table->string('slug')->unique()->comment('将文章标题转化为URL的一部分，以利于SEO');
            $table->string('title')->comment('标题');
            $table->text('content')->comment('文章内容');
            $table->timestamps();
            $table->timestamp('published_at')->index()->comment('文章发布时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
