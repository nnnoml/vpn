<?php

namespace App\Http\Controllers\Admin\Login;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Common\Plug\JWT;
use App\Http\Model\SysModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    use Common;

    public function login(){
        $title = '登陆';
        return view('Admin.Login.index',compact('title'));
    }

    public function loginDo(Request $request)
    {
        $account = $request->input('account','');
        $pwd = $request->input('pwd','');

        $rules = [
            'account'=>'required',
            'pwd'=>'required'
        ];

        $messages = [
            'account.required' => '请填写账号',
            'pwd.required' => '请填写密码',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $login_res = SysModel::checkLogin($account,sha1($pwd));
            if($login_res['code'] == 1){
                $jwt_payload = array('u_id'=>$login_res['info']['id']);
                $jwt_token = JWT::getToken($jwt_payload);
                return response()->json([
                    'code'=>1,
                    'account'=>$login_res['info']['account']
                    ])->cookie('token',$jwt_token);
            }
            else{
                return $this->returnJson(0,$login_res['info']);
            }
        }
    }

    /**
     * 登出 直接退出到login
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginOut()
    {
        //删除cookie
        Cookie::queue(Cookie::forget('token'));
        return redirect()->action('\App\Http\Controllers\Admin\Login\LoginController@login');
    }

}
