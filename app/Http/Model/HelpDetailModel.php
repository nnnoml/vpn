<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class HelpDetailModel extends Model
{
    protected $table = 'help_detail';

    public static function getList($page,$limit){
        $self = new self();
        $self_table = $self->getTable();
        $help_class = new HelpClassModel();
        $help_class_table = $help_class->getTable();

        $res = $self->from("$self_table as d")
            ->leftJoin("$help_class_table as c",'c.hc_id','d.hc_id')
            ->select('d.*','c.hc_name')
            ->where('d.is_del',0);

        $ret['count'] = $res->count();
        $ret['list'] = $res->skip($limit*($page-1))->take($limit)->orderBy('d.id','desc')->get()->toArray();

        return $ret;
    }

    public static function getInfo($id){
        return self::where('is_del',0)->where('id',$id)->first();
    }

    public static function addDetail($data){
        $data['created_at'] = date('Y-m-d H:i:s');
        return self::insert($data);
    }

    public static function updateDetail($id,$data){
        $data['updated_at'] = date('Y-m-d H:i:s');
        return self::where('id',$id)->update($data);
    }

    public static function deleteDetail($id){
        return self::where('id',$id)->update([
            'is_del'=>1,
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
    }

    public static function search($kw){
        $self = new self();
        $self_table = $self->getTable();
        $help_class = new HelpClassModel();
        $help_class_table = $help_class->getTable();

        $ret['all'] = $self->from("$self_table as d")
            ->leftJoin("$help_class_table as c",'c.hc_id','d.hc_id')
            ->select("d.*",'c.hc_name')
            ->where('d.title','like',"%$kw%")
            ->get()->toArray();

        $ret['list']=[];

        foreach($ret['all'] as $key=>$vo){
            $ret['list'][$vo['hc_name']][] = $vo;
        }
        return $ret;
    }
}
