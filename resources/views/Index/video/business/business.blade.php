@extends('index.app')
@section('title',$title)

@section('body')
<link rel="stylesheet" href="{{asset('indexsrc/css')}}/signout.css">
<div class="business">
    <p>商务合作</p>
    <div class="business_box1">
        <h1>欢迎来电咨询相关合作事宜，广告投放、活动合作、冠名赞助、媒体合作等等，让我们一起携手共创美好未来！精彩视频网吧平台</h1>
        <h2>邮箱：{{config('app.business_email')}} </h2>
        <h3>电话：{{config('app.business_tel')}}</h3>
    </div>
    <p style=" margin-top: 50px; margin-bottom: 30px;">网吧注册<span style="font-size: 16px; margin-left: 20px;">网吧账号仅用于服务端登录，网页不可用。</span></p>
</div>
<div class="business_box2">
    <div class="password">
        <div class="password_box">
            <p><b class="iconfont" >账号</b><input name="bar_account" placeholder="" type="text"></p>
            <p><b class="iconfont" >密码</b><input  name="bar_pwd" placeholder="6-18位字符，不包含空格"  type="password" ></p>
            <p><b class="iconfont" >网吧名称</b><input name="bar_name" placeholder="网吧名称注册后不可修改" type="text"></p>
            <p><b class="iconfont" >联系电话</b><input name="user_tel" placeholder="用于找回密码" type="text"></p>
            <p><b class="iconfont" >联系人</b><input name="user_name" type="text"></p>
            <p><b class="iconfont" >所在地区</b><input name="user_address" placeholder="省市区域，街道地址" type="text"></p>
            <div class="password_mm">
                <a href="javascript:;" onclick="reg_bussiness()" class="password_mm1">注册</a>
                <a href="{{config('url')}}/business/recover"  class="password_mm2">找回密码</a>
            </div>
        </div>
    </div>
    <div class="business_box3">
        <h4>网吧活动软件下载</h4>
        <div class="Client">
<!--服务端-->
            <div class="Client1" style="float: left;">
                <a href="{{config('app.download_service.url')}}">
                <img src="{{asset('indexsrc/images')}}/Client.png">
                <h5>{{config('app.download_service.title')}}</h5>
                <h6>{{config('app.download_service.version')}}</h6>
                </a>
            </div>
<!--客户端-->
            <div class="Client1" style="float: left;">
                <a href="{{config('app.download_client.url')}}">
                    <img src="{{asset('indexsrc/images')}}/Client.png">
                    <h5>{{config('app.download_client.title')}}</h5>
                    <h6>{{config('app.download_client.version')}}</h6>
                </a>
            </div>
<!--语音端-->
            <div class="Client1" style="float: left;">
                <a href="{{config('app.download_voice.url')}}">
                    <img src="{{asset('indexsrc/images')}}/Client.png">
                    <h5>{{config('app.download_voice.title')}}</h5>
                    <h6>{{config('app.download_voice.version')}}</h6>
                </a>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="clearfix" style="margin-bottom: 60px;"></div>
<div id="msg_box" class="icfot4" style="display: none;">
    <div class="icfot4_box">
        <h1>注册成功</h1>
        <h1>请在服务端登录账号</h1>
    </div>
</div>

<script>
function reg_bussiness(){
    var post = {};
         post['bar_account'] = $("input[name='bar_account']").val();
         post['bar_pwd'] = $("input[name='bar_pwd']").val();
         post['bar_name'] = $("input[name='bar_name']").val();
         post['user_tel'] = $("input[name='user_tel']").val();
         post['user_name'] = $("input[name='user_name']").val();
         post['user_address'] = $("input[name='user_address']").val();

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

    if(post_status){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{config('app.url')}}/business",
            async:false,//设置同步方式，非异步！
            cache:false,//严格禁止缓存！
            data: post,
            type: 'post',
            dataType: "json",
            success:function(data) {
                if(data.code == 1){
                    $("#msg_box").show();
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