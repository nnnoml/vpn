<?php

namespace App\Http\Controllers\Index\Order;

use App\Http\Controllers\Common\Common;
use App\Http\Model\OrderModel;
use Illuminate\Support\Facades\Log;
use Yansongda\LaravelPay\Facades\Pay;

class AlipayController extends \App\Http\Controllers\Index\IndexController
{
    use Common;

    /**
     * 支付宝下单后 js重新访问该url 验证订单状态，吊起支付
     * @param $o_id
     * @return string
     */
    public function alipay($o_id){
        $order_info = OrderModel::getOrderInfo($o_id);
        if($order_info && $order_info->pay_type==2 && $order_info->pay_status==0){
            $order = [
                'out_trade_no' => $order_info->order_no,
                'total_amount' => $order_info->pay_money,
                'subject' => $order_info->desc.' *'.$order_info->buy_num,
            ];
            return Pay::alipay()->web($order);
        }

        return $this->returnJson(0,'order verify error');
    }



    public function return()
    {
        $data = Pay::alipay()->verify(); // 是的，验签就这么简单！

        // 订单号：$data->out_trade_no
        // 支付宝交易号：$data->trade_no
        // 订单总金额：$data->total_amount
    }

    public function notify()
    {
        $alipay = Pay::alipay();

        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            Log::debug('Alipay notify', $data->all());
        } catch (\Exception $e) {
            // $e->getMessage();
        }

        return $alipay->success();// laravel 框架中请直接 `return $alipay->success()`
    }
}
