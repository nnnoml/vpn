@extends('Index.app')


@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.foot_index')
@extends('Index.Common.alert_index')
@section('main')
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/help.css" />
    <div class="help-common-header">
        @include('Index.Help.search_header')
        <div class="down-part">
            <div class="down-part-box">
                <ul class="title-list">
                    <li><a href="/help/school">新手学堂</a></li>
                    <li class="active"><a href="/help">文档中心</a></li>
                    <!--<li><a href="/contact">联系客服</a></li>-->
                </ul>
            </div>
        </div>
    </div>
    <div class="document-center">
        <div class="document-center-box">
            @include('Index.Help.left')

            <!--右侧介绍-->
            <div class="product-introduce">
                <div class="part-up" style="height: 333px;">
                    <div class="left-title">
                        <h3>11IP</h3>
                        <p>IP行业领导者，支持PC 、iOS、&nbsp;安卓平台，全局代理，保证高质量流量出口。拥有数量超1000万的海量IP池，全国线路，不限带宽，连接切换速度小于100ms，支持pptp/L2tp/open/ikev2协议。每日切换不限次数，自动过滤重复IP，自动清理cookie，保证用户独享带宽。11IP，可保护您的数据安全和上网隐私。用户通过下载软件、注册付费后即时开通使用，是网络推广人员的神兵利器，让您畅享飞一般的感觉。</p>
                        {{--<div class="btn-box">--}}
                            {{--<a class="active reg_modal">免费注册</a>--}}
                            {{--<a href="javascript:void(0)" class="consult sur_link">立即咨询</a>--}}
                        {{--</div>--}}
                    </div>
                    <div class="right-img"></div>
                </div>
                <div class="part-down">
                    <div class="subtitle">
                        <span></span>
                        <p>热点问题</p>
                    </div>
                    <div class="hot-area">

                        @foreach($left as $key=>$vo)
                            <div class="hot">
                                <span>
                                    @if($loop->index == 0)
                                        <i class="iconfont"></i>
                                    @elseif($loop->index == 1)
                                        <i class="iconfont"></i>
                                    @elseif($loop->index == 2)
                                        <i class="iconfont"></i>
                                    @elseif($loop->index == 3)
                                        <i class="iconfont"></i>
                                    @endif
                                </span>
                                <h3>{{$vo['hc_name']}}</h3>
                                <ul>
                                    @foreach($vo['list'] as $k2=>$v2)
                                        <li><a href="/help/{{$vo['hc_id']}}/{{$v2['id']}}">{{$v2['title']}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('index_src/js')}}/help.js"></script>
@endsection