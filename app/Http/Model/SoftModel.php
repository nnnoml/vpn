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

    public static function getSoftSDKList(){
        $self = new self;
        $self->table = 'soft_sdk';
        $res = $self->where('is_del',0)->get();
        return $res;
    }

    public static function addOrUpdateSoftSDK($id=0,$data){
        $self = new self;
        $self->table = 'soft_sdk';

        if($id==0){
            $data['created_at']=date('Y-m-d H:i:s');
            return $self->insert($data);
        }
        else{
            return $self->where('sdk_id',$id)->update($data);
        }
    }

    public static function delSoftSDK($id){
        $self = new self;
        $self->table = 'soft_sdk';
        return $self->where('sdk_id',$id)->delete();
    }



}
