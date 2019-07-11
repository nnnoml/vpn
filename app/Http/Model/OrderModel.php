<?php

namespace App\Http\Model;

use App\Http\Controllers\Common\Common;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderModel extends Model
{
    use Common;
    protected $table = 'order_flow';

    public static function getOrderList($u_id){
        $self = new self();
        $self_table = $self->getTable();
        $product = new ProductModel();
        $product_table = $product->getTable();

        $res = $self->from("$self_table as o")
            ->leftJoin("$product_table as p",'p.p_id','o.p_id')
            ->where('o.u_id',$u_id)
            ->select('o.*','p.desc')
            ->orderby('o.o_id','desc')
            ->get()->toArray();
        return $res;
    }


    public static function addOrder($data){
        $charge_user_id = UserModel::checkOrderUserInfo($data['username']);
        $product_info = ProductModel::checkOrderProductInfo($data['p_id']);
        if($charge_user_id && $product_info){
            $insert_data['p_id'] = $data['p_id'];
            $insert_data['u_id'] = $data['u_id'];
            $insert_data['buy_num'] = $data['num'];
            $insert_data['charge_u_id'] = $charge_user_id;
            $pay_type = config('sys_conf.pay_type');
            $insert_data['pay_type'] = isset($pay_type[$data['type']]) ? $pay_type[$data['type']]:0;
            $insert_data['order_money'] = ($product_info['money'] + $product_info['money_add'])*$data['num'];
            $insert_data['pay_money'] = ($product_info['money'] - $product_info['money_sub'])*$data['num'];
            $insert_data['order_money_change'] = $product_info['money_add'] != 0 ? $product_info['money_add'] : -$product_info['money_sub'];
            $insert_data['created_at'] = date('Y-m-d H:i:s');

            DB::beginTransaction();
            $o_id = self::insertGetId($insert_data);
            if($o_id){
                //order_id 算法 支付类型_时间戳_订单id
                $res = self::where('o_id',$o_id)->update(['order_no'=>$insert_data['pay_type'].'_'.time().'_'.$o_id]);
                if($res!==false){
                    DB::commit();
                    return $o_id;
                }
            }
            DB::rollback();
            return '执行失败，请重试';
        }
        if(!$charge_user_id){
            return '充值账户不存在';
        }
        if($product_info){
            return '购买产品不存在';
        }
    }

    //扫描支付结果
    public static function scan($o_id){
        return self::where('o_id',$o_id)->value('pay_status');
    }
}
