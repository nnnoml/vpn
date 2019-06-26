@extends('index.app')
@section('title',$title)

@section('body')
<link rel="stylesheet" href="{{asset('indexsrc/css')}}/signout.css">
<div class="personal_box">
    <div class="personal">
        <div class="personal_left">
            <p><a href="{{config('app.url')}}/user">获奖通知</a></p>
            <p><a href="{{config('app.url')}}/user/changePwd" class="personal_left_active">修改密码</a></p>
        </div>
        <div class="personal_right">
            <p>修改密码</p>
            <div class="password">
                <!-- 登录 -->
                <div class="password_box">
                    <p><b class="iconfont">旧密码</b><input name="old_pwd" placeholder="填写旧密码" type="password"></p>
                    <p><b class="iconfont">新密码</b><input name="new_pwd_1" placeholder="设置新密码"  type="password"></p>
                    <p><b class="iconfont">重复密码</b><input name="new_pwd_2" placeholder="请再次输入新密码" type="password"></p>
                    <div class="password_qr" onclick="userRecover()"><a href="javascript:;">确认修改</a></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function userRecover(){
        var post = {};
            post['old_pwd'] = $("input[name='old_pwd']").val();
            post['new_pwd_1'] = $("input[name='new_pwd_1']").val();
            post['new_pwd_2'] = $("input[name='new_pwd_2']").val();

        var post_status = true;
        for(var i in post){
            if(post[i] == ''){
                post_status = false
                layer.msg('请填写完全');
                break;
            }
        }

        if(post['new_pwd_1'].length<6 || post['new_pwd_1'].length>18){
            post_status = false;
            layer.msg('密码 长度必须为6-18位');
        }

        if(post['new_pwd_1'] != post['new_pwd_2']) {
            post_status = false;
            layer.msg('两次密码不一致');
        }

        if(post_status){
            $.post("{{config('app.url')}}/user/changePwd",post, function( data ) {
                if(data.code == 1){
                    layer.msg(data.msg);
                    window.location.reload();
                }
                else{
                    layer.msg(data.msg);
                }
            },'json');
        }
    }
</script>
@endsection