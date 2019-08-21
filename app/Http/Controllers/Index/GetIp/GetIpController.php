<?php

namespace App\Http\Controllers\Index\GetIp;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Common\Plug\JWT;
use App\Http\Controllers\Index\IndexController;
use App\Http\Model\HelpDetailModel;
use App\Http\Model\ProductHTypeModel;
use App\Http\Model\UserModel;
use Illuminate\Http\Request;

class GetIpController extends IndexController
{
    use Common;

    public function __construct()
    {
        parent::__construct();
        $this->ret_data['sys_conf']['title'] = '获取IP '.$this->ret_data['sys_conf']['title'];
        $this->ret_data['nav'] = 'getIp';
    }

    public function Index(Request $request){
        $h_type_list = ProductHTypeModel::getList();
        foreach ($h_type_list as $k2 => $v2) {
            $h_type_list[$k2]['start_second_format'] = $this->formatSecond($v2['start_second'],'h');
            $h_type_list[$k2]['end_second_format'] = $this->formatSecond($v2['end_second'],'h');
        }
        $help_list = HelpDetailModel::getList(1,10);

        $token = $request->cookie('tokenIndex','');
        $u_id = JWT::getTokenUID($token);
        $user_info = UserModel::userInfo($u_id);

        $province = $this->getProvince();

        return view('Index.GetIp.index',array_merge($this->ret_data,compact('h_type_list','help_list','user_info','province')));
    }

    public function formatUrl(Request $request){
        $token = $request->cookie('tokenIndex','');
        $u_id = JWT::getTokenUID($token);
        if($u_id == 0){
            return $this->returnJson(0,'请您登陆');
        }
        //leee 19.8.16修改 新增判断 金钱不够的情况下 不给链接
            //用户现在有多少钱
        $user_info = UserModel::userInfo($u_id);
            //用户选的是哪个时长
        $product_h_type = $request->input('time',0);
        $product_h_type_info = ProductHTypeModel::getDetail($product_h_type);
            //用户选的是多少量
        $num = $request->input('num',0);
            //钱够不够
        if($user_info['money'] < $product_h_type_info['price']*100*$num){
            return $this->returnJson(0,'余额不足，请先充值');
        }

        $userAppKey = UserModel::userAppKey($u_id);
        $data = $request->all();
        $url = config('sys_conf.C_IP_server').'?appkey='.$userAppKey;
        foreach ($data as $key => $vo) {
            $url.='&'.$key.'='.$vo;
        }

        if($url){
            return $this->returnJson(1,$url);
        }
        else{
            return $this->returnJson(0,'fail');
        }
    }
}
