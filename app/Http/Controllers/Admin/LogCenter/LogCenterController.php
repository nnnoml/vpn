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

    public function index(Request $request,$isPage=0){
        $res = [];
        $date_list = [];
        $date = $request->input('date','');
        $pn = $request->input('pn',1)-1;
        $pc = $request->input('pc',20);

        $data['uname'] = $request->input('uname',null);
        $data['sip'] = $request->input('sip',null);
        $data['spt'] = $request->input('spt',null);
        $data['dip'] = $request->input('dip',null);
        $data['dpt'] = $request->input('dpt',null);
        $data['mip'] = $request->input('mip',null);
        $data['mpt'] = $request->input('mpt',null);

        //ajax 进来 直接返回json
        if($isPage){
            if($date!='' && isset(explode(' - ',$date)[0]) && isset(explode(' - ',$date)[1]) ) {
                $data['st'] = strtotime(explode(' - ', $date)[0]);
                $data['et'] = strtotime(explode(' - ', $date)[1]);
            }
            else{
                $data['st'] = 0;
                $data['et'] = 0;
            }
            $res = $this->getData($data,$pc,$pn);
            return $this->returnJson(1,$res);
        }

        //前端传递时间
        if($date!='' && isset(explode(' - ',$date)[0]) && isset(explode(' - ',$date)[1]) ) {
            $data['st'] = strtotime(explode(' - ', $date)[0]);
            $data['et'] = strtotime(explode(' - ', $date)[1]);

            //开始结束时间戳 不修改
            $start = strtotime(date('Y-m-d H:i:s',$data['st']));
            $end = strtotime(date('Y-m-d H:i:s',$data['et']));

            //分片时间戳
            $start_cache = $start;
            //结束时间
            $end_cache = strtotime(date('Y-m-d',$start_cache).' 23:59:59');

            //符合条件循环
            while($start_cache<$end){
                $end_cache = $end_cache>$end ?$end:$end_cache;
//                echo date('Y-m-d H:i:s',$start_cache).'-'.date('Y-m-d H:i:s',$end_cache);
//                echo "<br />";
                $data['st'] = $start_cache;
                $data['et'] = $end_cache;
                $res[] = $this->getData($data,$pc,$pn);
                $date_list[] = date('Y-m-d',$start_cache);
                //循环遍历下一天的数据
                $start_cache = strtotime(date('Y-m-d',$start_cache).' 00:00:00')+86400;
                $end_cache = strtotime(date('Y-m-d',$start_cache).' 23:59:59');
            }
//            $this->d($res);
//            return;
        }
        //前端未传递时间 直接走
        else{
            $data['st'] = 0;
            $data['et'] = 0;
            $res[] = $this->getData($data,$pc,$pn);
            $date_list = [date('Y-m-d')];
        }
        return view('Admin.LogCenter.index',array_merge($this->ret_data,compact('res','pn','data','date','date_list')));
    }

    /**
     * 根据参数获取日志
     * @param $data
     * @return mixed
     */
    public function getData($data,$pc,$pn){
        $parame = '';
        foreach ($data as $key=>$vo) {
            if(isset($vo)){
                if($parame == ''){
                    $parame .= '?';
                }
                else{
                    $parame .= '&';
                }
                $parame.= $key.'='.$vo;
            }
        }

        //总数
        $url = config('sys_conf.C_Log_server').'/getlogcount'.$parame;
        $res['count'] = json_decode($this->httpGet($url),true)['logcnt'];
        //列表
        $url = config('sys_conf.C_Log_server').'/getuserlog'.$parame.'&pc='.$pc.'&pn='.$pn;
        $res['list'] = json_decode($this->httpGet($url),true)['logs'];

        return $res;
    }
}
