<?php

namespace App\Http\Controllers\Index\GetIp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = '获取IP';
        $this->ret_data['nav'] = 'getIp';
    }

    public function Index(){
        return view('Index.GetIp.index',array_merge($this->ret_data));
    }
}
