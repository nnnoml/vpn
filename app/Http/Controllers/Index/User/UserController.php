<?php

namespace App\Http\Controllers\Index\User;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Common\Plug\JWT;
use App\Http\Controllers\Index\IndexController;
use App\Http\Model\OrderModel;
use App\Http\Model\SysModel;
use App\Http\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class UserController extends IndexController
{
    use Common;

    public function __construct()
    {
        parent::__construct();
        $this->ret_data['sys_conf']['title'] = '用户中心 '.$this->ret_data['sys_conf']['title'];
        $this->ret_data['nav'] = 'user';
    }

    public function Index(Request $request){
        $token = $request->cookie('tokenIndex');
        $u_id = JWT::getTokenUID($token);
        $info = UserModel::userInfo($u_id);
        $order_list = OrderModel::getOrderList($u_id);
        $white_list = (new WhiteListController())->showList($u_id);
        $use_money_list = (new UseMoneyController())->getList($request,$u_id);
        return view('Index.User.index',array_merge($this->ret_data,compact('info','order_list','white_list','use_money_list')));
    }

    public function regDo(Request $request){
        $account = $request->input('username','');
        $pwd = $request->input('password','');
        $sms_code = $request->input('sms_code','');
        //tips 19.7.26 注册不能再次验证验证码 短信已经验证过了 不然会重复输入两次
        $rules = [
            'username'=>'required',
            'password'=>'required|min:6|max:12',
//            'verify' => 'required|captcha',
            'sms_code' => 'required',
        ];

        $messages = [
            'username.required' => '请填写账号',
            'password.required' => '请填写密码',
            'password.min' => '密码最小6位 最长12位',
            'password.max' => '密码最小6位 最长12位',
//            'verify.required' => '请填写验证码',
//            'verify.captcha' => '验证码错误',
            'sms_code.required' => '短信验证码错误'
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $pwd = $this->rc4($pwd);
            $appkey = $this->appKey();
            $res = userModel::addUser(compact('account','pwd','appkey','sms_code'));
            if($res['code'] == 1){
                $jwt_payload = array('u_id'=>$res['u_id']);

                $jwt_token = JWT::getToken($jwt_payload);
                return response()->json([
                    'code'=>1,
                    'account'=>$account,
                    'nickname'=>''
                ])->cookie('tokenIndex',$jwt_token);
            }
            else{
                return $this->returnJson(0,$res['msg']);
            }
        }
    }

    public function loginDo(Request $request){
        $account = $request->input('username','');
        $pwd = $request->input('password','');
        $remember = $request->input('remember',0);
        $keep = 1; //token时间，1默认长度
        if($remember){
            $keep = 24*10;//10天有效期
        }
        $rules = [
            'username'=>'required',
            'password'=>'required',
        ];

        $messages = [
            'username.required' => '请填写账号',
            'password.required' => '请填写密码',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $login_res = userModel::checkLogin($account,$this->rc4($pwd));
            if($login_res['code'] == 1){
                $jwt_payload = array('u_id'=>$login_res['info']['u_id']);

                $jwt_token = JWT::getToken($jwt_payload,$keep);
                //原始返回值
//                return response()->json([
//                    'code'=>1,
//                    'account'=>$login_res['info']['account'],
//                    'nickname'=>$login_res['info']['nickname']
//                ])->cookie('tokenIndex',$jwt_token);
               Cookie::queue('tokenIndex', $jwt_token, $keep*60);
                return response()->json([
                    'code'=>1,
                    'account'=>$login_res['info']['account'],
                    'nickname'=>$login_res['info']['nickname']
                ]);
            }
            else{
                return $this->returnJson(0,$login_res['info']);
            }
        }
    }

    public function loginOut(){
        //删除cookie
        Cookie::queue(Cookie::forget('tokenIndex'));
        return redirect()->action('\App\Http\Controllers\Index\Index\IndexController@Index');
    }

    public function getSms(Request $request){
        $tel = $request->input('tel','');
        $type = $request->input('type','');
        $rules = [
            'tel' => ['required','regex:/^1[3|4|5|7|8|9]\d{9}$/'],
            'type'=>'required|in:1,2',
            'verify' => 'required|captcha',
        ];

        $messages = [
            'tel.required' => '请填写手机号',
            'tel.regex' => '手机号码格式有误',
            'type.required' => '短信类型异常',
            'type.in' => '短信类型异常',
            'verify.required' => '请填写验证码',
            'verify.captcha' => '验证码错误',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $code = rand(1000,9999);
            $send_res = $this->sendSms($tel,$code,$type);
            if($send_res){
                $res = SysModel::saveSmsCode($tel,$code,$type);
                if($res){
                    return $this->returnJson(1,'发送成功');
                }
            }
            return $this->returnJson(0,'发送失败');
        }

    }

    /**
     * 用户未登陆 修改密码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function changePWD(Request $request){
        $account = $request->input('account','');
        $pwd = $request->input('password','');
        $sms_code = $request->input('sms_code','');
        $rules = [
            'account' => ['required','regex:/^1[3|4|5|7|8|9]\d{9}$/'],
            'password'=>'required|min:6|max:12',
            're_password'=>'same:password',
            'verify' => 'required|captcha',
            'sms_code' => 'required',
        ];

        $messages = [
            'account.required' => '请填写账号',
            'account.regex' => '手机号码格式有误',
            'password.required' => '请填写密码',
            'password.min' => '密码最小6位 最长12位',
            'password.max' => '密码最小6位 最长12位',
            're_password.same' => '两次密码不一致',
            'verify.required' => '请填写验证码',
            'verify.captcha' => '验证码错误',
            'sms_code.required' => '短信验证码错误'
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $pwd = $this->rc4($pwd);
            $res = userModel::changePWD(compact('account','pwd','sms_code'));
            if($res['code'] == 1){
                //修改密码后不给新token 之前的继续有效
//                $jwt_payload = array('u_id'=>$res['u_id']);
//                $jwt_token = JWT::getToken($jwt_payload);
//                return response()->json([
//                    'code'=>1,
//                    'account'=>$account,
//                    'nickname'=>''
//                ])->cookie('tokenIndex',$jwt_token);

                return $this->returnJson(1,'修改成功');
            }
            else{
                return $this->returnJson(0,$res['msg']);
            }
        }
    }

    /**
     * 用户已登陆 修改密码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function changePWDLogin(Request $request){
        $token = $request->cookie('tokenIndex');
        $u_id = JWT::getTokenUID($token);
        $old_pwd = $request->input('old_pwd','');
        $new_pwd = $request->input('new_pwd','');

        $rules = [
            'old_pwd'=>'required|min:6|max:12',
            'new_pwd'=>'required|min:6|max:12',
            're_pwd'=>'same:new_pwd',
            'verify' => 'required|captcha',
        ];

        $messages = [
            'old_pwd.required' => '请填写旧密码',
            'old_pwd.min' => '密码最小6位 最长12位',
            'old_pwd.max' => '密码最小6位 最长12位',
            'new_pwd.required' => '请填写新密码',
            'new_pwd.min' => '密码最小6位 最长12位',
            'new_pwd.max' => '密码最小6位 最长12位',
            're_pwd.same' => '两次密码不一致',
            'verify.required' => '请填写验证码',
            'verify.captcha' => '验证码错误',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $old_pwd = $this->rc4($old_pwd);
            $new_pwd = $this->rc4($new_pwd);

            $res = userModel::changePWDLogin(compact('u_id','old_pwd','new_pwd'));
            if($res['code'] == 1){
                return $this->returnJson(1,'修改成功');
            }
            else{
                return $this->returnJson(0,$res['msg']);
            }
        }
    }
}
