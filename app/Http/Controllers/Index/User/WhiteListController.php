<?php

namespace App\Http\Controllers\Index\User;

use App\Http\Controllers\Common\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhiteListController extends Controller
{
    use Common;
    public function store(Request $request){
        $ip = $request->post('ip','');
        $pattern= '/((2(5[0-5]|[0-4]\d))|[0-1]?\d{1,2})(\.((2(5[0-5]|[0-4]\d))|[0-1]?\d{1,2})){3}/';
        if(preg_match($pattern,$ip)){
            //通知接口 等回信 同步 //TODO
        }
        else{
            return $this->returnJson(0,'ip格式错误');
        }
    }

    public function destory(){

    }
}
