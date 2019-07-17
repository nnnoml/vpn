@extends('Index.app')


@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.foot_index')
@extends('Index.Common.alert_index')
@section('main')
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/index2.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/iframe_consult.css" />

    <h2 class="h1" style="margin: 100px auto 0;">
        <a href="/">首页&gt;</a>
        <a href="/article/{{$article['main']['ac_id']}}" class="cat_name">{{$article['main']['ac_name']}}&gt;</a>
        <a class="info_title">{{$article['main']['title']}}</a>
    </h2>
    <section class="sections">
        <div class="left">
            <h1 class="info_title">{{$article['main']['title']}}</h1>
            <h2>
                <span class="cat_name">{{$article['main']['ac_name']}}</span>
                <span>发布日期</span>
                <span class="pub_time">{{$article['main']['created_at']}}</span>
            </h2>
            <div class="content">
                <p style="line-height: 2em;">
                    {{$article['main']['content']}}
                </p>
            </div>
            {{--<a class="list">换IP地址</a>--}}
            {{--<a class="list">芝麻IP</a>--}}
            {{--<a class="list">Python爬虫</a>--}}
            <div class="next">
                <!---->
                <!--<a><span>上一篇</span>没有了</a>-->
                <!---->
                {{--<a href="/syjq/6269.html"><span>下一篇</span>如何解决爬虫的IP地址受限问题?                <i>爬虫</i>--}}
                    {{--<i>ip受限</i>--}}
                    {{--<i>芝麻代理</i>--}}
                {{--</a>--}}
            </div>
            <div class="code">
                <img src="http://md-juhe.oss-cn-hangzhou.aliyuncs.com/c76afc9022c8404930c45384f45a8ca6.png" class="left" alt="">
                <div class="right">
                    更多内容，请关注微信号：<span>zhimadaili</span><br>
                    官网活动和优惠券都在这里<br>
                    联系客服惊喜不断哦！
                </div>
            </div>
        </div>
        <div class="right">
            @foreach($article['right_nav'] as $key=>$vo)
            <div class="list">
                <h2><a href="/article/{{$vo['ac_id']}}">{{$vo['ac_name']}}</a></h2>
                @if(isset($vo['list']))
                    @foreach($vo['list'] as $k2=>$v2)
                        <a href="/article/{{$vo['ac_id']}}/{{$v2['id']}}">{{$v2['title']}}</a>
                    @endforeach
                @endif
            </div>
            @endforeach
        </div>
    </section>
@endsection