@extends('Index.app')


@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.foot_index')
@extends('Index.Common.alert_index')
@section('main')
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/ipList.css" />
    <section>
        <div class="banner">
            <div class="banner_inner">
                <div class="banner_content">
                    <p class="tit">城市列表</p>
                    <div class="search_box">
                        <div class="search">
                            <i class="iconfont"></i>
                            <input type="text" placeholder="请输入关键词搜索（省份 / 城市）" name="" value="{{$key}}" class="inpt" id="search_word">
                            <i class="iconfont close_remove" style="display: inline;"></i>
                            <a href="javascript:;" class="btn search_btn">立即搜索</a>
                        </div>
                        {{--<ul class="hot_word">--}}
                            {{--<li class="hot1">搜索热词：</li><li class="hot_words">淮南</li><li class="hot_words">南通</li><li class="hot_words">广州</li><li class="hot_words">宁波</li><li class="hot_words">普洱</li>--}}
                        {{--</ul>--}}
                    </div>
                    {{--<a href="javascript:;" class="export" id="export">导出Excel</a>--}}
                </div>
            </div>
        </div>
        <div class="city_content">
            <div class="city_list">
                <div class="table" id="city-list">
                    <div class="table-tr top-tr">
                        <div class="table-th td-1"><i class="iconfont"></i>省份</div>
                        <div class="table-th td-1"><i class="iconfont"></i>城市</div>
                        <div class="table-th td-1"><i class="iconfont"></i>运营商</div>
                        <div class="table-th td-1"><i class="iconfont"></i>协议</div>
                        <div class="table-th td-1"><i class="iconfont"></i>状态</div>
                        <div class="table-th td-2"><i class="iconfont"></i>线路域名</div>
                    </div>
                    @foreach($list as $key=>$vo)
                    <div class="table-tr">
                        <div class="table-td td-1">{{$vo['vpn_province']}}</div>
                        <div class="table-td td-1">{{$vo['vpn_city']}}</div>
                        <div class="table-td td-1">{{$vo['vpn_operator']}}</div>
                        <div class="table-td td-1">{{$vo['vpn_protocol']}}</div>
                        <div class="table-td td-1">
                            @if($vo['vpn_status'])
                                可用
                            @else
                                不可用
                            @endif
                        </div>
                        <div class="table-td td-2 ">{{$vo['vpn_domain']}}</div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div id="page" class="pages">
        </div>
    </section>

    <script type="text/javascript" src="{{asset('index_src/js')}}/ipList.js"></script>
@endsection