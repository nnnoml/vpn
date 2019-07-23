<?php

namespace App\Http\Controllers\Admin\VpnConf;

use App\Http\Controllers\Common\Common;
use App\Http\Model\VpnConfModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VpnConfController extends Controller
{
    use Common;
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = 'vpn节点管理';
        $this->ret_data['nav'] = 'vpn_conf';
        $this->ret_data['nav2'] = 'vpn_conf';
    }

    public function index(){
        $list = VpnConfModel::getList();
        $province = $this->getProvince();
        return view('Admin.VpnConf.index',array_merge($this->ret_data,compact('list','province')));
    }

    public function store(Request $request){
        $data['vpn_province'] = $request->input('vpn_province',0);
        $data['vpn_city'] = $request->input('vpn_city',0);
        $data['vpn_operator'] = $request->input('vpn_operator','');
        $data['vpn_protocol'] = $request->input('vpn_protocol','');
        $data['vpn_status'] = $request->input('vpn_status',0);
        $data['online'] = $request->input('online',0);
        $data['vpn_domain'] = $request->input('vpn_domain','');

        $rules = [
            'vpn_province'=>'integer|required',
            'vpn_city'=>'integer|required',
            'vpn_operator'=>'required',
            'vpn_protocol'=>'required',
            'vpn_domain'=>'required',
        ];

        $messages = [
            'vpn_province.integer' => '省份异常',
            'vpn_province.required' => '省份必填',
            'vpn_city.integer' => '城市异常',
            'vpn_city.required' => '城市必填',
            'vpn_operator.required' => '运营商必填',
            'vpn_protocol.required' => '协议必填',
            'vpn_domain.required' => '线路域名必填',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = VpnConfModel::addVpnConf($data);
            if($res){
                return $this->returnJson(1,'新增成功');
            }
            else{
                return $this->returnJson(0,'新增失败 请重试');
            }
        }
    }

    public function update(Request $request,$id){
        $data['vpn_province'] = $request->input('vpn_province',0);
        $data['vpn_city'] = $request->input('vpn_city',0);
        $data['vpn_operator'] = $request->input('vpn_operator','');
        $data['vpn_protocol'] = $request->input('vpn_protocol','');
        $data['vpn_status'] = $request->input('vpn_status',0);
        $data['online'] = $request->input('online',0);
        $data['vpn_domain'] = $request->input('vpn_domain','');

        $rules = [
            'vpn_province'=>'integer|required',
            'vpn_city'=>'integer|required',
            'vpn_operator'=>'required',
            'vpn_protocol'=>'required',
            'vpn_domain'=>'required',
        ];

        $messages = [
            'vpn_province.integer' => '省份异常',
            'vpn_province.required' => '省份必填',
            'vpn_city.integer' => '城市异常',
            'vpn_city.required' => '城市必填',
            'vpn_operator.required' => '运营商必填',
            'vpn_protocol.required' => '协议必填',
            'vpn_domain.required' => '线路域名必填',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = VpnConfModel::updateVpnConf((int)$id,$data);
            if($res){
                return $this->returnJson(1,'更新成功');
            }
            else{
                return $this->returnJson(0,'更新失败 请重试');
            }
        }
    }

    public function destroy($id){
        $res = VpnConfModel::deleteConf((int)$id);
        if($res){
            return $this->returnJson(1,'成功');
        }
        else{
            return $this->returnJson(0,'失败');
        }
    }
}
