<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_flow', function (Blueprint $table) {
            $table->increments('o_id')->comment('订单id 自增');
            $table->string('order_no',255)->default('')->comment('订单id 编号');
            $table->unsignedInteger('p_id')->default(0)->comment('产品id');
            $table->unsignedInteger('u_id')->default(0)->comment('用户id 购买者');
            $table->unsignedInteger('buy_num')->default(0)->comment('购买数量');
            $table->string('charge_u_id',255)->default('')->comment('充值用户id 多个用,分开');
            $table->unsignedTinyInteger('pay_type')->default(0)->comment('支付类型 0未知 1微信 2支付宝');
            $table->unsignedInteger('order_money')->default(0)->comment('订单金额'); //100
            $table->unsignedInteger('pay_money')->default(0)->comment('实际支付金额'); //70
            $table->unsignedInteger('order_money_sub')->default(0)->comment('满减金额'); //20
            $table->unsignedInteger('order_money_add')->default(0)->comment('赠送金额'); //20
            $table->string('coupon_nos',255)->default('')->comment('优惠券编号 多个优惠券用,分割');
            $table->unsignedInteger('coupon_money')->default(0)->comment('优惠券金额');//-10
            $table->unsignedInteger('pay_status')->default(0)->comment('支付状态，0未支付，1已支付，2已取消');
            $table->timestamp('payed_at')->nullable()->comment('支付时间');
            $table->timestamp('vpn_deadline')->nullable()->comment('vpn到期时间');
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
        Schema::dropIfExists('order_flow');
    }
}
