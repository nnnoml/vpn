@extends('index.app')
@section('title',$title)

@section('body')
<div class="play_box">
    <div class="play">
        <div id="video" style="max-width: 1190px; height: 670px;"></div>
<!--        <img src="{{asset('indexsrc')}}/images/img03.png">-->
    </div>
    <div class="play_title">
        <div class="play_left">
            <p>{{$info->video_name}}</p>
            <div class="play_news">
                <div class="play_news1">
                    @if($info->avatar)
                    <a href="javascript:;"><img src="{{config('app.url')}}{{$info->avatar}}"></a>
                    @else
                    <a href="javascript:;"><img src="{{asset('indexsrc')}}/images/login3.png"></a>
                    @endif
                    <a href="javascript:;">{{$info->nick_name}}</a>
                </div>
                <div class="play_news2">
                    <a><img src="{{asset('indexsrc')}}/images/login25.png"></a>
                    <a>{{$info->video_play_count}}</a>
                </div>
                <div class="play_news3" >
                    @if($info->vote_status)
                        <a id="vote_handle" href="javascript:;"><img src="{{asset('indexsrc')}}/images/login4.png"></a>
                    @else
                        <a href="javascript:;"><img src="{{asset('indexsrc')}}/images/login4_1.png"></a>
                    @endif
                    @if($activity_vote_status['code']==0)
                        <a href="javascript:;">{{$info->video_vote_count}}</a>
                    @endif
                </div>
                <div class="play_news3" >
                    <a><img src="{{asset('indexsrc')}}/images/clock.png"></a>
                    <a>{{$info->recording_time}}</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="play_right">
            <img style="margin:0px auto;" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->margin(0)->generate(Request::url())) !!} ">
            <a>微信扫码分享</a>
        </div>

        <div class="clearfix"></div>


    </div>

<!--class="voted"-->
        @if($act_info)
            <div class="act_name"><p>{{$act_info->activity_name}}</p>
                <span id="activity_vote" @if($activity_vote_status['code'] == 0) class="voted" @endif>{{$activity_vote_status['msg']}}</span>
        @endif
        <!--投票弹出框-->
        <div class="activity_vote">
            <h3>您确定给该视频投上您宝贵的一票？</h3>
            <h6>每个账号仅能对该活动内的任意一个视频投票，投票后不可再对同活动下其他视频投票。</h6>
            <span class="sp1">取消</span>
            <span class="sp2">确定</span>
        </div>
    </div>
</div>

<!--评论-->
<div class="container">
    <div class="commentbox">
        <textarea onkeyup="wordStatic(this);" cols="80" rows="50" maxlength="100" placeholder="来说几句吧......" class="mytextarea" id="content"></textarea>
        <div class="btn btn-info pull-left">0/100</div>
        <div class="btn btn-info pull-right" id="comment">发表</div>
        <div class="clearfix"></div>
        <div class="commentbox_entry">
            @if($user_account == '')
            <div class="commentbox_entry1">请先<span class="commentbox_logon">登录</span>后发表评论 (・ω・)</div>
            @endif
        </div>
    </div>
    <div class="commentboxs"><img src="{{asset('indexsrc')}}/images/login30.png"></div>
    <div class="comment-list">
        @forelse($info->msg_list as $key=>$vo)
        <div class="comment-info">
            <div class="header">
                @if($vo->avatar)
                <img src="{{config('app.url')}}{{$vo->avatar}}">
                @else
                <img src="{{asset('indexsrc')}}/images/login3.png">
                @endif
            </div>
            <div class="comment-right">
                <h3>{{$vo->nick_name}}</h3>
                <div class="comment-content-header"><span><i class="glyphicon glyphicon-time"></i>{{$vo->created_at}}</span></div>
                <p class="content">{{$vo->msg}}</p>
            </div>
        </div>
        @empty
        @endforelse
    </div>
    <div class="load_more load_more_default">加载更多</div>
</div>



<script type="text/javascript" src="{{asset('indexsrc/ckplayer')}}/ckplayer.js" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('indexsrc/ckplayer')}}/ckplayerConfig.js" charset="UTF-8"></script>

<script>
    videoObject.poster = ''; //封面图片
//    videoObject.poster = '{{config("app.url")}}/{{$info->video_img}}'; //封面图片
    videoObject.video = '{!!$info->real_url!!}'; //视频源
    var player = new ckplayer(videoObject);
    var play_status = true;//统计播放次数 页面内无刷新一个视频算一次播放量

    function loadedHandler(){
        player.addListener('play', playHandler);
    }
    function playHandler() {
        if(play_status){
            $.get('{{config("app.url")}}/playCount/{{$info->id}}');
            play_status = false;
        }
    }

    //评论长度
    function wordStatic(thi) {
        // 获取要显示已经输入字数文本框对象
        var content = $("#content");
        if (content && thi) {
            // 获取输入框输入内容长度并更新到界面
            var value = thi.value;
            // 将换行符不计算为单词数
            value = value.replace(/\n|\r/gi, "");

            $("body > div.container > div.commentbox > div.btn.btn-info.pull-left").html(value.length+"/100");
        }
    }

    //提交评论
    var post_status = false;
    $("#comment").click(function(){
        if(post_status) return;
        else{
            var post = {};
                post['msg'] = $("#content").val();
                post['a_id'] = {{$activity_id}};
                post['v_id'] = {{$video_id}};
                $("#comment").html("提交中");
                post_status = true;
            $.post('/user/userMsg',post,function(data){
                if(data.code==1){
                    $("#content").val('');
                    $(".comment-list").html('');
                    $("body > div.container > div.commentbox > div.btn.btn-info.pull-left").html("0/100");
                    loadMore(0);
                }
                else{
                    layer.msg(data.msg);
                }
                $("#comment").html("发表");
                post_status = false;
            },'json');
        }
    });
    //当前页码
    var now_page = {{$msg_page}};
    //加载更多
    $(".load_more").click(function(){
        now_page = now_page + 1;
        loadMore(now_page);
    })
    //按页码加载评论
    function loadMore(now_page){
        $.get('{{config("app.url")}}/v/msg/{{$video_id}}/'+now_page,'',function(data){
            if(data.code){
                if(data.list.length>0){
                    for ( var i=0;i<data.list.length;i++ ) {
                        var html = '';
                        html += '<div class="comment-info">\
                            <div class="header">';

                        if(data.list[i].avatar != '' && data.list[i].avatar != null)
                            html +='<img src="{{config('app.url')}}'+data.list[i].avatar+'">';
                        else
                            html +='<img src="{{asset('indexsrc')}}/images/login3.png">';

                            html +='</div>\
                                <div class="comment-right">\
                                    <h3>'+data.list[i].nick_name+'</h3>\
                                <div class="comment-content-header"><span><i class="glyphicon glyphicon-time"></i>'+data.list[i].created_at+'</span></div>\
                                <p class="content">'+data.list[i].msg+'</p>\
                                </div>\
                                </div>';

                        $(".comment-list").append(html);
                    }
                }
            }
            else{
                $(".load_more").removeClass('load_more_default');
            }
        },'json');
    }

    //点赞特效
    function tipsBox(options){
        options = $.extend({
            obj: $("#vote_handle"),  //jq对象，要在那个html标签上显示
            str: "+1",  //字符串，要显示的内容;也可以传一段html，如: "<b style='font-family:Microsoft YaHei;'>+1</b>"
            startSize: "12px",  //动画开始的文字大小
            endSize: "30px",    //动画结束的文字大小
            interval: 600,  //动画时间间隔
            color: "red",    //文字颜色
            callback: function () { }    //回调函数
        }, options);
        $("body").append("<span class='num'>" + options.str + "</span>");
        var box = $(".num");
        var left = options.obj.offset().left + options.obj.width() / 2;
        var top = options.obj.offset().top - options.obj.height()+20;
        box.css({
            "position": "absolute",
            "left": left + "px",
            "top": top + "px",
            "z-index": 9999,
            "font-size": options.startSize,
            "line-height": options.endSize,
            "color": options.color
        });
        box.animate({
            "font-size": options.endSize,
            "opacity": "0",
            "top": top - parseInt(options.endSize) + "px"
        }, options.interval, function () {
            box.remove();
            options.callback();
        });
    }

    var vote_handle = false;
    $("#vote_handle").parent().click(function () {
        if(vote_handle) return;
        else{
            var post = {};
            post['a_id'] = {{$activity_id}};
            post['v_id'] = {{$video_id}};

            $.post('/user/userVote',post,function(data){
                if(data.code==1){
                    vote_handle = true;
                    tipsBox();
                    $("#vote_handle").find('img').attr('src',"{{asset('indexsrc')}}/images/login4_1.png");
                    $("#vote_handle").next('a').html({{$info->video_vote_count}}+1);
                }
                else{
                    layer.msg(data.msg);
                }
            },'json');
        }
    });

    $("#activity_vote").click(function(){
        if(!$(this).hasClass('voted')){
            $(".activity_vote").show();
        }
    });
    $(".activity_vote .sp1").click(function(){
        $(".activity_vote").hide();
    })
    $(".activity_vote .sp2").click(function(){
        var post = {};
        post['video_id']={{$video_id}};
        post['activity_id']={{$activity_id}};
        $.post('/user/ActivityVote',post,function(data){
            if(data.code==1){
                layer.msg(data.msg);
                $(".activity_vote").hide();
                $("#activity_vote").attr('class','voted');
                $("#activity_vote").html('已投票');
            }
            else{
                layer.msg(data.msg);
            }
        },'json');
    })
</script>
@endsection