<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'user';

    public static function userInfo($u_id){
        return self::where('u_id',$u_id)->first();
    }

    /**
     * 登陆验证
     * @param $account
     * @param $pwd
     * @return array 1成功 0失败 密码错误 -1失败 账号不存在
     */
    public static function checkLogin($account,$pwd){
        $user_info = self::where('account',$account)->first()->toArray();

        if($user_info){
            if($user_info['pwd'] == $pwd){
                return ['code'=>1,'info'=>$user_info];
            }
            else{
                return ['code'=>0,'info'=>'登陆失败 账号或密码错误'];
            }
        }
        else{
            return ['code'=>-1,'info'=>'登陆失败 账号不存在'];
        }

    }
}
