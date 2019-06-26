@extends('Index.app')
@section('title',$title)

@section('body')
<div class="personal_box">
    <div class="personal">
        <div class="personal_left">
            <p><a href="{{config('app.url')}}/user" class="personal_left_active">获奖通知</a></p>
            <p><a href="{{config('app.url')}}/user/changePwd">修改密码</a></p>
        </div>
        <div class="personal_right">
            <div class="option_class">奖励类型：
                <select id="option_class">
                    <option @if($type==0) selected @endif value="0">全部</option>
                    <option @if($type==1) selected @endif value="1">活动奖励</option>
                    <option @if($type==2) selected @endif value="2">抽奖奖励</option>
                    <option @if($type==3) selected @endif value="3">活动竞猜</option>
                </select>
            </div>

            <p>获奖通知</p>
            <div class="personal_right_nav">
                <a class="personal_right_nav1">奖品编号</a>
                <a class="personal_right_nav2">通知消息</a>
                <a class="personal_right_nav7">奖励类型</a>
                <a class="personal_right_nav3">奖品</a>
                <a class="personal_right_nav4">状态</a>
                <a class="personal_right_nav5">通知日期</a>
                <a class="personal_right_nav6">领取截止日期</a>
            </div>
            @foreach($list as $key=>$vo)
            <div class="personal_right_list">
                <p class="personal_right_list1">{{$vo->gift_sn}}</p>
                <p class="personal_right_list2">{{$vo->notice_text}}</p>
                <p class="personal_right_list7">
                    @if($vo->award_type == 1)
                        活动奖励
                    @elseif($vo->award_type == 2)
                        抽奖奖励
                    @else
                        活动竞猜
                    @endif
                </p>
                <p class="personal_right_list3">{{$vo->gift}}</p>

                @if($vo->receive_status == 0 && $vo->receive_deadline > date('Y-m-d H:i:s'))
                    <p class="personal_right_list4"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{config('app.reward_qq')}}&site=qq&menu=yes">请联系QQ客服领奖</a></p>
                @elseif($vo->receive_status == 0 && $vo->receive_deadline < date('Y-m-d H:i:s'))
                    <p class="personal_right_list4">已过期</p>
                @elseif($vo->receive_status == 1)
                    <p class="personal_right_list4">已领取</p>
                @else
                    <p class="personal_right_list4">-</p>
                @endif

                <p class="personal_right_list5">{{$vo->notice_at}}</p>
                <p class="personal_right_list6">{{$vo->receive_deadline}} </p>
            </div>
            @endforeach
        </div>
        <div class="content_video">
            {{ $list->appends(['type'=>$type])->links() }}
        </div>
        <div class="clearfix"></div>
    </div>

</div>
<script>
    $("#option_class").change(function(){
        var type = $(this).val();
        window.location.href="{{config('app.url')}}/user?type="+type;
    });
</script>
@endsection
