<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Common\Plug\JWT;
use Closure;
use Illuminate\Support\Facades\Cookie;

class CheckTokenIndex
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $is_login = false;
        if($request->cookie('tokenIndex')){
            //获取token
            $token = $request->cookie('tokenIndex');
            //验证token有效性
            $verify_status = JWT::verifyToken($token);
            //如果token有效未过期
            if(is_array($verify_status)){
                isset($verify_status['reflushToken']) && Cookie::queue('tokenIndex',$verify_status['reflushToken']);
                $is_login = true;
            }
        }
        view()->share('isLogin', $is_login);
        return $next($request);
    }
}
