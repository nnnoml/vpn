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
            $table->timestamps();
        });
        //省市县库
        Schema::create('sys_area', function (Blueprint $table) {
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
        Schema::dropIfExists('sys_area');
    }
}
