<?php

namespace App\Http\Model;

use App\Http\Controllers\Common\TaskController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        $user_info = self::where('account',$account)->first();

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

    public static function addUser($data){
        $res['code'] = 0;
        $res['u_id'] = 0;
        $res['msg'] = '';

        DB::beginTransaction();
        $check_sms = SysModel::checkSmsCode($data['account'],$data['sms_code']);
        if($check_sms!==false){
            if(!self::where('account',$data['account'])->exists()){
                unset($data['sms_code']);
                $data['created_at'] = date('Y-m-d H:i:s');
                $u_id = self::insertGetId($data);
                if($u_id){
                    //task通知C
                    $task_info['task_url'] = config('sys_conf.C_server').'/loaduser';
                    $task_info['task_params'] = json_encode(['uid'=>$u_id]);

                    $ret = TaskController::create($task_info);
                    //判断是否投递成功
                    if($ret){
                        $res['code'] = 1;
                        $res['u_id'] = $u_id;
                        DB::commit();
                    }
                    else{
                        $res['msg'] = '执行失败 请重试';
                        DB::rollBack();
                    }
                }
                else{
                    $res['msg'] = '注册失败 请重试';
                    DB::rollBack();
                }
            }
            else{
                $res['msg'] = '该手机已注册过';
                DB::rollBack();
            }
        }
        else{
            $res['msg'] = '短信验证码错误';
            DB::rollBack();
        }
        return $res;
    }

    public static function changePWD($data){
        $res['code'] = 0;
        $res['u_id'] = 0;
        $res['msg'] = '';

        DB::beginTransaction();
        $check_sms = SysModel::checkSmsCode($data['account'],$data['sms_code']);
        if($check_sms!==false){
            $user_info = self::where('account',$data['account'])->first();
            if($user_info){
                unset($data['sms_code']);
                $data['created_at'] = date('Y-m-d H:i:s');
                $update_res = self::where('account',$data['account'])->update([
                    'pwd'=>$data['pwd'],
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
                if($update_res){
                    //task通知C
                    $task_info['task_url'] = config('sys_conf.C_server').'/loaduser';
                    $task_info['task_params'] = json_encode(['uid'=>$res['u_id']]);

                    $ret = TaskController::create($task_info);
                    //判断是否投递成功
                    if($ret){
                        $res['code'] = 1;
                        $res['u_id'] = $user_info['u_id'];
                        DB::commit();
                    }
                    else{
                        $res['msg'] = '执行失败 请重试';
                        DB::rollBack();
                    }
                }
                else{
                    $res['msg'] = '修改失败 请重试';
                    DB::rollBack();
                }
            }
            else{
                $res['msg'] = '未找到该用户';
                DB::rollBack();
            }
        }
        else{
            $res['msg'] = '短信验证码错误';
            DB::rollBack();
        }
        return $res;
    }
}
