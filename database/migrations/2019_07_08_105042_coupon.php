<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Coupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //优惠券分类
        Schema::create('coupon_class', function (Blueprint $table) {
            $table->increments('cc_id')->comment('优惠券分类id');
            $table->string('cc_name',255)->default('')->comment('优惠券分类名称');
            $table->unsignedTinyInteger('is_del')->default(0)->comment('是否删除');
            $table->timestamps();
        });
        //优惠券列表
        Schema::create('coupon_list', function (Blueprint $table) {
            $table->increments('coup_id')->comment('优惠券id');
            $table->unsignedInteger('cc_id')->default(0)->comment('优惠券分类id');
            $table->unsignedInteger('user_level_lower_limit')->default(0)->comment('用户领取优惠券积分下限');
            $table->unsignedInteger('user_level_upper_limit')->default(0)->comment('用户领取优惠券积分上限');
            $table->unsignedInteger('count')->default(0)->comment('优惠券派发数量');
            $table->timestamp('start_at')->nullable()->comment('优惠券开始派发时间');
            $table->timestamp('end_at')->nullable()->comment('优惠券开始派发时间');
            $table->unsignedInteger('valid_at')->default(0)->comment('优惠券有效期 秒');
            $table->unsignedTinyInteger('on_show')->default(0)->comment('是否展示');
            $table->unsignedTinyInteger('is_del')->default(0)->comment('是否删除');
            $table->timestamps();
        });

        //优惠券派发列表
        Schema::create('coupon_list_detail', function (Blueprint $table) {
            $table->increments('coup_no')->comment('优惠券编号');
            $table->unsignedInteger('u_id')->default(0)->comment('用户id');
            $table->unsignedInteger('coup_id')->default(0)->comment('优惠券id');
            $table->unsignedTinyInteger('coup_type')->default(0)->comment('0未领取 1已领取');
            $table->unsignedTinyInteger('coup_use_type')->default(0)->comment('0未使用 1已使用');
            $table->timestamp('used_at')->nullable()->comment('使用时间');
            $table->timestamp('valid_at')->nullable()->comment('有效截至时间');
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
        Schema::dropIfExists('coupon_class');
        Schema::dropIfExists('coupon_list');
        Schema::dropIfExists('coupon_list_detail');
    }
}
