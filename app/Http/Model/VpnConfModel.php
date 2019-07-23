<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class VpnConfModel extends Model
{
    public $timestamps=false;

    public static function getList(){
        $self = new self();
        $res = $self->setConnection('mysql_c')->from('tb_conf_vpn')->get();

        $self2 = new self();
        $self2->table = 'areas';
        $area_list = $self2->select('name','code')->get()->keyBy('code')->toArray();
        foreach ($res as $key=>$vo){
            $res[$key]['vpn_province_format'] = isset($area_list[$vo->vpn_province]) ? $area_list[$vo->vpn_province]['name']: '' ;
            $res[$key]['vpn_city_format'] = isset($area_list[$vo->vpn_city]) ? $area_list[$vo->vpn_city]['name']: '' ;
        }
        return $res;
    }

    public static function addVpnConf($data){
        $self = new self();
        return $self->setConnection('mysql_c')->from('tb_conf_vpn')->insertGetId($data);
    }

    public static function updateVpnConf($id,$data){
        $self = new self();
        return $self->setConnection('mysql_c')->from('tb_conf_vpn')
            ->where('vpn_id',$id)->update($data);
    }

    public static function deleteConf($id){
        $self = new self();
        return $self->setConnection('mysql_c')->from('tb_conf_vpn')->where('vpn_id',$id)->delete();
    }
}
