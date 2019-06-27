<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('p_id')->comment('产品id');
            $table->unsignedTinyInteger('type')->comment('1vpn包时 2按次');
            $table->unsignedTinyInteger('h_type')->comment('按次类型 1按次 2包周 3包月 4长效可匿');
            $table->integer('money')->default('0')->comment('售价 分');
            $table->integer('money_desc')->default('0')->comment('充值满减 分');
            $table->integer('money_asc')->default('0')->comment('充值赠送 分');
            $table->integer('time_length')->default('0')->comment('时间长度 秒');
            $table->string('h_type_id',255)->default('')->comment('按次产品类型 关联product_h_type 多对一');
            $table->integer('h_daily_limit')->default('0')->comment('每天使用上限 按次包周使用');
            $table->integer('h_max_num')->default('0')->comment('一次最多提取数量 按次包周使用');
            $table->string('desc',255)->nullable()->default('')->comment('描述');
            $table->unsignedTinyInteger('on_show')->default(0)->comment('是否上架展示');
            $table->unsignedTinyInteger('is_del')->default(0)->comment('是否删除');
            $table->timestamps();
        });

        Schema::create('product_h_type', function (Blueprint $table) {
            $table->increments('h_type_id')->comment('按次产品类型id');
            $table->integer('start_second')->default('0')->comment('开始时间 秒');
            $table->integer('end_second')->default('0')->comment('结束时间 秒');
            $table->integer('price')->default('0')->comment('单价 分');
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
        Schema::dropIfExists('product');
    }
}
