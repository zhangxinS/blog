<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag')->unique();
            $table->string('title');
            $table->string('subtitle');
            $table->string('page_image')->comment('标签图片');
            $table->string('meta_description')->comment('标签描述');
            $table->string('layout')->default('blog.layouts.index')->comment('博客要使用的布局');
            $table->boolean('reverse_direction')->comment('在文章列表按时间升序排列文章（默认是降序）');
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
        Schema::drop('tags');
    }
}
