<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Common\Common;
use App\Http\Model\ProductHTypeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductHTypeController extends Controller
{
    use Common;
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = '产品类型列表';
        $this->ret_data['nav'] = 'product';
        $this->ret_data['nav2'] = 'product_h_type';
    }

    public function index(){
        $list = ProductHTypeModel::getList();
        foreach ($list as $key => $vo) {
            $list[$key]['start_second_format'] = $this->formatSecond($vo['start_second']);
            $list[$key]['end_second_format'] = $this->formatSecond($vo['end_second']);
            $list[$key]['price'] /= 100;
        }
        return view('Admin.Product.product_h_type',array_merge($this->ret_data,compact('list')));
    }


    public function create(){
        $id=0;
        return view('Admin.Product.product_h_type_handle',array_merge($this->ret_data,compact('id')));
    }

    public function store(Request $request){
        $start_second = $request->input('start_second',0);
        $end_second = $request->input('end_second',0);
        $price = $request->input('price',0)*100;

        $rules = [
            'start_second'=>'integer',
            'end_second'=>'integer',
            'price'=>'integer',
        ];

        $messages = [
            'start_second.integer' => '开始时间异常',
            'end_second.integer' => '结束时间异常',
            'price.integer' => '单价异常',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = ProductHTypeModel::add(compact('start_second','end_second','price'));
            if($res){
                return $this->returnJson(1,'新增成功');
            }
            else{
                return $this->returnJson(0,'新增失败 请重试');
            }
        }
    }

    public function edit($id){
        $info = ProductHTypeModel::getDetail($id);
        return view('Admin.Product.product_h_type_handle',array_merge($this->ret_data,compact('info','id')));
    }

    public function update(Request $request,$id){
        $start_second = $request->input('start_second',0);
        $end_second = $request->input('end_second',0);
        $price = $request->input('price',0)*100;

        $rules = [
            'start_second'=>'integer',
            'end_second'=>'integer',
            'price'=>'integer',
        ];

        $messages = [
            'start_second.integer' => '开始时间异常',
            'end_second.integer' => '结束时间异常',
            'price.integer' => '单价异常',
        ];

        $v_res = $this->validatorData($request,$rules,$messages);
        if($v_res['code']==0) {
            return $this->returnJson(0, $v_res['msg']);
        }
        else{
            $res = ProductHTypeModel::edit($id,compact('start_second','end_second','price'));
            if($res){
                return $this->returnJson(1,'成功');
            }
            else{
                return $this->returnJson(0,'失败');
            }
        }
    }

    public function destroy($id){
        $res = ProductHTypeModel::del((int)$id);
        if($res){
            return $this->returnJson(1,'成功');
        }
        else{
            return $this->returnJson(0,'失败');
        }
    }
}
