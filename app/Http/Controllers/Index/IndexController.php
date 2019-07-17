<?php

namespace App\Http\Controllers\Index;

use App\Http\Model\SysModel;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    protected $ret_data;

    public function __construct(){
        $this->ret_data['sys_conf'] = SysModel::getSysConf();
    }
}
