<?php

namespace App\Http\Controllers\Admin\Index;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Common\Plug\JWT;
use App\Http\Controllers\Controller;
use App\Http\Model\SysModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class IndexController extends Controller
{
    use Common;
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = Config::get('sys_conf.web_title');
        $this->ret_data['nav'] = 'conf';
        $this->ret_data['nav2'] = 'conf';
    }

    public function Init(){
        $this->ret_data['sys_conf'] = SysModel::getSysConf();
    }

    public function Index(){
        $this->Init();
        return view('Admin.Index.index',array_merge($this->ret_data));
    }

    public function sysConf(Request $request){
        $data['title'] = $request->input('title','');
        $data['keywords'] = $request->input('keywords','');
        $data['description'] = $request->input('description','');
        $data['qq'] = $request->input('qq','');
        $data['tel'] = $request->input('tel','');
        $data['icp'] = $request->input('icp','');
        $data['comp_name'] = $request->input('comp_name','');
        $data['comp_address'] = $request->input('comp_address','');
        $data['wechat'] = $request->input('wechat','');
        $data['logo'] = $request->input('logo','');
        $data['logo2'] = $request->input('logo2','');
        $res = SysModel::setSysConf($data);
        if($res !==false){
            return $this->returnJson(1,'success');
        }
        else{
            return $this->returnJson(0,'fail');
        }
    }

    public function changePWD(){
        $this->Init();
        return view('Admin.Index.changePWD',array_merge($this->ret_data));
    }
    public function changePWDDo(Request $request){
        $o_pwd = $request->input('o_pwd','');
        $n_pwd = $request->input('n_pwd','');
        $re_pwd = $request->input('re_pwd','');
        $token = $request->cookie('token');
        $u_id = JWT::getTokenUID($token);

        if($o_pwd =='' || $n_pwd == '' || $re_pwd == ''){
            return $this->returnJson(0,'不能为空');
        }
        else{
            if($n_pwd != $re_pwd){
                return $this->returnJson(0,'两次密码不一致');
            }
            else{
                $res = SysModel::changePWD($u_id,$o_pwd,$n_pwd);
                if(!is_numeric($res)){
                    return $this->returnJson(0,$res);
                }
                else{
                    if($res!==false){
                        $login = new \App\Http\Controllers\Admin\Login\LoginController();
                        $login->loginOut();
                        return $this->returnJson(1,'成功');
                    }
                    else{
                        return $this->returnJson(0,'失败');
                    }
                }
            }
        }
    }
}
