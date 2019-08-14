<?php

namespace App\Http\Controllers\Index\User;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Common\Plug\JWT;
use App\Http\Controllers\Index\IndexController;
use App\Http\Model\UseMoneyModel;
use Illuminate\Http\Request;

class UseMoneyController extends IndexController
{
    use Common;
    public function getList(Request $request,$u_id=0){
        $page = $request->input('page',1);
        $limit = $request->input('limit',20);
        $date = $request->input('date','');
        $st = '';
        $et = '';
        if($date){
            $date_exp = explode(' - ',$date);
            isset($date_exp[0])? $st=$date_exp[0].' 00:00:00':'';
            isset($date_exp[1])? $et=$date_exp[1].' 23:59:59':'';
        }
        if($u_id==0){
            $token = $request->cookie('tokenIndex');
            $u_id = JWT::getTokenUID($token);
        }
        $res = UseMoneyModel::lists($u_id,$this,$page,$limit,$st,$et);
        $res['date'] = $date;
        if($request->ajax()){
            return $this->returnJson(1,$res);
        }
        else{
            return $res;
        }
    }
}
