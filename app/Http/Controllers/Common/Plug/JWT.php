<?php

namespace App\Http\Controllers\Common\Plug;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class JWT extends Controller
{
    private static $key = 'nmGrs01zlvlj6lgCDRhLJEbewzsdnfKngOK0mKc4qNv6dTVswncUJKDLmNzKxIf0';
    private static $header = [
        'typ'=>'JWT',
        'alg'=> 'HS256',
    ];
    private static $exp = 3600;//token有效期
    private static $ref = 7200;//token刷新期

    /**
     * 获取jwt token
     * @param array $payload jwt载荷   格式如下非必须
     * [
     *  'iss'=>'jwt_admin',  //该JWT的签发者
     *  'iat'=>time(),  //签发时间
     *  'exp'=>time()+7200,  //过期时间
     *  'nbf'=>time()+60,  //该时间之前不接收处理该Token
     *  'sub'=>'www.admin.com',  //面向的用户
     *  'jti'=>md5(uniqid('JWT').time())  //该Token唯一标识
     * ]
     * @param keep_login 有效期倍数
     * @return bool|string
     */
    public static function getToken(array $payload,$keep_login=1)
    {
        if(is_array($payload))
        {
            $payload['iat'] = time();
            $payload['exp'] = time()+self::$exp*$keep_login;
            $payload['ref'] = $payload['exp']+self::$ref;
            $payload['jti'] = md5(uniqid('JWT').time());

            $base64header=self::base64UrlEncode(json_encode(self::$header,JSON_UNESCAPED_UNICODE));
            $base64payload=self::base64UrlEncode(json_encode($payload,JSON_UNESCAPED_UNICODE));
            $token=$base64header.'.'.$base64payload.'.'.self::signature($base64header.'.'.$base64payload,self::$key,self::$header['alg']);
            return $token;
        }else{
            return false;
        }
    }

    /**
     * 获取token内的id
     * @param $token
     * @return int
     */
    public static function getTokenUID($token){
        $payload = self::verifyToken((string)$token);
        if($payload){
//            $tokens = explode('.', $token);
//            $base64payload=self::base64UrlDecode(json_encode($tokens[1],JSON_UNESCAPED_UNICODE));
            if(isset($payload['u_id'])) {
                return $payload['u_id'];
            }
            return 0;
        }
        else{
            return 0;
        }
    }

    /**
     * 验证token是否有效,默认验证exp,nbf,iat时间
     * @param string $Token 需要验证的token
     * @return bool|string
     */
    public static function verifyToken(string $Token)
    {
        $tokens = explode('.', $Token);
        if (count($tokens) != 3){
            return false;
        }

        list($base64header, $base64payload, $sign) = $tokens;

        //获取jwt算法
        $base64decodeheader = json_decode(self::base64UrlDecode($base64header), JSON_OBJECT_AS_ARRAY);
        if (empty($base64decodeheader['alg']))
            return false;

        //签名验证
        if (self::signature($base64header . '.' . $base64payload, self::$key, $base64decodeheader['alg']) !== $sign)
            return false;

        $payload = json_decode(self::base64UrlDecode($base64payload), JSON_OBJECT_AS_ARRAY);

        //签发时间大于当前服务器时间验证失败
        if (isset($payload['iat']) && $payload['iat'] > time()){
            return false;
        }

        //过期时间小于当前服务器时间验证失败
        if (isset($payload['exp']) && $payload['exp'] < time()){
            //已经达到过期时间 但未达到刷新时间 进行刷新
            if (isset($payload['ref']) && $payload['ref'] > time()){
                $ref_token = self::reflushToken($payload);
                $payload['reflushToken'] = $ref_token;
            }
            else{
                return false;
            }
        }
        //该nbf时间之前不接收处理该Token
        if (isset($payload['nbf']) && $payload['nbf'] > time()){
            return false;
        }
        return $payload;
    }

    /**
     * 刷新token
     * @param $payload
     * @return bool|string
     */
    public static function reflushToken($payload){
        return self::getToken($payload);
    }

    /**
     * base64UrlEncode   https://jwt.io/  中base64UrlEncode编码实现
     * @param string $input 需要编码的字符串
     * @return string
     */
    private static function base64UrlEncode(string $input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    /**
     * base64UrlEncode  https://jwt.io/  中base64UrlEncode解码实现
     * @param string $input 需要解码的字符串
     * @return bool|string
     */
    private static function base64UrlDecode(string $input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $addlen = 4 - $remainder;
            $input .= str_repeat('=', $addlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * HMACSHA256签名   https://jwt.io/  中HMACSHA256签名实现
     * @param string $input 为base64UrlEncode(header).".".base64UrlEncode(payload)
     * @param string $key
     * @param string $alg   算法方式
     * @return mixed
     */
    private static function signature(string $input, string $key, string $alg = 'HS256')
    {
        $alg_config=array(
            'HS256'=>'sha256'
        );
        return self::base64UrlEncode(hash_hmac($alg_config[$alg], $input, $key,true));
    }
}
