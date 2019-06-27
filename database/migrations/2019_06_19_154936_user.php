<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //用户
        Schema::create('user', function (Blueprint $table) {
            $table->increments('u_id')->comment('用户id');
            $table->string('appkey',255)->default('')->comment('用户appkey');
            $table->string('account',20)->default('')->comment('用户账号');
            $table->string('pwd',50)->default('')->comment('用户密码');
            $table->string('nickname',50)->default('')->comment('昵称');
            $table->unsignedInteger('level')->default(0)->comment('用户积分');
            $table->unsignedInteger('h_upper_limit')->default(0)->comment('按次 每日上限金额 分');
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
        Schema::dropIfExists('user');
    }
}
