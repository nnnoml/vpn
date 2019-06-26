<?php

namespace App\Http\Controllers\Admin\Help;

use App\Http\Controllers\Common\Common;
use App\Http\Model\HelpClassModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpClassController extends Controller
{
    use Common;
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = '帮助分类管理';
        $this->ret_data['nav'] = 'help';
        $this->ret_data['nav2'] = 'help_class';
    }

    public function index(){
        $list = HelpClassModel::getList();
        return view('Admin.Help.class_index',array_merge($this->ret_data,compact('list')));
    }

    public function store(Request $request){
        $parent_id = $request->input('parent_id',0);
        $name = $request->input('name','');

        $rules = [
            'parent_id'=>'integer',
            'name'=>'required'
        ];

        $messages = [
            'parent_id.integer' => '父级id异常',
            'name.required' => '请填写分类名称',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = HelpClassModel::addClass($parent_id,$name);
            if($res){
                return $this->returnJson(1,'新增成功');
            }
            else{
                return $this->returnJson(0,'新增失败 请重试');
            }
        }
    }

    public function update(Request $request,$id){
        $parent_id = $request->input('parent_id',0);
        $name = $request->input('name','');

        $rules = [
            'parent_id'=>'integer',
            'name'=>'required'
        ];

        $messages = [
            'parent_id.integer' => '父级id异常',
            'name.required' => '请填写分类名称',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = HelpClassModel::updateClass($id,$parent_id,$name);
            if($res){
                return $this->returnJson(1,'成功');
            }
            else{
                return $this->returnJson(0,'失败');
            }
        }
    }

    public function destroy($id){
        $res = HelpClassModel::deleteClass((int)$id);
        if($res){
            return $this->returnJson(1,'成功');
        }
        else{
            return $this->returnJson(0,'失败');
        }
    }
}
