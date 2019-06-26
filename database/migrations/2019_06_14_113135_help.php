<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Help extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //帮助中心分类
        Schema::create('help_class', function (Blueprint $table) {
            $table->increments('hc_id')->comment('帮助分类id');
            $table->string('hc_name',255)->default('')->comment('分类名称');
            $table->unsignedTinyInteger('is_del')->default(0)->comment('是否删除');
            $table->unsignedInteger('parent_id')->default(0)->comment('父级id');
            $table->timestamps();
        });
        //帮助内容
        Schema::create('help_detail', function (Blueprint $table) {
            $table->increments('id')->comment('帮助id');
            $table->unsignedInteger('hc_id')->default(0)->comment('帮助分类id');
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
        Schema::dropIfExists('help_detail');
        Schema::dropIfExists('help_class');
    }
}
