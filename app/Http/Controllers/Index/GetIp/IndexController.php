<?php

namespace App\Http\Controllers\Index\GetIp;

use App\Http\Controllers\Common\Common;
use App\Http\Model\HelpDetailModel;
use App\Http\Model\ProductHTypeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    use Common;
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = '获取IP';
        $this->ret_data['nav'] = 'getIp';
    }

    public function Index(){
        $h_type_list = ProductHTypeModel::getList();
        foreach ($h_type_list as $k2 => $v2) {
            $h_type_list[$k2]['start_second_format'] = $this->formatSecond($v2['start_second'],'h');
            $h_type_list[$k2]['end_second_format'] = $this->formatSecond($v2['end_second'],'h');
        }
        $help_list = HelpDetailModel::getList(1,10);

        return view('Index.GetIp.index',array_merge($this->ret_data,compact('h_type_list','help_list')));
    }

    public function formatUrl(Request $request){
        $data = $request->all();
        $url = 'http://www.baidu.com?';
        foreach ($data as $key => $vo) {
            $url.=$key.'='.$vo.'&';
        }
        $url = rtrim($url,'&');

        if($url){
            return $this->returnJson(1,$url);
        }
        else{
            return $this->returnJson(0,'fail');
        }
    }
}
