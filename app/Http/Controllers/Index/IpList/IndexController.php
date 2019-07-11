<?php

namespace App\Http\Controllers\Index\IpList;

use App\Http\Model\IpListModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = 'ips';
        $this->ret_data['nav'] = 'ipList';
    }

    public function Index(){
        $act_list = IpListModel::lists();
        return view('Index.IpList.index',array_merge($this->ret_data,compact('act_list')));
    }

}
