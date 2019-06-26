<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

trait Common{
    /**
     * 返回指定json格式字符串
     */
    function returnJson($code,$data='',$other_arr='')
    {
        $res['code'] = (int)$code;
        //如果非01 直接返回状态码
        if($res['code']!=0 && $res['code']!=1){
            return response()->json(['error' => (string)$data], $code);
        }

        if (is_array($data)){
            if (empty($data)){
                $res['info'] = '';
            }
            else{
                foreach ($data as $key => $vo) {
                    $res['info'][$key] = $vo;
                }
            }
        }
        else $res['msg'] = $data;

        if (is_array($other_arr))
            foreach ($other_arr as $key => $vo) {
                $res[$key] = $vo;
            }

        return json_encode($res, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 验证数据公共方法
     * @param Request $request laravel构造的request对象
     * @param $rules 过滤规则
     * @param $message 过滤提醒
     * @return array 返回数组 code = 1 验证通过  code = 0 msg里是过滤提醒
     */
    function validatorData(Request $request,$rules,$messages){
//    //参数验证
//    $rules = [
//        'bar_account' => 'required|max:16',
//        'bar_pwd' => 'required',
//        'bar_name' => 'required',
//        'user_tel' => 'required|regex:/^1\d{10}$/',
//        'user_name' => 'required',
//        'user_address' => 'required',
//    ];
//    $messages = [
//        'bar_account.required' => '请填写网吧账号',
//        'bar_account.max' => '网吧帐号长度大于16位',
//        'bar_pwd.required' => '请填写网吧密码',
//        'bar_name.required' => '请填写网吧名称',
//        'user_tel.required' => '请填写联系人电话',
//        'user_tel.regex' => '电话格式不正确',
//        'user_name.required' => '请填写联系人姓名',
//        'user_address.required' => '请填写网吧地址',
//    ];
        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()) {

            $msg = $validator->errors()->messages();
            $ret_msg = '';
            foreach($msg as $key=>$vo){
                $ret_msg .= $vo[0].', ';
            }
            return ['code'=>0,'msg'=>rtrim($ret_msg,', ')];
        }
        else{
            return ['code'=>1];
        }
    }

    /**
     * 获取子节点 递归
     */
    function getSon($list, $pk = 'id', $pid = 'pid', $rootid = 0){
        $tree = array();
        foreach ($list as $key => $val) {
            if ($val[$pid] == $rootid) {
                //获取当前$pid所有子类
                unset($list[$key]);
                if (!empty($list)) {
                    $tmpChild = $this->getSon($list, $pk, $pid, $val[$pk]);
                    if (!empty($tmpChild)) {
                        $val['children'] = $tmpChild;
                    }
                }
                $tree[] = $val;
            }
        }
        return $tree;
    }

    function rc4($data){
        $pwd = config('sys_conf.rc4_key');

        $cipher      = '';
        $key[]       = "";
        $box[]       = "";
        $pwd_length  = strlen($pwd);
        $data_length = strlen($data);
        for ($i = 0; $i < 256; $i++) {
            $key[$i] = ord($pwd[$i % $pwd_length]);
            $box[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j       = ($j + $box[$i] + $key[$i]) % 256;
            $tmp     = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $data_length; $i++) {
            $a       = ($a + 1) % 256;
            $j       = ($j + $box[$a]) % 256;
            $tmp     = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $k       = $box[(($box[$a] + $box[$j]) % 256)];
            $cipher .= chr(ord($data[$i]) ^ $k);
        }
        return bin2hex($cipher);
    }

    function d($list){
        echo "<pre>";
        var_dump($list);
        echo "</pre>";
    }

}
