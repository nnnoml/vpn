<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Task extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('task_id')->comment('任务id');
            $table->string('task_url',255)->default('')->comment('任务通知路径');
            $table->string('task_params',255)->default('')->comment('任务参数');
            $table->integer('count')->default(0)->comment('任务执行次数');
            $table->unsignedTinyInteger('is_del')->default(0)->comment('执行完毕删除');
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
        Schema::dropIfExists('task');
    }
}
