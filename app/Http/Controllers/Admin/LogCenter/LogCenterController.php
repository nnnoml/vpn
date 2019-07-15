<?php

namespace App\Http\Controllers\Admin\LogCenter;

use App\Http\Controllers\Common\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogCenterController extends Controller
{
    use Common;
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = '日志中心管理';
        $this->ret_data['nav'] = 'log_center';
        $this->ret_data['nav2'] = 'log_center';
    }

    public function index(Request $request){
        //TODO 等待接入日志
        $list = [];
        return view('Admin.LogCenter.index',array_merge($this->ret_data,compact('list')));
    }
}
