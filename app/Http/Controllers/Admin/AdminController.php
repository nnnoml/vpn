<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\SysModel;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $ret_data;

    public function __construct(){
        $this->ret_data['sys_conf'] = SysModel::getSysConf();
    }
}
