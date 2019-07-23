<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class IpListModel extends Model
{
    public static function lists($key=''){
        $self = new self();
        $res = $self->setConnection('mysql_c')->from('tb_conf_vpn')->where('online',1);
        if($key){
            $res->where('vpn_province','like','%'.$key.'%')->orWhere('vpn_city','like','%'.$key.'%');
        }
        $res = $res->get()->toArray();

        $self2 = new self();
        $self2->table = 'areas';
        $area_list = $self2->select('name','code')->get()->keyBy('code')->toArray();
        foreach ($res as $key=>$vo){
            $res[$key]['vpn_province_format'] = isset($area_list[$vo['vpn_province']]) ? $area_list[$vo['vpn_province']]['name']: '' ;
            $res[$key]['vpn_city_format'] = isset($area_list[$vo['vpn_city']]) ? $area_list[$vo['vpn_city']]['name']: '' ;
        }

        return $res;
    }
}
