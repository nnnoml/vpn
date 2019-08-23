<?php

namespace App\Http\Controllers\Index\SetMenu;

use App\Http\Controllers\Common\Common;
use App\Http\Controllers\Index\IndexController;
use App\Http\Model\ProductHTypeModel;
use App\Http\Model\ProductModel;
use App\Http\Controllers\Controller;

class HttpController extends IndexController
{
    use Common;

    public function __construct()
    {
        $this->ret_data['title'] = 'http套餐购买';
        $this->ret_data['nav'] = 'setMenu_http';
    }

    public function Index(){
        $this->Init();
        $list = ProductModel::getIndexList(2);
        foreach ($list as $key => $vo) {
            $list[$key]['h_type_list'] = ProductHTypeModel::getProductHTypeList($vo['h_type_id']);
            foreach ($list[$key]['h_type_list'] as $k2 => $v2) {
                $list[$key]['h_type_list'][$k2]['start_second_format'] = $this->formatSecond($v2['start_second'],'h');
                $list[$key]['h_type_list'][$k2]['end_second_format'] = $this->formatSecond($v2['end_second'],'h');
            }
        }
        return view('Index.SetMenu.http_index',array_merge($this->ret_data,compact('list')));
    }
}
