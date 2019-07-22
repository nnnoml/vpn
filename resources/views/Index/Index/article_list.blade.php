@extends('Index.app')

@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.foot_index')
@extends('Index.Common.alert_index')
@section('main')
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/index2.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/iframe_consult.css" />

    <div class="h1-catalog">
        <div>
            <div class="icon"><i class="iconfont"></i></div>
            <a href="#" class="cat_name">
                <h1>{{$article['self']['ac_name']}}</h1>
            </a>
        </div>
    </div>
    <section class="sections">
        <div class="left-catalog">
            <div class="more_list">

                @foreach($article['self']['list'] as $key=>$vo)
                    <div class="catalog-list">
                        <div class="titles">
                            <a class="titles-h1" href="/article/{{$article['self']['ac_id']}}/{{$vo['id']}}"><h2>{{$vo['title']}}</h2></a>
                            <p>发布时间 {{$vo['created_at']}} </p>
                        </div>
                        <div class="subtitle">{{substr(strip_tags($vo['content']),0,100)}}</div>
                    </div>
                @endforeach

            </div>
            <div id="page"></div>
        </div>

        <div class="right" id="cat_list" style="padding-top: 0;">
            @foreach($article['other'] as $key=>$vo)
                <div class="list">
                    <div class="tit"><a href="/article/{{$vo['ac_id']}}"><h2>{{$vo['ac_name']}}</h2></a><a href="/article/{{$vo['ac_id']}}" class="more-list">更多</a></div>
                    @foreach($vo['list'] as $k2=>$v2)
                        <a href="/article/{{$vo['ac_id']}}/{{$v2['id']}}">{{$v2['title']}}</a>
                    @endforeach
                </div>
            @endforeach
        </div>

    </section>
    <script src="{{asset('plug/laypage')}}/laypage.js"></script>
    <script>
    $(function(){
        //限制字符个数
        $(".subtitle").each(function(){
            var maxwidth=123;
            if($(this).text().length>maxwidth){
                $(this).text($(this).text().substring(0,maxwidth));
                $(this).html($(this).html()+'…');
            }
        });

    });

    laypage({
        cont: 'page',
        pages: {{$article['self']['count']}}/6,
        curr: {{$page}},
        jump: function (obj, first) { //触发分页后的回调
            if(!first){
                window.location.href='?page='+obj.curr;
            }
        }
    })
</script>

@endsection