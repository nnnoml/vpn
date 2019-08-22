<?php

namespace App\Http\Model;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Common\TaskController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderModel extends Model
{
    use Common;
    protected $table = 'order_flow';

    public static function getOrderList($u_id,$page,$limit,$pay_status){
        $res = self::where('u_id',$u_id);

        if($pay_status!=''){
            $res=$res->where('pay_status',$pay_status);
        }

        $ret['count'] = $res->count();
        $ret['list'] = $res->orderby('o_id','desc')->skip(($page-1)*$limit)->take($limit)->get()->toArray();

        return $ret;
    }


    public static function addOrder($data){
        $product_info = ProductModel::checkOrderProductInfo($data['p_id']);
        if($product_info){
            $insert_data['order_title'] = $product_info['type']==1?'[VPN]'.$product_info['desc']:'';
            $insert_data['order_title'] = $product_info['type']==2?'[HTTP]'.$product_info['desc']:$insert_data['order_title'];

            $insert_data['p_id'] = $data['p_id'];
            $insert_data['p_type'] = $product_info['type'];
            $insert_data['p_h_type'] = $product_info['h_type'];
            $insert_data['u_id'] = $data['u_id'];
            $insert_data['buy_num'] = $data['num'];
            $insert_data['charge_u_id'] = $data['charge_u_id'];
            $pay_type = config('sys_conf.pay_type');
            $insert_data['pay_type'] = isset($pay_type[$data['type']]) ? $pay_type[$data['type']]:0;
            $insert_data['order_money'] = ($product_info['money'] + $product_info['money_add'])*$data['num'];
            $insert_data['pay_money'] = ($product_info['money'] - $product_info['money_sub'])*$data['num'];
//            $insert_data['order_money_change'] = $product_info['money_add'] != 0 ? $product_info['money_add'] : -$product_info['money_sub'];
            $insert_data['order_money_add'] = $product_info['money_add']*$data['num'];
            $insert_data['order_money_sub'] = $product_info['money_sub']*$data['num'];

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
        if($product_info){
            return '购买产品不存在';
        }
    }

    //扫描支付结果
    public static function scan($o_id){
        return self::where('o_id',$o_id)->value('pay_status');
    }

    public static function setOrder($order_no){
        //其他检测
        $order_info = self::where('order_no',$order_no)->first();
        if(!$order_info){
            return 'order error';
        }
        if($order_info->pay_status !=0){
            return 1;
        }

        $product_info = ProductModel::where('p_id',$order_info->p_id)->first();
        if(!$product_info){
            return 'product error';
        }

        DB::beginTransaction();
        $update_data = [
            'pay_status'=>1,
            'payed_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ];
        //vpn
        if($product_info->type == 1){
            //vpn time
            $self = new self();
            //当前时间
            $vpn_time = time();
            //获取已有vpn时间
            $vpn_buy_time = $self->setConnection('mysql_c')->from('tb_user_vpn_order')->where('u_id',$order_info->charge_u_id)->value('valid_at');
            if($vpn_buy_time){
                $vpn_buy_time = strtotime($vpn_buy_time);
                //如果已购买过vpn并且没有到期，之前基础上续期
                if($vpn_time < $vpn_buy_time){
                    $vpn_time = $vpn_buy_time;
                }
            }
            $real_time_length = $vpn_time+$product_info->time_length*$order_info->buy_num;
            $task_info['task_url'] = config('sys_conf.C_server').'/paybytime';
            $task_info['task_params'] = json_encode(['uid'=>$order_info->charge_u_id,'endtime'=>$real_time_length]);
            $update_data['vpn_deadline'] = date('Y-m-d H:i:s',$real_time_length);
        }
        //http&socks5
        else if($product_info->type == 2){
            $task_info['task_url'] = config('sys_conf.C_server').'/paybycount';
            $task_info['task_params'] = json_encode(['uid'=>$order_info->charge_u_id,'money'=>$order_info->order_money]);
        }
        else{
            return 'product type error';
        }

        self::where('order_no',$order_no)->where('pay_status',0)->update($update_data);

        $ret = TaskController::create($task_info);

        //判断是否投递成功
        if($ret){
            DB::commit();
            return 1;
        }
        else{
            DB::rollBack();
            return 'task fail';
        }


    }

    //订单详情
    public static function getOrderInfo($o_id){
        $self = new self();
        $self_table = $self->getTable();
        $product = new ProductModel();
        $product_table = $product->getTable();

        $res = $self->from("$self_table as o")
            ->leftJoin("$product_table as p",'p.p_id','o.p_id')
            ->where('o.o_id',$o_id)
            ->select('o.*','p.desc')
            ->first();

        return $res;
    }
}
