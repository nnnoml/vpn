<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Common\Common;
use App\Http\Model\ArticleClassModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleClassController extends Controller
{
    use Common;
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = '文章分类管理';
        $this->ret_data['nav'] = 'article';
        $this->ret_data['nav2'] = 'article_class';
    }

    public function index(){
        $list = ArticleClassModel::getList();
        return view('Admin.Article.class_index',array_merge($this->ret_data,compact('list')));
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
            $res = ArticleClassModel::addClass($parent_id,$name);
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
            $res = ArticleClassModel::updateClass($id,$parent_id,$name);
            if($res){
                return $this->returnJson(1,'成功');
            }
            else{
                return $this->returnJson(0,'失败');
            }
        }
    }

    public function destroy($id){
        $res = ArticleClassModel::deleteClass((int)$id);
        if($res){
            return $this->returnJson(1,'成功');
        }
        else{
            return $this->returnJson(0,'失败');
        }
    }
}
