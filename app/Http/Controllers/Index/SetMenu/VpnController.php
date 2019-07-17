<?php

namespace App\Http\Controllers\Index\SetMenu;

use App\Http\Controllers\Common\Plug\JWT;
use App\Http\Controllers\Index\IndexController;
use App\Http\Model\ProductModel;
use App\Http\Controllers\Controller;
use App\Http\Model\UserModel;
use Illuminate\Http\Request;

class VpnController extends IndexController
{

    public function __construct()
    {
        parent::__construct();
        $this->ret_data['sys_conf']['title'] = 'vpn套餐购买 '.$this->ret_data['sys_conf']['title'];
        $this->ret_data['nav'] = 'setMenu_vpn';
        $this->ret_data['logo2'] = true;
    }

    public function Index(Request $request){
        $list = ProductModel::getIndexList(1);
        $token = $request->cookie('tokenIndex');
        $u_id = JWT::getTokenUID($token);
        $account = UserModel::where('u_id',$u_id)->value('account');
        return view('Index.SetMenu.vpn_index',array_merge($this->ret_data,compact('list','account')));
    }
}
