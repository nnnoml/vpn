<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class IpListModel extends Model
{
    public static function lists($key=''){
        $self = new self();
        $res = $self->setConnection('mysql_c')->from('tb_conf_vpn');
        if($key){
            $res->where('vpn_province','like','%'.$key.'%')->orWhere('vpn_city','like','%'.$key.'%');
        }
        $res = $res->get()->toArray();
        return $res;
    }
}
