<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Article extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //文章分类
        Schema::create('article_class', function (Blueprint $table) {
            $table->increments('ac_id')->comment('文章分类id');
            $table->string('ac_name',255)->default('')->comment('分类名称');
            $table->unsignedTinyInteger('is_del')->default(0)->comment('是否删除');
            $table->unsignedInteger('parent_id')->default(0)->comment('父级id');
            $table->timestamps();
        });
        //文章分类
        Schema::create('article_detail', function (Blueprint $table) {
            $table->increments('id')->comment('文章id');
            $table->unsignedInteger('ac_id')->default(0)->comment('文章分类id');
            $table->char('type',1)->default(0)->comment('文章类型 1新|2顶');
            $table->char('tags',1)->default(0)->comment('文章标签 1科技|2娱乐');
            $table->integer('order')->default(0)->comment('排序 从大到小');
            $table->integer('view_count')->default(0)->comment('浏览统计');
            $table->string('title',255)->comment('标题');
            $table->text('content')->comment('内容');
            $table->unsignedTinyInteger('on_show')->default(0)->comment('是否上架展示');
            $table->unsignedTinyInteger('is_del')->default(0)->comment('是否删除');
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
        Schema::dropIfExists('article_detail');
        Schema::dropIfExists('article_class');
    }
}
