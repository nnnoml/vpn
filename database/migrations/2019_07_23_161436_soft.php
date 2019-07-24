<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Soft extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soft_info', function (Blueprint $table) {
            $table->increments('soft_id')->comment('软件id');
            $table->string('soft_name',255)->default('')->comment('软件名称');
            $table->string('soft_type',255)->default('')->comment('软件类型 新之类的 预留');
            $table->string('soft_version',255)->default('')->comment('软件版本');
            $table->unsignedBigInteger('soft_byte')->default(0)->comment('软件大小');
            $table->string('soft_download_url',255)->default('')->comment('软件下载地址');
            $table->integer('download_count')->default(0)->comment('下载次数');
            $table->integer('real_download_count')->default(0)->comment('真实下载次数');
            $table->unsignedTinyInteger('on_show')->default(0)->comment('是否上线 0不上 1上');
            $table->unsignedTinyInteger('is_del')->default(0)->comment('是否删除 0 不删 1删');
            $table->text('desc')->comment('描述');
            $table->timestamps();
        });

        Schema::create('soft_sdk', function (Blueprint $table) {
            $table->increments('sdk_id')->comment('sdk id');
            $table->string('soft_name',255)->default('')->comment('sdk名称');
            $table->string('soft_type',255)->default('')->comment('sdk类型');
            $table->string('soft_byte',255)->default('')->comment('sdk大小');
            $table->string('soft_download_url',255)->default('')->comment('sdk下载地址');
            $table->integer('download_count')->default(0)->comment('下载次数');
            $table->integer('real_download_count')->default(0)->comment('真实下载次数');
            $table->unsignedTinyInteger('on_show')->default(0)->comment('是否上线 0不上 1上');
            $table->unsignedTinyInteger('is_del')->default(0)->comment('是否删除 0 不删 1删');
            $table->text('desc')->comment('描述');
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
        Schema::dropIfExists('soft_info');
        Schema::dropIfExists('soft_sdk');
    }
}
