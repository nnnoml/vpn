<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class IpListModel extends Model
{
    public static function lists(){
        $self = new self();
        $res = $self->setConnection('mysql_c')->from('tb_conf_vpn')->get()->toArray();
//        foreach ($res as $key => $vo) {
//            $res[$key]['ip'] = long2ip($vo['ip']);
//        }
        return $res;
    }
}
