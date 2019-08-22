<?php

namespace App\Http\Controllers\Index\Order;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Common\Plug\JWT;
use App\Http\Controllers\Index\IndexController;
use App\Http\Model\OrderModel;
use App\Http\Model\UserModel;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends IndexController
{
    use Common;
    public function addOrder(Request $request,$type){

        //不同产品类型不同处理方式
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
            return;
            if (is_numeric($res)) {
                //微信直接下单
                if($v_res['data']['type'] == 'wechat'){

                    $wechat = new WechatController();
                    $wechat_res = $wechat->wechat($res);
                    if($wechat_res->return_code =='SUCCESS'){
                        return $this->returnJson(1, '下单成功', ['o_id' => $res, 'img_url' => $wechat_res->code_url]);
                    }
                    else{
                        return $this->returnJson(0, 'order verify error');
                    }
                }
                else if($v_res['data']['type'] == 'alipay'){
                    return $this->returnJson(1, '下单成功', ['o_id' => $res]);
                }
                else{
                    return $this->returnJson(0, 'error pay type');
                }
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
     * 根据参数生成二维码 微信扫码使用
     * @param $url
     * @return mixed
     */
    public function qrCode(Request $request){
        $url = $request->input('url','');
        return QrCode::format('png')->errorCorrection('H')->size(200)->generate($url);
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

    /**
     * TODO 假装付款成功
     * @param $order_no 里面传递电话
     */
    public function test($order_no){
        $u_id = UserModel::where('account',$order_no)->value('u_id');
        if(!$u_id){
            echo "user empty";
            return;
        }

        $order_no = OrderModel::where('charge_u_id',$u_id)->where('pay_status',0)->limit(1)->orderby('o_id','desc')->value('order_no');
        if(!$order_no){
            echo "order empty";
            return;
        }

        $res = OrderModel::setOrder($order_no);

        if($res == 1){
            echo "success";
            return;
        }
        else{
            echo "fail ".$res;
            return;
        }
    }
}
