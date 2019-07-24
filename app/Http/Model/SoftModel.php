<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class SoftModel extends Model
{
    public static function getSoftInfoList(){
        $self = new self;
        $self->table = 'soft_info';
        $res = $self->where('is_del',0)->get();
        return $res;
    }

    public static function addOrUpdateSoftInfo($id=0,$data){
        $self = new self;
        $self->table = 'soft_info';

        //TODO 软件大小获取
        if($id==0){
            $data['created_at']=date('Y-m-d H:i:s');
            return $self->insert($data);
        }
        else{
            return $self->where('soft_id',$id)->update($data);
        }
    }

    public static function delSoftInfo($id){
        $self = new self;
        $self->table = 'soft_info';
        return $self->where('soft_id',$id)->delete();
    }


}
