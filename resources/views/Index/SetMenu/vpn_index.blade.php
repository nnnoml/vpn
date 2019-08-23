@extends('Index.app')

@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.foot_index')
@extends('Index.Common.alert_index')
@section('main')

    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/setMenu.css" />
    <section class="section">
        <div class="container">
            <div class="left">
                <h1>基础套餐</h1>
                {{--<ul>--}}
                    {{--<li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">支持Windows客户端</li>--}}
                    {{--<li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">线路延迟：80~100ms</li>--}}
                    {{--<li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/error.png" alt="">支持静态线路</li>--}}
                    {{--<li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/error.png" alt="">支持浏览器插件</li>--}}
                {{--</ul>--}}
                {{--<ul>--}}
                    {{--<li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">支持Android客户端</li>--}}
                    {{--<li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">每日20万IP</li>--}}
                    {{--<li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/error.png" alt="">支持极速线路</li>--}}
                    {{--<li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/error.png" alt="">支持MAC客户端</li>--}}
                {{--</ul>--}}
                {{--<ul>--}}
                    {{--<li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">支持iOS客户端</li>--}}
                    {{--<li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">售后服务：普通客服</li>--}}
                    {{--<li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/error.png" alt="">支持直连线路</li>--}}
                    {{--<li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/error.png" alt="">长效动态</li>--}}
                {{--</ul>--}}
            </div>
            <div class="right-img"></div>
        </div>

    </section>
    <form id="order_form" method="post" action="" target="_blank">
        <div class="content_inner fadeInUp">

            {{--<div class="pack-tips get-red-packet">--}}
                {{--<span></span>--}}
                {{--<h4>定制路线</h4>--}}
                {{--<div class="inner-text">--}}
                    {{--<p><i class="iconfont"></i>定制全国任意省会城市路线</p>--}}
                    {{--<p><i class="iconfont"></i>独享一手纯净IP</p>--}}
                    {{--<p><i class="iconfont"></i>高速上下行,不限速</p>--}}
                    {{--<p><i class="iconfont"></i>提供api或者客户端</p>--}}
                    {{--<p><i class="iconfont"></i>更多权利,等你咨询</p>--}}
                    {{--<a class="sur_link">立即联系客服</a>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="package_content package_content_open">
                @foreach($list as $key=>$vo)
                <div data-id="{{$vo['p_id']}}" class="package_list">
                    <h1>{{$vo['desc']}}</h1>
                    <h2>{{($vo['money']-$vo['money_sub'])/100}}</h2>
                    <h3>原价：{{$vo['money']/100}}元</h3>
                        {{--一个月--}}
                    @if($vo['time_length'] == '2592000')
                        <span class="feedback-red">¥{{($vo['money']-$vo['money_sub'])/100}}/<a>月</a></span>
                        {{--两个月--}}
                    @elseif($vo['time_length'] == '5184000')
                        <span class="feedback-red">¥{{ceil(($vo['money']-$vo['money_sub'])/100/2)}}/<a>月</a></span>
                        {{--六个月--}}
                    @elseif($vo['time_length'] == '15552000')
                        <span class="feedback-red">¥{{ceil(($vo['money']-$vo['money_sub'])/100/6)}}/<a>月</a></span>
                        {{--十二个月--}}
                    @elseif($vo['time_length'] == '31536000')
                        <span class="feedback-red">¥{{ceil(($vo['money']-$vo['money_sub'])/100/12)}}/<a>月</a></span>
                        {{--非标准单位--}}
                    @else
                        <span class="feedback-red">¥{{($vo['money']-$vo['money_sub'])/100}}/<a>{{$vo['unit']}}</a></span>
                    @endif
                    <div class="choice">
                        {{--一个月--}}
                        @if($vo['time_length'] == '2592000')
                        <label for="" class="Bt_val">
                            <button type="button" name="button" class="reduce"><i class="iconfont"></i></button>
                        </label>
                        <label for="" class="lab_val">
                            <input type="text" price="{{($vo['money']-$vo['money_sub'])/100}}" readonly value="1" class="buy_num">
                            <span>个月</span>
                        </label>
                        <label for="" class="Bt_val">
                            <button type="button" name="button" class="add"><i class="iconfont"></i></button>
                        </label>
                        {{--两个月--}}
                        @elseif($vo['time_length'] == '5184000')
                            <label for="" class="lab_val lable_only">2个月</label>
                        {{--六个月--}}
                        @elseif($loop->index==2)
                            <label for="" class="lab_val lable_only ">6个月</label>
                        {{--十二个月--}}
                        @elseif($loop->index==3)
                            <label for="" class="lab_val lable_only">12个月</label>
                        {{--非标准单位--}}
                        @else
                            <label for="" class="lab_val lable_only">{{$vo['unit']}}</label>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <div class="entry">

                <div for="" class="entry_list">
                    <span class="h1_span">账户名称</span>
                    {{--<p class="line-tip package_account_reg">没有账号?<a class="reg_modal">立即注册</a></p>--}}
                    <input type="text" name="username" value="{{$account}}" placeholder="请输入账户名称" class="entry_input pay_p login-username">
                    <span class="close"></span>
                </div>

                {{--<div for="" class="entry_list coupon_div_activity" >--}}
                    {{--<span class="h1_span">优惠券</span>--}}
                    {{--<label for="" class="" style="display:none">--}}
                        {{--<input type="text" value="" placeholder="请输入优惠券卡号" class="entry_input entry_input1 coupon_text">--}}
                        {{--<span class="close close1"></span>--}}
                        {{--<span class="confirms confirms1 coupons_ok">确认使用</span>--}}
                        {{--<span class="confirms pay_cancel">取消使用</span>--}}
                    {{--</label>--}}
                    {{--<div class="coupon">--}}
                        {{--<a class="coupon_inner"></a>--}}
                        {{--<span>优惠券仅在活动期间发放，活动时间请关注微信公众号“zhimadaili”</span>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <!--新增套餐抵用劵-->
                <!--       <div for="" class="entry_list" >
                           <span class="h1_span">套餐抵用券</span>
                           <div class="coupons-sel">
                               <h4 class="coupons-h4">
                                   &lt;!&ndash;有抵用劵的样式&ndash;&gt;
                                   <p><i style="font-style: normal" class="coupons-name">抵用券</i> <span><i style="font-style: normal" class="coupons-num">0</i>张可用</span></p>
                                   &lt;!&ndash;无抵用卷的样式&ndash;&gt;
                                   &lt;!&ndash;<p class="gray">暂无优惠券可选</p>&ndash;&gt;
                                   <i class="iconfont">&#xe617;</i>
                               </h4>
                               <ul class="download-sel">
                                   &lt;!&ndash;
                                   <li>芝麻代理20元套餐抵用券（有效期至2018-02-22）</li>
                                   <li>芝麻代理20元套餐抵用券（有效期至2018-02-23）</li>
                                   <li>芝麻代理20元套餐抵用券（有效期至2018-02-24）</li>
                                   &ndash;&gt;
                               </ul>
                           </div>
                       </div>-->

                <div class="entry_list payment_list">
                    <span class="h1_span">支付方式</span>
                    <div class="payment sel active" data-type="alipay">
                        <span class="choice_ok active"></span>
                        <i class="iconfont active"></i>
                        支付宝支付
                        <!--<span class="discount"><i>惠</i>立减1元</span>-->
                    </div>
                    <div class="payment" data-type="wechat">
                        <span class="choice_ok"></span>
                        <i class="iconfont"></i>
                        微信支付
                    </div>
                </div>
                <div class="entry_list">
                    账单合计<span class="price">￥--</span>元
                    <!--<span class="discount discount_ali active"><i>惠</i>支付优惠，已省1元</span>-->
                    <span class="discount discount_reg_new"><i>惠</i>新客立减，已省<a>--</a>元</span>
                    <span class="discount discount_coupon"><i>惠</i>优惠券，已省<a>--</a>元</span>
                    <span class="discount discount_rec_user"><i>惠</i>推荐人优惠，已省<a>--</a>元</span>
                    <span class="discount pay_last" style="display: none">当前余额：<a class="zm_m_3">0</a>元，本次支付后余额<a class="zm_m_1">0</a>元</span>
                    <span class="discount last_money active" style="display: none">当前余额：<a class="zm_m_3">0</a>元<a class="act-recharge" onclick="$('.choise .item:eq(2)').trigger('click')">立即充值，获取优惠</a></span>
                </div>
                <div class="entry_list">
                    <a class="choice_a pay_can active" id="pay_btn" style="display: none">
                        确认购买
                    </a>
                    <a class="choice_a pay_not">
                        确认购买
                    </a>
                </div>
            </div>
        </div>
    </form>
    <div class="layer_weixin">
        <div class="weixin_inner ">
            <h1>打开微信“扫一扫”支付</h1>
            <img src="" alt="">
            <span></span>
        </div>
    </div>

    <script type="text/javascript" src="{{asset('index_src/js')}}/setMenu.js"></script>

@endsection