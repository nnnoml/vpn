<?php

namespace App\Http\Controllers\Index\Help;

use App\Http\Controllers\Index\IndexController;
use App\Http\Model\HelpClassModel;
use App\Http\Model\HelpDetailModel;
use Illuminate\Http\Request;

class HelpController extends IndexController
{

    public function __construct()
    {
        parent::__construct();
        $this->ret_data['sys_conf']['title'] = '使用帮助 '.$this->ret_data['sys_conf']['title'];
        $this->ret_data['nav'] = 'help';
        $this->ret_data['logo2'] = true;
    }

    //新手学堂
    public function School(){
        $act_list = [];
        return view('Index.Help.school',array_merge($this->ret_data,compact('act_list')));
    }

    //文档中心
    public function Index(){
        $left = HelpClassModel::getLeftNav();
        $id=0;
        return view('Index.Help.index',array_merge($this->ret_data,compact('left','id')));
    }

    //明细
    public function Detail($hc_id,$id){
        $left = HelpClassModel::getLeftNav();
        $class_info = HelpClassModel::where('hc_id',$hc_id)->first();
        $info = HelpDetailModel::where('id',$id)->first();
        if($class_info && $info){
            HelpDetailModel::addCount($id);
            return view('Index.Help.detail',array_merge($this->ret_data,compact('left','id','class_info','info')));
        }
        abort(404);
    }

    public function Search(Request $request){
        $kw = $request->input('keyword','');
        $list = HelpDetailModel::search($kw);
        return view('Index.Help.search',array_merge($this->ret_data,compact('list')));
    }


}
