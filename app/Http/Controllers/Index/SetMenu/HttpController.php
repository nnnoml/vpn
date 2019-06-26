<?php

namespace App\Http\Controllers\Index\SetMenu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class HttpController extends Controller
{
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = 'http套餐购买';
        $this->ret_data['nav'] = 'setMenu_http';
    }

    public function Index(){
        return view('Index.SetMenu.http_index',array_merge($this->ret_data));
    }
}
