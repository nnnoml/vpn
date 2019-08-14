<?php

namespace App\Http\Model;

use App\Http\Controllers\Common\TaskController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    protected $table = 'user';

    public static function userInfo($u_id){
        $self = new self();
        $res = $self->where('u_id',$u_id)->first();
        if($res){
            //C库查余额
            $res['money'] = $self->setConnection('mysql_c')->from('tb_user_direct_order')->where('u_id',$res['u_id'])->sum('money');
            //C库查vpn到期时间
            $res['vpn_deadline'] = $self->setConnection('mysql_c')->from('tb_user_vpn_order')->where('u_id',$res['u_id'])->value('valid_at');
            //vpn已到期 给友好提示
            if($res['vpn_deadline']<date('Y-m-d H:i:s')){
                unset($res['vpn_deadline']);
            }
        }
        return $res;
    }

    //获取用户appkey
    public static function userAppKey($u_id){
        return self::where('u_id',$u_id)->value('appkey');
    }

    //检测用户是否存在 充值用
    public static function checkOrderUserInfo($account){
        return self::where('account',$account)->value('u_id');
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
        $check_sms = SysModel::checkSmsCode($data['account'],$data['sms_code'],1);
        if($check_sms!==false){
            if(!self::where('account',$data['account'])->exists()){
                unset($data['sms_code']);
                $data['created_at'] = date('Y-m-d H:i:s');
                $u_id = self::insertGetId($data);
                DB::commit();
                if($u_id){
                    //task通知C
                    $task_info['task_url'] = config('sys_conf.C_server').'/loaduser';
                    $task_info['task_params'] = json_encode(['uid'=>$u_id]);

                    $ret = TaskController::create($task_info);
                    //判断是否投递成功
                    if($ret){
                        $res['code'] = 1;
                        $res['u_id'] = $u_id;
                    }
                    else{
                        $res['msg'] = '执行失败 请重试';
                        //DB::rollBack();
                    }
                }
                else{
                    $res['msg'] = '注册失败 请重试';
                    //DB::rollBack();
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

    /**
     * 未登陆找回密码
     * @param $data
     * @return mixed
     */
    public static function changePWD($data){
        $res['code'] = 0;
        $res['u_id'] = 0;
        $res['msg'] = '';

        DB::beginTransaction();
        $check_sms = SysModel::checkSmsCode($data['account'],$data['sms_code'],2);
        if($check_sms!==false){
            $user_info = self::where('account',$data['account'])->first();
            if($user_info){
                unset($data['sms_code']);
                $update_res = self::where('account',$data['account'])->update([
                    'pwd'=>$data['pwd'],
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
                if($update_res){
                    //task通知C
                    $task_info['task_url'] = config('sys_conf.C_server').'/loaduser';
                    $task_info['task_params'] = json_encode(['uid'=>$res['u_id']]);
                    DB::commit();
                    $ret = TaskController::create($task_info);
                    //判断是否投递成功
                    if($ret){
                        $res['code'] = 1;
                        $res['u_id'] = $user_info['u_id'];
                    }
                    else{
                        $res['msg'] = '执行失败 请重试';
                        //DB::rollBack();
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

    /**
     * 登陆后修改密码
     * @param $data
     * @return mixed
     */
    public static function changePWDLogin($data){
        $res['code'] = 0;
        $res['msg'] = '';

        DB::beginTransaction();
        $user_info = self::where('u_id',$data['u_id'])->first();
        if(!$user_info){
            $res['msg'] = '未找到该用户';
            DB::rollBack();
        }
        else{
            if($user_info['pwd'] != $data['old_pwd']){
                $res['msg'] = '旧密码错误 请重试';
                DB::rollBack();
            }
            else{
                $update_res = self::where('u_id',$data['u_id'])->update([
                    'pwd'=>$data['new_pwd'],
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
                DB::commit();
                if($update_res === false){
                    $res['msg'] = '修改失败 请重试';
                    //DB::rollBack();
                }
                else{
                    //task通知C
                    $task_info['task_url'] = config('sys_conf.C_server').'/loaduser';
                    $task_info['task_params'] = json_encode(['uid'=>$data['u_id']]);

                    $ret = TaskController::create($task_info);
                    //判断是否投递成功
                    if($ret){
                        $res['code'] = 1;
                    }
                    else{
                        $res['msg'] = '执行失败 请重试';
                        //DB::rollBack();
                    }
                }
            }
        }

        return $res;
    }
}
