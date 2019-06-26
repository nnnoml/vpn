@extends('Index.app')
@section('title',$title)

@section('body')
<link rel="stylesheet" href="{{asset('indexsrc/css')}}/signout.css">
<div class="backpassword">
    <p>找回密码<span>网吧账号仅用于服务端登录，网页不可用。</span></p>
    <div class="backpassword_box">
        <div class=" backpassword_input">
            <p><b class="icfot">账号</b>
                <input name="bar_account" placeholder="请输入网吧账号" type="text"></p>
            <p><b class="icfot">联系电话</b>
                <input name="user_tel" placeholder="注册时填写的电话" type="text"></p>
            <p><b class="icfot">验证码</b>
                <input name="vcode" style=" width:180px;" placeholder="输入手机验证码" type="text"><em onclick="vcode()" class="icfot2">获取验证码</em></p>
            <p><b class="icfot">新密码</b>
                <input name="bar_pwd" placeholder="6-24位字符，不包含空格" type="password"></p>
            <p><b class="icfot">重复密码</b>
                <input name="bar_pwd1" placeholder="请再次输入密码" type="password"></p>
        </div>
        <div onclick="bar_recover()" class="icfot3">确定</div>
    </div>
</div>
<div class="icfot4" style="display: none;">
    <div class="icfot4_box">
        <h1>密码修改成功</h1>
        <h1>请在服务端登录账号</h1>
    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function vcode(){
        if(vcode_status){
            var bar_account = $("input[name='bar_account']").val();
            var user_tel = $("input[name='user_tel']").val();

            vcode_status = false;
            $(".icfot2").html("正在发送");
            $.post("{{config('app.url')}}/business/recoverSms",{bar_account:bar_account,user_tel:user_tel}, function( data ) {
                if(data.code == 1){
                    descTime();
                }
                else{
                    layer.msg(data.msg);
                    $(".icfot2").html("获取验证码");
                    vcode_status = true;
                }
            },'json');
        }
    }
    function descTime(){
        setTimeout(function(){
            if(now_time<1){
                vcode_status = true;
                now_time = total_time;
                $(".icfot2").html("获取验证码");
                return;
            }
            else{
                $(".icfot2").html(now_time+" 秒后再次获取");
                descTime();
                now_time--;
            }
        },1000);
    }

    function bar_recover(){
        var post = {};
             post['bar_account'] = $("input[name='bar_account']").val();
             post['user_tel'] = $("input[name='user_tel']").val();
             post['bar_pwd'] = $("input[name='bar_pwd']").val();
             post['bar_pwd1'] = $("input[name='bar_pwd1']").val();
             post['vcode'] = $("input[name='vcode']").val();

        var post_status = true;
        for(var i in post){
            if(post[i] == ''){
                post_status = false
                layer.msg('请填写完全');
                break;
            }
        }

        if(post['bar_pwd'].length<6 || post['bar_pwd'].length>18){
            post_status = false;
            layer.msg('密码 长度必须为6-18位');
        }

        if(post['bar_pwd'] != post['bar_pwd1']) {
            post_status = false;
            layer.msg('两次密码不一致');
        }

        if(post_status){

            $.ajax({
                url: "{{config('app.url')}}/business/recover",
                async:false,//设置同步方式，非异步！
                cache:false,//严格禁止缓存！
                data: post,
                type: 'post',
                dataType: "json",
                success:function(data) {
                    if(data.code == 1){
                        $(".icfot4").show();
                        setTimeout(function(){
                            window.location.href="{{config('app.url')}}";
                        },3000);
                    }
                    else{
                        layer.msg(data.msg);
                    }
                },
                error:function(){
                    layer.msg('通信失败');
                }
            })
        }
    }
</script>
@endsection