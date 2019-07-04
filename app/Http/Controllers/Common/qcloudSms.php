<?php
use Qcloud\Sms\SmsSingleSender;

function sendSms($tel,$content){
    // 短信应用SDK AppID
        $appid = 140000; // 1400开头
    // 短信应用SDK AppKey
        $appkey = "ddddaaaa";
    // 短信模板ID，需要在短信应用中申请
    //        $templateId = 123;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请
    //        $smsSign = "123"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`
        $content = '【112】'.$content;
    //    saveLog("../storage/logs/PhoneSms_".date("Ymd").".log",'sending time:'.date('Y-m-d H:i:s').PHP_EOL.'tel:'.$tel.PHP_EOL.'content:'.$content);
    try {
        $ssender = new SmsSingleSender($appid, $appkey);
        $result = $ssender->send(0, "86", $tel, $content, "", "");
        $rsp = json_decode($result);

        if($rsp->errmsg=='OK'){
            saveLog("../storage/logs/PhoneSms_".date("Ymd").".log",'success time:'.date('Y-m-d H:i:s').PHP_EOL.'tel:'.$tel.PHP_EOL.'content:'.$content);
            return true;
        }
        else{
            saveLog("../storage/logs/PhoneSms_".date("Ymd").".log",'fail time:'.date('Y-m-d H:i:s').PHP_EOL.'tel:'.$tel.PHP_EOL.'content:'.$content.PHP_EOL.'res:'.json_encode($rsp));
            return false;
        }
    } catch(\Exception $e) {
        var_dump($e);
    }
}