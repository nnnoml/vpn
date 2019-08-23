<?php

namespace App\Http\Controllers\Index;

use App\Http\Model\SysModel;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    protected $ret_data;

    public function Init(){
        $this->ret_data['sys_conf'] = SysModel::getSysConf();
        //如果已经设置了标题 需要把主标题缀在后面
        if($this->ret_data['title']!=''){
            $this->ret_data['sys_conf']['title'] = $this->ret_data['title'].' '.$this->ret_data['sys_conf']['title'];
        }
    }
}
