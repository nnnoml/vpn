<?php

namespace App\Http\Controllers\Index\SetMenu;

use App\Http\Model\ProductModel;
use App\Http\Controllers\Controller;

class VpnController extends Controller
{
    private $ret_data;

    public function __construct()
    {
        $this->ret_data['title'] = 'vpn套餐购买';
        $this->ret_data['nav'] = 'setMenu_vpn';
    }

    public function Index(){
        $list = ProductModel::getIndexList(1);
        return view('Index.SetMenu.vpn_index',array_merge($this->ret_data,compact('list')));
    }
}
