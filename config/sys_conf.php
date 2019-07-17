<?php
return [
    'admin'=>'admin', //后台路径
    'web_title'=>'vpn 一家做vpn的网站',
    'rc4_key'=>env('RC4KEY',''),
    'C_server'=>env('C_SERVER',''),//c通知接口
    'C_Log_server'=>env('C_LOG_SERVER',''),//c ip查询接口
    'C_IP_server'=>env('C_IP_SERVER',''),//c ip查询接口
    'pay_type'=>[
        'wechat'=>1,
        'alipay'=>2
    ]//c通知接口
];