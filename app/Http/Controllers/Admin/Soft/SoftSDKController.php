<?php

namespace App\Http\Controllers\Admin\Soft;

use App\Http\Controllers\Common\Common;
use App\Http\Model\SoftModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SoftSDKController extends Controller
{
    use Common;
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = '软件信息';
        $this->ret_data['nav'] = 'soft';
        $this->ret_data['nav2'] = 'soft_info';
    }

    public function index(){
        echo "TODO";
//        $list = SoftModel::getSoftInfoList();
//        foreach($list as $key=>$vo){
//            $list[$key]['soft_byte_format'] = $this->formatByte($vo['soft_byte']);
//        }
//        return view('Admin.Soft.soft_info_index',array_merge($this->ret_data,compact('list')));
    }
}
