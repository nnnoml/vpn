<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class SysModel extends Model
{
    public $timestamps = false;
    /**
     * 登陆验证
     * @param $account
     * @param $pwd
     * @return array 1成功 0失败 密码错误 -1失败 账号不存在
     */
    public static function checkLogin($account,$pwd){
        $self = new self;
        $self->table = 'sys_admin';
        $admin_info = $self->where('account',$account)->first();

        if($admin_info){
            if($admin_info['password'] == $pwd){
                return ['code'=>1,'info'=>$admin_info];
            }
            else{
                return ['code'=>0,'info'=>'登陆失败 账号或密码错误'];
            }
        }
        else{
            return ['code'=>-1,'info'=>'登陆失败 账号不存在'];
        }
    }

    public static function changePWD($admin_id,$o_pwd,$n_pwd){
        $self = new self;
        $self->table = 'sys_admin';
        $admin_info = $self->where('id',$admin_id)->first();

        if($admin_info->password != sha1($o_pwd)){
            return '旧密码错误';
        }
        else{
            return $self->where('id',$admin_id)->update(['password'=>sha1($n_pwd),'updated_at'=>date('Y-m-d H:i:s')]);
        }
    }

    /**
     * 保存验证码 等待验证
     * @param $tel
     * @param $code
     * @param int $type 短信类型 1注册，2找回密码
     * @return mixed
     */
    public static function saveSmsCode($tel,$code,$type=0){
        $self = new self;
        $self->table = 'sys_sms_log';

        return $self->insert([
            'tel'=>$tel,
            'code'=>$code,
            'type'=>$type,
            'status'=>0,
            'created_at'=>date('Y-m-d H:i:s')
        ]);
    }

    /**
     * @param $tel
     * @param $code
     * @param int $type 短信类型 1注册 2找回密码
     * @return bool
     */
    public static function checkSmsCode($tel,$code,$type=0){
        $self = new self;
        $self->table = 'sys_sms_log';
        //验证码有效期十分钟
        $before_10_min = date('Y-m-d H:i:s',(time()-600));
        $res = $self->where('tel',$tel)->where('code',$code)->where('type',$type)->where('status',0)->where('created_at','>',$before_10_min)->first();
        if($res){
            return $self->where('id',$res['id'])->where('status',0)->update(['status'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
        }
        else{
            return false;
        }
    }

    public static function getArea($level,$code=0){
        $self = new self;
        $self->table = 'areas';
        $p_id = 0;
        if($code){
            $p_id = $self->where('code',$code)->value('id');
        }
        return $self->where('type',$level)->where('parent_id',$p_id)->orderby('id','asc')->get();
    }

    public static function getSysConf(){
        $self = new self;
        $self->table = 'sys_conf';
        $res = $self->first();
        return $res;
    }

    public static function setSysConf($data){
        $self = new self;
        $self->table = 'sys_conf';
        $res = $self->where('id',1)->update($data);
        return $res;
    }
}
