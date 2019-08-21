<?php

namespace App\Http\Controllers\Index\User;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Common\Plug\JWT;
use App\Http\Controllers\Index\IndexController;
use App\Http\Model\OrderModel;
use Illuminate\Http\Request;

class OrderListController extends IndexController
{
    use Common;
    public function getList(Request $request,$u_id=0){
        $page = $request->input('page',1);
        $limit = $request->input('limit',20);
        $pay_status = $request->input('pay_status','');
        if($u_id==0){
            $token = $request->cookie('tokenIndex');
            $u_id = JWT::getTokenUID($token);
        }
        $res = OrderModel::getOrderList($u_id,$page,$limit,$pay_status);
//        $res = OrderModel::getOrderList($u_id);
        if($request->ajax()){
            return $this->returnJson(1,$res);
        }
        else{
            return $res;
        }
    }
}
