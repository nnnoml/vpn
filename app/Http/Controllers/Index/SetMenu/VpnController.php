<?php

namespace App\Http\Controllers\Index\SetMenu;

use App\Http\Model\ProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class VpnController extends Controller
{
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = 'vpn套餐购买';
        $this->ret_data['nav'] = 'setMenu_vpn';
    }

    public function Index(){
        $list = ProductModel::getIndexList();
        return view('Index.SetMenu.vpn_index',array_merge($this->ret_data,compact('list')));
    }
}
