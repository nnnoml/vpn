<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UseMoneyModel extends Model
{
    public static function lists($u_id,$con_this,$page,$limit,$start_at,$end_at){
        $self = new self();
        //查询用户余额日志
        $res = $self->setConnection('mysql_c')->from('tb_spend_log')
            ->where('u_id',$u_id)
            ->select('iptype','money','log_ty','cnt','create_time');
        if($start_at){
            $res = $res->where('create_time','>=',$start_at);
        }
        if($end_at){
            $res = $res->where('create_time','<=',$end_at);
        }
        $ret['count'] = $res->count();
        $ret['list'] = $res->skip(($page-1)*$limit)->take($limit)->get()->toArray();

        //遍历扣费产品列表 获得产品id
        $list = ProductHTypeModel::getList()->keyBy('h_type_id')->toArray();
        foreach ($list as $key => $vo) {
            $list[$key]['start_second_format'] = $con_this->formatSecond($vo['start_second'],'h');
            $list[$key]['end_second_format'] = $con_this->formatSecond($vo['end_second'],'h');
        }
        //组装到用户余额列表里
        foreach ($ret['list'] as $key => $vo) {
            $ret['list'][$key]['iptype_format'] = isset($list[$vo['iptype']])
                ? $list[$vo['iptype']]['start_second_format'].' - '.$list[$vo['iptype']]['start_second_format']:[];
        }
        return $ret;
    }
}
