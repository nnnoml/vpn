<?php

namespace App\Http\Controllers\Index\User;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Common\Plug\JWT;
use App\Http\Controllers\Common\TaskController;
use App\Http\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    use Common;
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = Config::get('sys_conf.web_title');
        $this->ret_data['nav'] = '';
    }

    public function Index(Request $request){
        $token = $request->cookie('tokenIndex');
        $info = UserModel::userInfo(JWT::getTokenUID($token));
        return view('Index.User.index',array_merge($this->ret_data,compact('info')));
    }

    public function regDo(Request $request){
        $account = $request->input('username','');
        $pwd = $request->input('password','');
        $sms_code = $request->input('sms_code','');
        $rules = [
            'username'=>'required',
            'password'=>'required|min:6|max:12',
            'verify' => 'required|captcha',
            'sms_code' => 'required',
        ];

        $messages = [
            'username.required' => '请填写账号',
            'password.required' => '请填写密码',
            'password.min' => '密码最小6位 最长12位',
            'password.max' => '密码最小6位 最长12位',
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
            $keep = 10;
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
                return response()->json([
                    'code'=>1,
                    'account'=>$login_res['info']['account'],
                    'nickname'=>$login_res['info']['nickname']
                ])->cookie('tokenIndex',$jwt_token);
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
        //todo 模拟发短信
        return $this->returnJson(1,'发送成功');
    }

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
}
