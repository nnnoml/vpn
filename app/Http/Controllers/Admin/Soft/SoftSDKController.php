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
        $this->ret_data['title'] = 'sdk信息';
        $this->ret_data['nav'] = 'soft';
        $this->ret_data['nav2'] = 'soft_sdk';
    }

    public function index(){
        $list = SoftModel::getSoftSDKList();
        foreach($list as $key=>$vo){
            $list[$key]['soft_byte_format'] = $this->formatByte($vo['soft_byte']);
        }
        return view('Admin.Soft.soft_sdk_index',array_merge($this->ret_data,compact('list')));
    }

    public function store(Request $request){
        $data['sdk_name'] = $request->input('sdk_name','');
        $data['download_count'] = $request->input('download_count',0);
        $data['desc'] = $request->input('desc','');
        $data['sdk_download_url'] = $request->input('sdk_download_url','');
        $data['on_show'] = $request->input('on_show',0);

        $rules = [
            'sdk_name'=>'required',
            'download_count'=>'required|integer',
            'desc'=>'required',
            'sdk_download_url'=>'required',
        ];

        $messages = [
            'sdk_name.required' => 'SDK名称必填',
            'download_count.required' => '下载次数必填',
            'desc.required' => 'SDK描述必填',
            'sdk_download_url.required' => 'SDK下载地址必填',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = SoftModel::addOrUpdateSoftSDK(0,$data);
            if($res){
                return $this->returnJson(1,'新增成功');
            }
            else{
                return $this->returnJson(0,'新增失败 请重试');
            }
        }
    }

    public function update(Request $request,$id){
        $data['sdk_name'] = $request->input('sdk_name','');
        $data['download_count'] = $request->input('download_count',0);
        $data['desc'] = $request->input('desc','');
        $data['sdk_download_url'] = $request->input('sdk_download_url','');
        $data['on_show'] = $request->input('on_show',0);

        $rules = [
            'sdk_name'=>'required',
            'download_count'=>'required|integer',
            'desc'=>'required',
            'sdk_download_url'=>'required',
        ];

        $messages = [
            'sdk_name.required' => 'SDK名称必填',
            'download_count.required' => '下载次数必填',
            'desc.required' => 'SDK描述必填',
            'sdk_download_url.required' => 'SDK下载地址必填',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = SoftModel::addOrUpdateSoftSDK($id,$data);
            if($res){
                return $this->returnJson(1,'修改成功');
            }
            else{
                return $this->returnJson(0,'修改失败 请重试');
            }
        }
    }

    public function destroy($id){
        $res = SoftModel::delSoftSDK((int)$id);
        if($res){
            return $this->returnJson(1,'成功');
        }
        else{
            return $this->returnJson(0,'失败');
        }
    }
}
