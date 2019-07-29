<?php

namespace App\Http\Controllers\Common;

use App\Http\Model\SysModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Qcloud\Sms\SmsSingleSender;

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

    /**
     * rc4加密
     * @param $data
     * @return string
     */
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

    /**
     * 生成appkey
     * @param int $id
     * @return string
     */
    function appKey($id=0){
        //strtoupper转换成全大写的
         $charid = strtoupper(md5(uniqid(mt_rand(), true)).$id);
         $uuid = substr($charid, 0, 8).substr($charid, 8, 4).substr($charid,12, 4).substr($charid,16, 4).substr($charid,20,12);
         return $uuid;
    }

    function d($list){
        echo "<pre>";
        var_dump($list);
        echo "</pre>";
    }

    /**
 * 格式化时间
 * @param $s 传入秒
 * @param $type 格式化类型，smhdw
 * @return int|string
 */
    function formatSecond($s,$type=''){
        if($type){
            switch($type){
                case($type=='s'): $loop_arr = array(1 => '秒');break;
                case($type=='m'):$loop_arr = array( 60 => '分', 1 => '秒');break;
                case($type=='h'):$loop_arr = array(3600 => '小时', 60 => '分钟', 1 => '秒');break;
                case($type=='d'):$loop_arr = array(86400 => '天',3600 => '小时', 60 => '分', 1 => '秒');break;
                case($type=='w'):$loop_arr = array(604800 => '周',86400 => '天',3600 => '小时', 60 => '分', 1 => '秒');break;
                default:$loop_arr = array(2592000=>'月',604800 => '周',86400 => '天', 3600 => '小时', 60 => '分', 1 => '秒');
            }
        }
        else{
            switch($s){
                case($s<60): $loop_arr = array(1 => '秒');break;
                case($s>=60 && $s<3600):$loop_arr = array( 60 => '分', 1 => '秒');break;
                case($s>=3600 && $s<86400):$loop_arr = array(3600 => '小时', 60 => '分', 1 => '秒');break;
                case($s>=86400 && $s<604800):$loop_arr = array(86400 => '天',3600 => '小时', 60 => '分', 1 => '秒');break;
                case($s>=604800 && $s<2592000):$loop_arr = array(604800 => '周',86400 => '天',3600 => '小时', 60 => '分', 1 => '秒');break;
                default:$loop_arr = array(2592000=>'月',604800 => '周',86400 => '天', 3600 => '小时', 60 => '分', 1 => '秒');
            }
        }
        $output = '';
        foreach ($loop_arr as $key => $value) {
            if ($s >= $key) $output .= floor($s/$key) . $value;
            $s %= $key;
        }
        if($output==''){
            $output=0;
        }
        return $output;
    }

    /**
     * 格式化大小
     * @param $s 传入字节
     * @param $type 格式化类型，smhdw
     * @return int|string
     */
    function formatByte($s,$type=''){
        if($type){
            switch($type){
                case($type=='k'): $loop_arr = array(1024 => 'KB',1=>'Byte');break;
                case($type=='m'):$loop_arr = array( 1048576 => 'MB', 1024 => 'KB',1=>'Byte');break;
                case($type=='g'):$loop_arr = array( 1073741824 => 'GB', 1048576 => 'MB', 1024 => 'KB',1=>'Byte');break;
                default:$loop_arr = array( 1073741824 => 'GB', 1048576 => 'MB', 1024 => 'KB',1=>'Byte');
            }
        }
        else{
            switch($s){
                case($s<1024): $loop_arr = array(1024 => 'KB',1=>'Byte');break;
                case($s>=1024 && $s<1048576):$loop_arr = array( 1048576 => 'MB', 1024 => 'KB',1=>'Byte');break;
                case($s>=1048576 && $s<1073741824):$loop_arr = array( 1073741824 => 'GB', 1048576 => 'MB', 1024 => 'KB',1=>'Byte');break;
                default:$loop_arr = array( 1073741824 => 'GB', 1048576 => 'MB', 1024 => 'KB',1=>'Byte');
            }
        }
        $output = '';
        foreach ($loop_arr as $key => $value) {
            if ($s >= $key) $output .= floor($s/$key) . $value;
            $s %= $key;
        }
        if($output==''){
            $output=0;
        }
        return $output;
    }

    /**
     * @param $tel
     * @param $code
     * @param $type 1注册 2找回密码
     * @return bool
     */
    function sendSms($tel,$code,$type){
//
        // 短信应用SDK AppID
        $appid = \config('sys_conf.sms_id');
        // 短信应用SDK AppKey
        $appkey = \config('sys_conf.sms_key');
        // 短信模板ID，需要在短信应用中申请
        $content = '【聚联科技】';
        switch($type){
            case(1) : $content.=' 11VPN 您的注册验证码：'.$code.'，有效期10分钟。如非本人操作，请忽略。';break;
            case(2) : $content.=' 11VPN 您正在找回密码，验证码：'.$code.'，有效期10分钟。如非本人操作，请忽略。';break;
        }
        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $result = $ssender->send(0, "86", $tel, $content, "", "");
            $rsp = json_decode($result);
            if($rsp->errmsg=='OK'){
                Log::channel('smsLog')->info(' success '.$tel.' '.$content);
                return true;
            }
            else{
                Log::channel('smsLog')->info(' fail '.$tel.' '.$content.' res:'.json_encode($rsp));
                return false;
            }
        } catch(\Exception $e) {
            var_dump($e);
            return false;
        }
    }
    /**
     * http get 请求
     * @param $url
     * @return mixed
     */
    function httpGet($url)
    {
        $url = str_replace(' ', '%20', $url);
        Log::channel('CReqLog')->info('httpGET req '.$url);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($curl, CURLOPT_URL, $url);

//        curl_setopt($curl, CURLOPT_URL, 'http://192.168.201.131/do');
//        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Host: vpns.com'));

        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); //如果有跳转 循环跟进
        $res = curl_exec($curl);

        Log::channel('CReqLog')->info('httpGET resp '.$res);
        curl_close($curl);
        return $res;
    }


    /**
     * 字段开关操作 公共方法
     * @param $db model实例
     * @param $column 操作字段
     * @param $where 更新条件  数组 eg:['class_id'=>1]
     * @return int
     */
    function handle_switch($db,$column,array $where){
        $status = $db::where($where)->value($column);
        $new_status = $status == 0 ? 1:0;
        $res = $db::where($where)->update([$column=>$new_status,'updated_at'=>date('Y-m-d H:i:s')]);
        if($res){
            return $new_status;
        }
        else{
            return -1;
        }
    }

    /**
     * 导出CSV文件
     * @param array $data        要导出的数据(对象数组)
     * @param array $header_data 首行数据
     * @param array $cols        字段列表
     * @param string $file_name  文件名称
     * @return string
     */
    function export_csv($data = [], $header_data = [], $cols = [], $file_name = ''){
        $res = '';
        if (!empty($header_data)) {
            $res = iconv('utf-8','gbk//TRANSLIT','"'.implode('","',$header_data).'"'."\n");
        }

        $columns = count($cols);

        foreach ($data as $key => $value) {
            $output = array();
            if($columns > 0){
                for($i=0;$i<$columns;$i++){
                    $key = $cols[$i];
                    $output[] = $value[$key];
                }
            }
            $res .= iconv('utf-8','gbk//TRANSLIT','"'.implode('","', $output).'"'."\n");
        }
        return response()->make($res,200,['Content-Type'=>'application/octet-stream','Content-Disposition'=>'attachment; filename=' . $file_name]);
//        return response()->json(['data'=>time()])->setContent($res)->header('Content-Type','application/octet-stream')->header('Content-Disposition','attachment; filename=' . $file_name);

    }

    //数组转对象
    function arrayToObject($e){
        if( gettype($e)!='array' ) return;
        foreach($e as $k=>$v){
            if( gettype($v)=='array' || getType($v)=='object' )
                $e[$k]=(object)$this->arrayToObject($v);
        }
        return (object)$e;
    }

    //获得省份
    function getProvince(){
        return SysModel::getArea(1);
    }

    //获得城市
    function getCity($code){
        return SysModel::getArea(2,$code);
    }

}
