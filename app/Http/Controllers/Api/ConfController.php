<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ConfController extends Controller
{
    public function GetVpnConf($vpn_id){
        $res = DB::connection('mysql_c')->table('tb_conf_vpn')->where('vpn_id',$vpn_id)->first();
        echo json_encode($res);
    }
}
