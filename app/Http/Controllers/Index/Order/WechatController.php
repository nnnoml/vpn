<?php

namespace App\Http\Controllers\Index\Order;

use App\Http\Model\OrderModel;
use Illuminate\Support\Facades\Log;
use Yansongda\LaravelPay\Facades\Pay;

class WechatController extends \App\Http\Controllers\Index\IndexController
{
    public function wechat($o_id){
        $order_info = OrderModel::getOrderInfo($o_id);
        if($order_info && $order_info->pay_type==1 && $order_info->pay_status==0) {
            $order = [
                'out_trade_no' => $order_info->order_no,
                'body' => $order_info->desc.' *'.$order_info->buy_num,
                'total_fee' => $order_info->pay_money,
            ];

            return Pay::wechat()->scan($order);
        }
        return false;
    }

    public function notify()
    {
        //微信接到回调通知后 修改订单状态
        $pay = Pay::wechat();
        try{
            $data = $pay->verify(); // 是的，验签就这么简单！

            Log::debug('Wechat notify', $data->all());
        } catch (\Exception $e) {
            // $e->getMessage();
        }

        return $pay->success();// laravel 框架中请直接 `return $pay->success()`
    }
}
