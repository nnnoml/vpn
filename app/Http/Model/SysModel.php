<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class SysModel extends Model
{
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

    /**
     * @param $tel
     * @param $code
     * @param int $type TODO 预留 短信要增加类型
     * @return bool
     */
    public static function checkSmsCode($tel,$code,$type=1){
        $self = new self;
        $self->table = 'sys_sms_log';
        $res = $self->where('tel',$tel)->where('code',$code)->where('status',0)->first();
        if($res){
            return $self->where('id',$res['id'])->where('status',0)->update(['status'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
        }
        else{
            return false;
        }
    }
}
