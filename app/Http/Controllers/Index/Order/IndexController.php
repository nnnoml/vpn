<?php

namespace App\Http\Controllers\Index\Order;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Common\Plug\JWT;
use App\Http\Model\OrderModel;
use App\Http\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends \App\Http\Controllers\Index\IndexController
{
    use Common;
    public function setOrder(Request $request,$type){
        if(!in_array($type,['vpn','http'])){
            return $this->returnJson(0, '接口格式错误');
        }
        $typeOrder = $type."Order";
        $v_res = $this->$typeOrder($request);

        if($v_res['res']['code']==0) {
            return $this->returnJson(0, $v_res['res']['msg']);
        }
        else {
            if(isset($v_res['data']['username'])){
                $v_res['data']['charge_u_id'] = UserModel::checkOrderUserInfo($v_res['data']['username']);
                if(!$v_res['data']['charge_u_id']){
                    return $this->returnJson(0,'充值账户不存在');
                }
            }
            $res = OrderModel::addOrder($v_res['data']);
            if (is_numeric($res)) {
                return $this->returnJson(1, '下单成功', ['o_id' => $res, 'img_url' => 'http://www.baidu.com']);
            }
            else {
                return $this->returnJson(0, $res);
            }
        }
    }

    /**
     * vpn订单检测
     * @param Request $request
     * @return array
     */
    public function vpnOrder(Request $request){
        $token = $request->cookie('tokenIndex');
        $data['u_id'] = JWT::getTokenUID($token);
        $data['username'] = $request->input('username','');
        $data['p_id'] = $request->input('p_id',0);
        $data['num'] = $request->input('num',1);
        $data['type'] = $request->input('type','');

        $rules = [
            'username'=>'required',
            'p_id'=>'numeric|min:1',
            'num'=>'numeric|min:1',
            'type'=>'required|in:alipay,wechat',
        ];

        $messages = [
            'username.required' => '请填写充值账户',
            'p_id.numeric' => '套餐选择异常',
            'p_id.min' => '套餐选择异常',
            'num.numeric' => '套餐数量异常',
            'num.min' => '套餐数量异常',
            'type.required' => '支付类型必填',
            'type.in' => '支付类型异常',
        ];
        $ret['res'] = $this->validatorData($request,$rules,$messages);
        $ret['data']=$data;
        return $ret;
    }

    /**
     * http 订单检测
     * @param Request $request
     * @return mixed
     */
    public function httpOrder(Request $request){
        $token = $request->cookie('tokenIndex');
        $data['u_id'] = JWT::getTokenUID($token);
        if($data['u_id']==0){
            $ret['res']['code']=0;
            $ret['res']['msg']='请您登陆';
        }
        else{
            $data['p_id'] = $request->input('p_id',0);
            $data['type'] = $request->input('type','');
            $rules = [
                'p_id'=>'numeric|min:1',
                'type'=>'required|in:alipay,wechat',
            ];

            $messages = [
                'p_id.numeric' => '套餐选择异常',
                'p_id.min' => '套餐选择异常',
                'type.required' => '支付类型必填',
                'type.in' => '支付类型异常',
            ];
            $ret['res'] = $this->validatorData($request,$rules,$messages);
            $ret['data']=$data;
            $ret['data']['num'] = 1;
            $ret['data']['charge_u_id'] = $data['u_id'];
        }
        return $ret;
    }

    /**
     * 扫描订单状态
     * @param $order_no
     * @return string
     */
    public function scanOrder($o_id){
        $res = OrderModel::scan($o_id);
        if($res==1){
            return $this->returnJson(1,'支付成功');
        }
        else{
            return $this->returnJson(0,'支付未成功');
        }
    }
}
