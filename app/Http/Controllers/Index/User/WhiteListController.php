<?php

namespace App\Http\Controllers\Index\User;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Common\Plug\JWT;
use App\Http\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhiteListController extends Controller
{
    use Common;

    public function showList($u_id){
        $app_key = UserModel::userAppKey($u_id);
        $url = config('sys_conf.C_server').'/showwhiteip?appkey='.$app_key;
        $res = json_decode($this->httpGet($url),true);
//        $res = '{"result":1, "ips":"192.168.1.5,192.168.1.8"}';
//        $res = json_decode($res,true);
        if($res['result']==1){
            return explode(',',$res['ips']);
        }
        else{
            return [];
        }

    }

    public function store(Request $request){
        $ip = $request->post('ip','');
        $token = $request->cookie('tokenIndex');
        $u_id = JWT::getTokenUID($token);
        $app_key = UserModel::userAppKey($u_id);
        $pattern= '/((2(5[0-5]|[0-4]\d))|[0-1]?\d{1,2})(\.((2(5[0-5]|[0-4]\d))|[0-1]?\d{1,2})){3}/';
        if(preg_match($pattern,$ip)){
            //通知接口 等回信 同步
            $url = config('sys_conf.C_server').'/addwhiteip?ips='.$ip.'&appkey='.$app_key;
            $res = json_decode($this->httpGet($url),true);

            if($res['result'] == 1){//成功更换状态
                return $this->returnJson(1,'添加成功');
            }
            else{
                return $this->returnJson(0,'添加失败');
            }

        }
        else{
            return $this->returnJson(0,'ip格式错误');
        }
    }

    public function destroy(Request $request,$ip){
        $token = $request->cookie('tokenIndex');
        $u_id = JWT::getTokenUID($token);
        $app_key = UserModel::userAppKey($u_id);
        $pattern= '/((2(5[0-5]|[0-4]\d))|[0-1]?\d{1,2})(\.((2(5[0-5]|[0-4]\d))|[0-1]?\d{1,2})){3}/';
        if(preg_match($pattern,$ip)){
            //通知接口 等回信 同步
            $url = config('sys_conf.C_server').'/delwhiteip?ips='.$ip.'&appkey='.$app_key;
            $res = json_decode($this->httpGet($url),true);

            if($res['result'] == 1){//成功更换状态
                return $this->returnJson(1,'删除成功');
            }
            else{
                return $this->returnJson(0,'删除失败');
            }
        }
        else{
            return $this->returnJson(0,'ip格式错误');
        }
    }
}
