@extends('Admin.app')
@section('title',$title)

@section('body')

    <link rel="stylesheet" href="{{asset('admin_src/css')}}/login.css"  media="all">
    <div class="login-main">
        <header class="layui-elip">登录</header>
        <form class="layui-form">
            <div class="layui-input-inline">
                <input type="text" name="account" required lay-verify="required" placeholder="用户名" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-input-inline">
                <input type="password" name="pwd" required lay-verify="required" placeholder="密码" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-input-inline login-btn">
                <button lay-submit lay-filter="login" class="layui-btn">登录</button>
            </div>
            <hr/>
            <!--<div class="layui-input-inline">
                <button type="button" class="layui-btn layui-btn-primary">QQ登录</button>
            </div>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn layui-btn-normal">微信登录</button>
            </div>-->
            {{--<p><a href="register.html" class="fl">立即注册</a><a href="javascript:;" class="fr">忘记密码？</a></p>--}}
        </form>
    </div>
    <script type="text/javascript">
    layui.use(['form','layer','jquery'], function () {

        var form = layui.form;
        var $ = layui.jquery;
        form.on('submit(login)',function (data) {
            var url = '/{{config('sys_conf.admin')}}/api/loginDo';
            ajaxDo(url,'post',data.field,function(data){
                if (data['code'] == '1'){
                   location.href = "/{{config('sys_conf.admin')}}";
                }else{
                    layer.msg(data['msg']);
                }
            });
            return false;
        })

    });
    </script>
@endsection