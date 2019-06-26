<?php

namespace App\Http\Controllers\Admin\Help;

use App\Http\Controllers\Common\Common;
use App\Http\Model\HelpClassModel;
use App\Http\Model\HelpDetailModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpDetailController extends Controller
{
    use Common;
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = '帮助内容';
        $this->ret_data['nav'] = 'help';
        $this->ret_data['nav2'] = 'help_detail';
    }

    public function index(Request $request){
        $page = $request->input('page',1);
        $limit = $request->input('limit',20);
        $res = HelpDetailModel::getList($page,$limit);
        return view('Admin.Help.detail_index',array_merge($this->ret_data,compact('res','page')));
    }

    public function create(){
        $this->ret_data['title'] .= ' 添加';
        $id=0;
        $class_list = HelpClassModel::getList();
        return view('Admin.Help.detail_handle',array_merge($this->ret_data,compact('id','class_list')));
    }

    public function store(Request $request){
        $title = $request->input('title','');
        $order = $request->input('order','');
        $hc_id = $request->input('hc_id',0);
        $on_show = $request->input('on_show',0);
        $content = $request->input('content','');

        $rules = [
            'title'=>'required',
            'order'=>'integer',
            'hc_id'=>'required|integer',
            'on_show'=>'integer',
            'content'=>'required'
        ];

        $messages = [
            'title.required' => '标题必填',
            'order.integer' => '排序异常',
            'hc_id.required' => '分类必选',
            'hc_id.integer' => '分类异常',
            'on_show.integer' => '展示异常',
            'content.required' => '内容必填'
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = HelpDetailModel::addDetail(compact('title','order','hc_id','on_show','content'));
            if($res){
                return $this->returnJson(1,'新增成功');
            }
            else{
                return $this->returnJson(0,'新增失败 请重试');
            }
        }
    }

    public function edit($id){
        $this->ret_data['title'] .= ' 修改';
        $info = HelpDetailModel::getInfo($id);
        $class_list = HelpClassModel::getList();
        return view('Admin.Help.detail_handle',array_merge($this->ret_data,compact('id','info','class_list')));
    }

    public function update(Request $request,$id){
        $title = $request->input('title','');
        $order = $request->input('order','');
        $hc_id = $request->input('hc_id',0);
        $on_show = $request->input('on_show',0);
        $content = $request->input('content','');

        $rules = [
            'title'=>'required',
            'order'=>'integer',
            'hc_id'=>'required|integer',
            'on_show'=>'integer',
            'content'=>'required'
        ];

        $messages = [
            'title.required' => '标题必填',
            'order.integer' => '排序异常',
            'hc_id.required' => '分类必选',
            'hc_id.integer' => '分类异常',
            'on_show.integer' => '展示异常',
            'content.required' => '内容必填'
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = HelpDetailModel::updateDetail($id,compact('title','order','hc_id','on_show','content'));
            if($res!==false){
                return $this->returnJson(1,'成功');
            }
            else{
                return $this->returnJson(0,'失败');
            }
        }
    }

    public function destroy($id){
        $res = HelpDetailModel::deleteDetail((int)$id);
        if($res){
            return $this->returnJson(1,'成功');
        }
        else{
            return $this->returnJson(0,'失败');
        }
    }
}
