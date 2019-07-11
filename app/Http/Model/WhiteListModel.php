<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class WhiteListModel extends Model
{
    public static function lists($u_id){
        $self = new self();
        $res = $self->setConnection('mysql_c')->from('tb_whitelist')->where('u_id',$u_id)->get()->toArray();
        foreach ($res as $key => $vo) {
            $res[$key]['ip'] = long2ip($vo['ip']);
        }
        return $res;
    }
}
