<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Common\Common;
use App\Http\Model\ProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    use Common;
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = '产品信息';
        $this->ret_data['nav'] = 'product';
        $this->ret_data['nav2'] = 'product';
    }

    public function index(){
        $list = ProductModel::getList();
        foreach($list as $key=>$vo){
            $list[$key]['time_len_format'] = $this->formatSecond($vo['time_length']);
        }
        return view('Admin.Product.product',array_merge($this->ret_data,compact('list')));
    }

    public function create(){
        $id=0;
        $info = ProductModel::getList();
        return view('Admin.Product.product_handle',array_merge($this->ret_data,compact('info','id')));
    }

    public function store(Request $request){
        $money = $request->input('money',0)*100;
        $money_sub = $request->input('money_sub',0)*100;
        $money_add = $request->input('money_add',0)*100;
        $time_length = $request->input('time_length',0);
        $type = $request->input('type',0);
        $h_type = $request->input('h_type',0);
        $h_type_id = '1,2,3,4,5';
        $on_show = $request->input('on_show',0);
        $desc = $request->input('desc','');
        $rules = [
            'money'=>'numeric',
            'money_sub'=>'numeric',
            'money_add'=>'numeric',
            'time_length'=>'integer',
            'type'=>'integer',
            'h_type'=>'integer',
            'on_show'=>'integer'
        ];

        $messages = [
            'money.numeric' => '金额异常',
            'money_sub.numeric' => '充值满减异常',
            'money_add.numeric' => '充值赠送异常',
            'time_length.integer' => '时长异常',
            'type.integer' => '类型异常',
            'h_type.integer' => '按次类型异常',
            'on_show.integer' => '展示异常',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = ProductModel::add(compact('money','money_sub','money_add','time_length','type','h_type','h_type_id','on_show','desc'));
            if($res){
                return $this->returnJson(1,'新增成功');
            }
            else{
                return $this->returnJson(0,'新增失败 请重试');
            }
        }
    }

    public function edit($id){
        $info = ProductModel::getDetail($id);
        return view('Admin.Product.product_handle',array_merge($this->ret_data,compact('info','id')));
    }

    public function update(Request $request,$id){
        $money = $request->input('money',0)*100;
        $money_sub = $request->input('money_sub',0)*100;
        $money_add = $request->input('money_add',0)*100;
        $time_length = $request->input('time_length',0);
        $type = $request->input('type',0);
        $h_type = $request->input('h_type',0);
        $on_show = $request->input('on_show',0);
        $desc = $request->input('desc','');

        $rules = [
            'money'=>'numeric',
            'money_sub'=>'numeric',
            'money_add'=>'numeric',
            'time_length'=>'integer',
            'type'=>'integer',
            'h_type'=>'integer',
            'on_show'=>'integer'
        ];

        $messages = [
            'money.numeric' => '金额异常',
            'money_sub.numeric' => '充值满减异常',
            'money_add.numeric' => '充值赠送异常',
            'time_length.integer' => '时长异常',
            'type.integer' => '类型异常',
            'h_type.integer' => '按次类型异常',
            'on_show.integer' => '展示异常',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = ProductModel::edit($id,compact('money','money_sub','money_add','time_length','type','h_type','on_show','desc'));
            if($res){
                return $this->returnJson(1,'成功');
            }
            else{
                return $this->returnJson(0,'失败');
            }
        }
    }

    public function destroy($id){
        $res = ProductModel::del((int)$id);
        if($res){
            return $this->returnJson(1,'成功');
        }
        else{
            return $this->returnJson(0,'失败');
        }
    }

}
