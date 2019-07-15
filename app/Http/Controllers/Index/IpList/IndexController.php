<?php

namespace App\Http\Controllers\Index\IpList;

use App\Http\Controllers\Common\Common;
use App\Http\Model\IpListModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    use Common;
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = 'ips';
        $this->ret_data['nav'] = 'ipList';
    }

    public function Index(Request $request)
    {
        $key = $request->input('key','');
        $export = $request->input('export','');
        $list = IpListModel::lists($key);
        if($export){
            //TODO 城市列表导出 export异常
//            $list=$this->arrayToObject($list);
//            if(!empty($list)){
//                $header_data = ['用户ID','用户账号','用户昵称','会员等级','消费金额','订单数量','可用积分','用户状态'];
//                $cols = ['user_id','user_tel','user_name','member_rank_name','sum(order_amount)','user_count','point','user_status'];
//                $filename = date('Y-m-d').'-'.mt_rand(1000,9999).'.csv';
//                $this->export_csv($list,$header_data,$cols,$filename);
//            }else{
//                return $this->returnJson(0,'暂无数据');
//            }

        }
        else{
            return view('Index.IpList.index',array_merge($this->ret_data,compact('list','key')));
        }
    }
}
