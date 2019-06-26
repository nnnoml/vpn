@extends('Index.app')
@section('title',$title)

@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.foot_index')
@extends('Index.Common.alert_index')
@section('main')
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/help.css" />
    <div class="help-common-header">
        @include('Index.Help.search_header')
    </div>
    <div class="search-main">
        <div class="search-main-box"><div class="down-part">
                <div class="down-part-box">
                    <ul class="title-list">
                        <li data-id="0" class="active"><a>全部<span>({{count($list['all'])}})</span></a></li>
                        @foreach($list['list'] as $key=>$vo)
                            <li data-id="{{$vo[0]['hc_id']}}"><a>{{$key}}<span>({{count($list['list'][$key])}})</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="search-content" >
                @foreach($list['all'] as $key=>$vo)
                    <div class="search-content-list" data-id="0">
                        <div class="title">
                            <a class="article-title" href="/help/{{$vo['hc_id']}}/{{$vo['id']}}">{{$vo['title']}}</a>
                            <span class="article-time">{{$vo['created_at']}}</span>
                        </div>
                        <div class="result">
                            <p>
                                {{ strip_tags($vo['content']) }}
                            </p>
                        </div>
                        <div class="origin">
                            <a>来自 : {{$vo['hc_name']}}</a>
                        </div>
                    </div>
                @endforeach

                    @foreach($list['list'] as $key=>$vo)
                        @foreach($list['list'][$key] as $v2)
                            <div class="search-content-list" style="display:none;" data-id="{{$v2['hc_id']}}">
                                <div class="title">
                                    <a class="article-title" href="/help/{{$v2['hc_id']}}/{{$v2['id']}}">{{$v2['title']}}</a>
                                    <span class="article-time">{{$v2['created_at']}}</span>
                                </div>
                                <div class="result">
                                    <p>
                                        {{ strip_tags($v2['content']) }}
                                    </p>
                                </div>
                                <div class="origin">
                                    <a>来自 : {{$v2['hc_name']}}</a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                {{--<div class="page" id="page" style="margin: -30px auto 0;"></div>--}}
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".title-list >li").click(function(){
                $(".title-list >li").each(function(){
                    $(this).removeClass('active');
                })
                $(this).addClass('active');
                var data_id = $(this).data('id');
                console.log(data_id);
                $(".search-content-list").hide();
                $(".search-content-list").each(function(){
                    if($(this).data('id') == data_id){
                        $(this).show();
                    }
                });
            })
        });
    </script>
@endsection