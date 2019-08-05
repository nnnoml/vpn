<?php

namespace App\Http\Controllers\Index\IpList;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Index\IndexController;
use App\Http\Model\IpListModel;
use Illuminate\Http\Request;

class IpListController extends IndexController
{
    use Common;

    public function __construct()
    {
        parent::__construct();
        $this->ret_data['sys_conf']['title'] = 'ip列表 '.$this->ret_data['sys_conf']['title'];
        $this->ret_data['nav'] = 'ipList';
        $this->ret_data['logo2'] = true;
    }

    public function Index(Request $request)
    {
        $key = $request->input('key','');
        $export = $request->input('export','');
        $list = IpListModel::lists($key);
        if($export){
            if(!empty($list)){
                foreach ($list as $key => $vo) {
                    $list[$key]['vpn_status'] = $vo['vpn_status'] == 1 ? '可用':'不可用';
                }
                $header_data = ['id','省份','城市','运营商','协议','状态','线路域名'];
                $cols = ['vpn_id','vpn_province_format','vpn_city_format','vpn_operator','vpn_protocol','vpn_status','vpn_domain'];
                $filename = 'IpList_'.date('Y-m-d H:i:s').'.csv';
                return $this->export_csv($list,$header_data,$cols,$filename);
            }else{
                return $this->returnJson(0,'暂无数据');
            }
        }
        else{
            return view('Index.IpList.index',array_merge($this->ret_data,compact('list','key')));
        }
    }
}
