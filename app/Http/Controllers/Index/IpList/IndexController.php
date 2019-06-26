<?php

namespace App\Http\Controllers\Index\IpList;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class IndexController extends Controller
{
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = 'ips';
        $this->ret_data['nav'] = 'ipList';
    }

    public function Index(){
        $act_list = [];
        return view('Index.IpList.index',array_merge($this->ret_data,compact('act_list')));
    }

}
