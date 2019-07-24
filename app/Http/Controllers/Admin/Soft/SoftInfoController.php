<?php

namespace App\Http\Controllers\Admin\Soft;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Controller;
use App\Http\Model\SoftModel;
use Illuminate\Http\Request;

class SoftInfoController extends Controller
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
        $list = SoftModel::getSoftInfoList();
        foreach($list as $key=>$vo){
            $list[$key]['soft_byte_format'] = $this->formatByte($vo['soft_byte']);
        }
        return view('Admin.Soft.soft_info_index',array_merge($this->ret_data,compact('list')));
    }

    public function store(Request $request){
        $data['soft_name'] = $request->input('soft_name','');
        $data['soft_version'] = $request->input('soft_version','');
        $data['download_count'] = $request->input('download_count',0);
        $data['desc'] = $request->input('desc','');
        $data['soft_download_url'] = $request->input('soft_download_url','');
        $data['on_show'] = $request->input('on_show',0);

        $rules = [
            'soft_name'=>'required',
            'soft_version'=>'required',
            'download_count'=>'required|integer',
            'desc'=>'required',
            'soft_download_url'=>'required',
        ];

        $messages = [
            'soft_name.required' => '软件名称必填',
            'soft_version.required' => '软件版本必填',
            'download_count.required' => '下载次数必填',
            'desc.required' => '软件描述必填',
            'soft_download_url.required' => '软件下载地址必填',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = SoftModel::addOrUpdateSoftInfo(0,$data);
            if($res){
                return $this->returnJson(1,'新增成功');
            }
            else{
                return $this->returnJson(0,'新增失败 请重试');
            }
        }
    }

    public function update(Request $request,$id){
        $data['soft_name'] = $request->input('soft_name','');
        $data['soft_version'] = $request->input('soft_version','');
        $data['download_count'] = $request->input('download_count',0);
        $data['desc'] = $request->input('desc','');
        $data['soft_download_url'] = $request->input('soft_download_url','');
        $data['on_show'] = $request->input('on_show',0);

        $rules = [
            'soft_name'=>'required',
            'soft_version'=>'required',
            'download_count'=>'required|integer',
            'desc'=>'required',
            'soft_download_url'=>'required',
        ];

        $messages = [
            'soft_name.required' => '软件名称必填',
            'soft_version.required' => '软件版本必填',
            'download_count.required' => '下载次数必填',
            'desc.required' => '软件描述必填',
            'soft_download_url.required' => '软件下载地址必填',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = SoftModel::addOrUpdateSoftInfo($id,$data);
            if($res){
                return $this->returnJson(1,'修改成功');
            }
            else{
                return $this->returnJson(0,'修改失败 请重试');
            }
        }
    }

    public function destroy($id){
        $res = SoftModel::delSoftInfo((int)$id);
        if($res){
            return $this->returnJson(1,'成功');
        }
        else{
            return $this->returnJson(0,'失败');
        }
    }

}
