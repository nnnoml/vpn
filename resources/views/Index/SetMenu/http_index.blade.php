@extends('Index.app')
@section('title',$title)

@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.foot_index')
@extends('Index.Common.alert_index')
@section('main')

    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/index2.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/iframe_consult.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/http_setmenu.css" />
    <div class="content">
        <ul class="ul-1 list3">

            <li id="recharge" class="active">
                按次购买
                <i class="iconfont"></i>
                <span class="pro">包月/按次质量都是独享优质IP，质量上没有区别。<br>按次：使用起来更加灵活，余额没有到期时间，不受时间限制。</span>
            </li>

            {{--<li id="buy_week">--}}
                {{--包周套餐--}}
                {{--<i class="iconfont"></i>--}}
                {{--<span class="pro">按次/包周/包月/质量都是独享优质IP，质量上没有区别。<br>包周：使用起来更加优惠，包周套餐相当于按次购买的<a class="red">7</a>折。</span>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--包月套餐--}}
                {{--<i class="iconfont"></i>--}}
                {{--<span class="pro">按次/包周/包月/质量都是独享优质IP，质量上没有区别。<br>包月：使用起来更加优惠，包月套餐相当于按次购买的<a class="red">6</a>折。</span>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--长效IP--}}
                {{--<i class="iconfont"></i>--}}
                {{--<span class="pro">高质量长效IP，存活时间超过24小时，有效期内不限使用次数，可灵活续费使用。</span>--}}
            {{--</li>--}}
            <li class="move"></li>
        </ul>
        <div class="pay_list">
            <ul style="display:block">
                @foreach($list as $key=>$vo)
                    <li style="display:block">
                      <span class="line">
                        <i></i>
                        预充值金额
                      </span>
                        <span class="line2">
                        <a class="price">{{$vo['money']/100}}</a>
                            @if($vo['money_asc'])
                            <a class="send">
                                {{--<i>赠送<br>10%</i>--}}
                                <i>赠送<br>￥{{$vo['money_asc']/100}}</i>
                            </a>
                            @endif
                        <a class="prime_cost">实到：<i>{{($vo['money']+$vo['money_asc'])/100}}</i>元</a>
                    </span>
                        <span class="line3">
                          价目表
                      </span>
                        @foreach($vo['h_type_list'] as $k2=>$v2)
                        <span class="line4"><i>{{$v2['start_second_format']}} - {{$v2['end_second_format']}}</i>：<i>{{$v2['price']/100}}</i>元/IP</span>
                        @endforeach
                        <a data-id="1" data-money="50" data-buytype="recharge" class="act_pay pay">立即充值</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="banner reg">

        <i class="banner1" id="toLeft"></i><i class="banner2" id="toRight"></i>
        <h1></h1>
        <ul class="list">
            <li>
                <span class="td1"></span>
                <a>每个IP低至0.02元<br>获取不扣费，使用才扣费</a>
            </li>
            <li>
                <span class="td2"></span>
                <a>永久去重<br>永远不会用到重复的IP</a>
            </li>
            <li>
                <span class="td3"></span>
                <a>接口单次提取数量400<br>请求时间&lt;1秒</a>
            </li>
            <li>
                <span class="td4"></span>
                <a>每日提取数量及使用数量不限制<br>并发请求数量不限制</a>
            </li>
            <li>
                <span class="td5"></span>
                <a>延迟≤10毫秒<br>可用性≥99.99% </a>
            </li>
            <li>
                <span class="td6"></span>
                <a>每日30万高匿名且稳定达24小时IP<br>全部IP皆运营商官方授权产生</a>
            </li>
        </ul>
    </div>

    <div class="h1_pro" style="display:none;">
        <h1>友情提示</h1>
        <p>
            尊敬的客户您好：套餐可以购买多个叠加使用，多个套餐同时使用优先扣除先购买的套餐。
            <br>
        </p>
        <i class="iconfont"></i>
    </div>

    {{--<h1 class="big_customer"><i class="iconfont"></i>大客户专区</h1>--}}
    {{--<ul class="main_customer">--}}
        {{--<li>--}}
            {{--<span class="money">2000</span>--}}
            {{--<span class="reality">实到<a>2600</a>元</span>--}}
            {{--<a class="recharge act_pay" data-id="5" data-buytype="recharge" data-money="2000">立即充值</a>--}}
            {{--<span class="give">额外送<a>30%</a></span>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<span class="money">5000</span>--}}
            {{--<span class="reality">实到<a>7000</a>元</span>--}}
            {{--<a class="recharge act_pay" data-id="6" data-buytype="recharge" data-money="5000">立即充值</a>--}}
            {{--<span class="give">额外送<a>40%</a></span>--}}
        {{--</li>--}}

        {{--<li>--}}
            {{--<div class="phone">--}}
                {{--<img src="http://static.http.cnapi.cc/static/kefu/hengyongchao.png" class="kefu-img" alt="客户经理">--}}
            {{--</div>--}}
            {{--<div class="text">--}}
                {{--<h2>大客户定制</h2>--}}
                {{--<p>打开微信“扫一扫”<br>联系平台客户经理</p>--}}
            {{--</div>--}}
        {{--</li>--}}

    {{--</ul>--}}
@endsection