<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //网站基础配置
        Schema::create('sys_conf', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->string('title',100)->default('')->comment('网站名称');
            $table->string('keywords',255)->default('')->comment('网站关键词');
            $table->string('description',255)->default('')->comment('网站描述');
            $table->string('qq',50)->default('')->comment('qq');
            $table->string('tel',15)->default('')->comment('联系方式');
            $table->string('icp',15)->default('')->comment('icp备案');
            $table->string('comp_name',255)->default('')->comment('公司名称');
            $table->string('comp_address',255)->default('')->comment('公司地址');
            $table->string('logo',255)->default('')->comment('logo 图片');
            $table->string('logo2',255)->default('')->comment('logo 图片浅色');
            $table->string('wechat',255)->default('')->comment('微信 图片');
        });

        //后台用户
        Schema::create('sys_sms_log', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->string('tel',15)->default('')->comment('手机号');
            $table->string('code',6)->default('')->comment('验证码');
            $table->unsignedTinyInteger('type')->default('0')->comment('短信类型 0未知，1注册，2找回密码');
            $table->unsignedTinyInteger('status')->default(0)->comment('是否使用 0未使用  1已使用');
            $table->timestamps();
        });

        //后台用户
        Schema::create('sys_admin', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->string('account',255)->default('')->comment('账号');
            $table->string('password',255)->default('')->comment('密码');
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
        Schema::dropIfExists('sys_conf');
        Schema::dropIfExists('sys_admin');
        Schema::dropIfExists('sys_sms_log');
    }
}
