<?php

namespace App\Http\Controllers\Admin\Index;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class IndexController extends Controller
{
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = Config::get('sys_conf.web_title');
        $this->ret_data['nav'] = '';
        $this->ret_data['nav2'] = '';
    }
    public function Index(){
        return view('Admin.Index.index',array_merge($this->ret_data));
    }
}
