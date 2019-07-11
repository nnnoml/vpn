<?php

namespace App\Http\Controllers\Index\Order;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Common\Plug\JWT;
use App\Http\Model\OrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    use Common;
    //TODO 新的支付方式
    public function setOrder(Request $request){
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

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else {
            $res = OrderModel::addOrder($data);
            if(is_numeric($res)){
                return $this->returnJson(1,'下单成功',['o_id'=>$res,'img_url'=>'http://www.baidu.com']);
            }
            else{
                return $this->returnJson(0,$res);
            }
        }
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
