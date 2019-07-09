@extends('Index.app')
@section('title',$title)

@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.alert_index')
@section('main')

    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/index2.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/iframe_consult.css" />
    {{--<link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/http_setmenu.css" />--}}

    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/user/ucenter.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/user/jquery.lineProgressbar.min.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/user/hucenter.css" />

<section class="uc-main" style="margin-top:100px;">
    <aside class="uc-aside">
        <div id="user_info">
            <div class="user-info" style="display: block">
                <img src="{{asset('index_src/img')}}/no_pic.jpg" class="ava">
                <a class="user-name" >{{$info['account']}}</a>
                <span class="user-label vip">
                    <img src="{{asset('index_src/img')}}/basics-vip.png" alt="">基础vip
                </span>
            </div>
        </div>

        @include('Index.User.left')

    </aside>
    <article class="uc-modules">
        <div class="mod-warp">

            {{--账号管理--}}
            <div class="module info ">
                <h4>账号设置</h4>
                <div class="uca-block">
                    <div class="user-counter">
                        <div class="uca-block-item us-time">
                            <h6>账户名称</h6>
                            <h4 class="uca_username">{{$info['account']}}</h4>
                            <a class="uc-btn change-pw ">修改密码</a>
                        </div>
                    </div>
                    <div class="uca-block-item uca-info">
                        <h6>账户余额</h6>
                        <h4 class="yu-e">{{$info['money']/100}}</h4>
                        <!--<a class="uc-btn" href="/pay/?action=money">立即充值</a>-->
                    </div>

                    {{--<div class="uca-block-item us-address">--}}
                        {{--<h6>最常使用地点</h6>--}}
                        {{--<h4 id="most_addr">--</h4>--}}
                        {{--<p>上次使用地点 <span id="last_addr">--</span></p>--}}
                    {{--</div>--}}

                </div>
            </div>

            {{--充值记录--}}
            <div class="module record ">
                {{--<div class="record-sel">--}}
                    {{--<h4><span>充值记录</span><i class="iconfont">&#xe617;</i></h4>--}}
                    {{--<ul class="download-sel">--}}
                        {{--<li data-tab="all" data-type="" id="all">全部记录</li>--}}
                        {{--<li data-tab="charge" data-type="open" id="charge_online">在线充值</li>--}}
                        {{--<li data-tab="card" data-type="convert" id="charge_card">卡密充值</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                <h4>充值记录</h4>
                <div class="rec-list">
                    <div class="uc-tables">
                        @if($order_list)
                            <ul class="th">
                                <li class="td td-1"><span><i class="iconfont"></i></span>订单名称</li>
                                <li class="td td-2"><span><i class="iconfont"></i></span>订单号</li>
                                <li class="td td-3"><span><i class="iconfont"></i></span>金额</li>
                                <li class="td td-4"><span><i class="iconfont"></i></span>支付方式</li>
                                <li class="td td-5"><span><i class="iconfont"></i></span>充值状态</li>
                                <li class="td td-6"><span><i class="iconfont"></i></span>时间</li>
                            </ul>
                            @foreach($order_list as $key=>$vo)
                                <div class="tr">
                                    <span class="td td-1">{{$vo['desc']}}</span>
                                    <span class="td td-2">{{$vo['order_no']}}</span>
                                    <span class="td td-3">{{$vo['pay_money']/100}}</span>
                                    <span class="td td-4">
                                        @if($vo['pay_type'] == 1)微信
                                        @elseif($vo['pay_type'] == 2)支付宝
                                        @else --
                                        @endif
                                    </span>
                                    <span class="td td-5">
                                        @if($vo['pay_status'] == 0)未支付
                                        @elseif($vo['pay_status'] == 1)已支付
                                        @elseif($vo['pay_status'] == 2)已取消
                                        @else --
                                        @endif
                                    </span>
                                    <span class="td td-6">{{$vo['created_at']}}</span>
                                </div>
                            @endforeach
                            {{--<div class="page" id="page"></div>--}}
                        @else
                            <div class="record-none">暂无记录</div>
                        @endif
                    </div>
                </div>
            </div>

            {{--ip白名单--}}
            <div class="module iplist ">
                    <h4>IP白名单</h4>
                    <div class="recharge-block uca-block">
                        <div class="set">
                            <h1>
                                设置IP白名单<i class="iconfont"></i>
                                <span class="titles">使用或者提取IP，都需要设置白名单！</span>
                                {{--<label for="">--}}
                                    {{--<a href="http://wapi.http.cnapi.cc/index/index/get_white_link" target="_blank" style="font-size: 10px">点击获取添加白名单接口</a>--}}
                                    {{--<a href="http://wapi.http.cnapi.cc/index/index/del_white_link" target="_blank" style="font-size: 10px">点击获取删除白名单接口</a>--}}
                                {{--</label>--}}
                            </h1>
                            <label for="">
                                <input type="text" name="" id="input_ip" value="" placeholder="请输入IP地址以添加">
                                <i class="iconfont"></i>
                                <a class="save_ip">保存</a>
                            </label>
                        </div>
                        <div class="set">
                            <h1>
                                IP白名单列表
                                <i class="iconfont"></i>
                                <span class="titles">默认保留最近5个IP，特殊需求请联系客服</span>
                            </h1>
                        </div>
                        <div class="uc-tables-h active">


                            <div class="record-none input_list">暂无记录</div>

                            <!--备注-->
                            <div class="u-modal remarks" style="position:absolute;z-index: 9999">
                                <div class="modal-main">
                                    <h3>修改备注</h3>
                                    <span class="close"></span>
                                    <input type="text" id="id" value="" readonly="" style="display: none">
                                    <textarea id="remark" placeholder="请输入备注信息"></textarea>
                                    <div class="btns">
                                        <a class="btn confirm" data-id="">确定</a>
                                        <a class="btn cancel">取消</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

            </div>

            <div class="module usemoney ">
                    <h4>余额使用记录<p class="mt-tips"><i class="iconfont"></i><span class="titles">您可查询近2周的使用记录，存在略微误差属正常情况，<br>更多使用记录请联系客服。</span></p></h4>
                    <div class="uc-tables-h active">
                        <div class="status">
                            <div class="content">
                                <h1 class="record">使用概况</h1>
                                <ul class="content_inner cont-li">
                                    <li>
                                        <h1>累计使用IP数量</h1>
                                        <h2 class="use_total">0个</h2>
                                    </li>
                                    <li>
                                        <h1>当日获取IP数量</h1>
                                        <h2 class="get_total">0个</h2>
                                    </li>
                                    <li>
                                        <h1>当日消耗金额</h1>
                                        <h2 class="get_total_money">null元</h2>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <form id="form_condition" class="form-search" method="get">
                            <div class="screen">
                                <!-- 后端直接引入 layer date 插件 -->
                                记录筛选
                                <!--           <label for="">
                                               <input type="text" id="'start_time" name="start_time" value="" style="width: 200px" class="start_time laydate-icon" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="起始时间" readonly>
                                               <a class="arrow"><i class="iconfont">&#xea09;</i></a>
                                           </label>
                                           <label for="">
                                               <input type="text" id="end_time" name="end_time" value="" class="finish_time" style="width: 200px" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="终止时间" readonly>
                                               <a class="arrow"><i class="iconfont">&#xea09;</i></a>
                                           </label>
                                           <label for="">
                                               <input type="text" name="" class="act_search" readonlyunselectable="on" value="立即搜索" readonly>
                                           </label>-->
                                <!--<div class="selet">-->
                                <!--<i class="iconfont">&#xea09;</i>-->
                                <!--</div>-->

                                <label for="">
                                    <input type="text" id="lang" class="selet lang" value="请选择" readonly="readonly">
                                    <div class="opt mCustomScrollbar _mCS_1 mCS_no_scrollbar" id="huangbiao" style="display: none;"><div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                                                <ul id="lang-list">
                                                    <!-- <li><a href="#">2018-10-25</a></li>
                                                     <li><a href="#">2018-10-24</a></li>
                                                     <li><a href="#">2018-10-23</a></li>
                                                     <li><a href="#">2018-10-22</a></li>
                                                     <li><a href="#">2018-10-21</a></li>
                                                     <li><a href="#">2018-10-20</a></li>-->
                                                    <li><a href="#">2019-07-05</a></li><li><a href="#">2019-07-04</a></li><li><a href="#">2019-07-03</a></li><li><a href="#">2019-07-02</a></li><li><a href="#">2019-07-01</a></li><li><a href="#">2019-06-30</a></li><li><a href="#">2019-06-29</a></li><li><a href="#">2019-06-28</a></li><li><a href="#">2019-06-27</a></li><li><a href="#">2019-06-26</a></li><li><a href="#">2019-06-25</a></li><li><a href="#">2019-06-24</a></li><li><a href="#">2019-06-23</a></li><li><a href="#">2019-06-22</a></li><li><a href="#">2019-06-21</a></li><li><a href="#">2019-07-05</a></li><li><a href="#">2019-07-04</a></li><li><a href="#">2019-07-03</a></li><li><a href="#">2019-07-02</a></li><li><a href="#">2019-07-01</a></li><li><a href="#">2019-06-30</a></li><li><a href="#">2019-06-29</a></li><li><a href="#">2019-06-28</a></li><li><a href="#">2019-06-27</a></li><li><a href="#">2019-06-26</a></li><li><a href="#">2019-06-25</a></li><li><a href="#">2019-06-24</a></li><li><a href="#">2019-06-23</a></li><li><a href="#">2019-06-22</a></li><li><a href="#">2019-06-21</a></li></ul>
                                            </div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
                                    <a class="arrows"><i class="iconfont lang" id=""></i></a>
                                </label>
                                <label for="">
                                    <input type="text" name="" class="act_search" readonlyunselectable="on" value="立即搜索" readonly="">
                                </label>
                            </div>

                        </form>
                        <div class="none will_input"></div><div class="record-none input_use_history">暂无记录</div>

                    </div>
                    <div class="page1-list" style="position: relative;top: -60px;">
                        <ul>
                            <div id="page1"></div>
                        </ul>
                    </div>

            </div>

        </div>
    </article>
</section>
<!--开通账号 normal warning -->
<div class="modal m-open-account">
    <div class="modal-info-main">
        <button class="close" onclick="if($('#all_is_success').val()=='1'){ location.reload()}">
            <span></span>
        </button>

        <h2>开通账号</h2>
        <div class="table">


        </div>

        <div class="opening">
            <p>正在开通中，请稍候...</p>
        </div>

        <div class="content" style="display: none">
            <div class="status">
                <h3 class="succ_h3">开通成功！</h3>
                <h3 class="fail_h3">开通失败！</h3>
                <p class="error-info">
                    抱歉，本次开通失败！为避免重复开通，本订单中的所有账号均未充值，也未产生扣费行为。请您检查标红的用户名，或联系官网客服人员。
                </p>
                <div class="succ-info">
                    <ul>
                        <li>
                            <p>充值账户：</p>
                            <span class="span_user_num"></span>
                        </li>
                        <li>
                            <p>原余额：</p>
                            <span class="span_pay_money"></span>
                        </li>
                        <li>
                            <p>消费金额：</p>
                            <span class="span_order_money"></span>
                        </li>


                        <li>
                            <p>现余额：</p>
                            <span class="span_last_money"></span>
                        </li>
                    </ul>
                </div>
            </div>
            <!--<div class="btns-group">-->
            <!--<a class="btn">确定</a>-->
            <!--<a class="btn cancel">取消</a>-->
            <!--</div>-->
        </div>
    </div>
</div>

<div class="modal m-edit-password ">
    <div class="modal-info-main">
        <button class="close">
            <span></span>
        </button>
        <div class="m-title">
            <i class="iconfont">&#xe655;</i>
            <h4>修改密码</h4>
        </div>
        <form action="" method="" id="form_edit_pwd">
            <div class="edit-form">
                <div class="edf-line edf_line">
                    <i class="iconfont">&#xe62c;</i>
                    <input type="password" placeholder="旧密码" name="old_pwd" class="old_pwd" >
                    <span></span>
                    <div class="error-info ">
                        <i class="iconfont">&#xe630;</i>
                        旧密码输入错误
                    </div>
                </div>
                <div class="edf-line edf_line">
                    <i class="iconfont">&#xe692;</i>
                    <input type="password" placeholder="新密码" name="new_pwd" class="new_pwd" >
                    <span></span>
                    <div class="error-info ">
                        <i class="iconfont">&#xe630;</i>
                        新密码格式不正确
                    </div>
                </div>
                <div class="edf-line edf_line">
                    <i class="iconfont">&#xe602;</i>
                    <input type="password" placeholder="确认密码" name="re_pwd" class="re_pwd" >
                    <span></span>
                    <div class="error-info ">
                        <i class="iconfont">&#xe630;</i>
                        确认密码格式不正确
                    </div>
                </div>
                <div class="edf-line edf-var edf_line">
                    <i class="iconfont">&#xe605;</i>
                    <input placeholder="验证码" name="verify" value="" class="verify_pwd" >
                    <span></span>
                    <img class="img_verify" title="点击获取" src="{{captcha_src('flat')}}" style="cursor: pointer" onclick="this.src='{{captcha_src('flat')}}'+Math.random()">
                    <div class="error-info ">
                        <i class="iconfont">&#xe630;</i>
                        验证码错误
                    </div>
                </div>
                <div class="edf-btn-group">
                    <a class="edf-btn" id="edit_pwd">修改密码</a>
                    <a class="edf-btn cancel">取消</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal set-up set-up-account">
    <div class="modal-info-main">
        <button class="close">
            <span></span>
        </button>
        <div class="m-title">
            <i class="iconfont">&#xe668;</i>
            <h4>绑定/创建账户</h4>
        </div>
        <form action="" method="" id="form_bind_account">
            <div class="edit-form">
                <div class="edf-line">
                    <i class="iconfont">&#xe619;</i>
                    <input placeholder="用户名" name="bind_username"  value="" class="bind_username">
                    <span></span>
                    <div class="error-info error_bind_username">
                        <i class="iconfont">&#xe630;</i>
                        请输入正确的用户名
                    </div>
                </div>
                <div class="edf-line edf_line">
                    <i class="iconfont">&#xe62c;</i>
                    <input type="password" placeholder="密码" name="bind_pwd" class="bind_pwd" onkeydown="KeyDown()">
                    <span></span>
                    <div class="error-info error_bind_pwd">
                        <i class="iconfont">&#xe630;</i>
                        旧密码输入错误
                    </div>
                </div>
                <input type="hidden" name="verify_id" value="5">
                <div class="edf-btn-group">
                    <a class="edf-btn" id="bind_account">绑定/创建账户</a>
                    <a class="edf-btn cancel">取消</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="inform-modal">
    <div class="inform-modal-inner">
        <i class="iconfont  btn close">&#xe627;</i>
        <h1>系统提示</h1>
        <p>基础VIP剩余<b class="vip_up_days">0</b>天，升级为</p>
        <p>高级套餐仅需</p>
        <p class="info_tips"><span class="vip_up_money">0</span>元</p>
        <a class="info-btn1 active1">  </a>
        <a class="info-btn2"><i class="iconfont">&#xe674;</i> <span>微信支付</span> </a>
        <span class="sp_btn vip_order_do">确认付款</span>
    </div>
</div>
<!--注册引导弹框-->

<!--登陆注册客服弹框-->
<div class="layerContnet win-bind" style="display: none">
    <!-- 注册 -->
    <div class="layerinner win">
        <div class="win-con">
            <div class="wx-code">
                <img src="http://zmdl-static.upupfile.com/static/ip_new/img/ucenter/zmkf.png" class="kefu-wechat"/>
            </div>
            <p class="tit">客户经理</p>
            <p class="tit1">微信二维码</p>
            <div class="contact">
                <div class="left"><img src="http://zmdl-static.upupfile.com/static/ip_new/img/ucenter/qq.png" /><span class="kefu-qq">493956220</span></div>
                <div class="right"><img src="http://zmdl-static.upupfile.com/static/ip_new/img/ucenter/phone.png" /><span class="kefu-phone">19034213432</span></div>
            </div>
        </div>
        <div class="close">
            <i class="iconfont">&#xe627;</i>
        </div>
    </div>
</div>
<div class="layer_weixin" style="display: none">
    <div class="weixin_inner ">
        <h3>打开微信“扫一扫”支付</h3>
        <img style="width: 200px;height: 200px" src="" alt="">
    </div>
</div>


<div class="discounts" style="display: none;">
    <!-- 优惠 -->
    <div class="layerinner discountse">
        <div class="win-con">
            <p class="tit1">关注公众号</p>
            <div class="wx-code">
                <img src="http://zmdl-static.upupfile.com/static/ip_new/img/zm-logo.jpg" />
            </div>
            <div class="contact">
                免费领取更多优惠
            </div>
        </div>
        <div class="close">
            <i class="iconfont">&#xe627;</i>
        </div>
    </div>
</div>
<!--转增弹框-->

<!--优惠券弹窗-->
<div class="pop-up" style="display: none;">
    <div class="pop-cont">
        <div class="pop-left">
            <span>¥</span>5
        </div>
        <div class="pop-right">
            <p>优惠券</p>
            <div class="end-times">

            </div>
        </div>
        <div class="expire">会员剩余7天到期，续费享限时优惠</div>
        <a href="/pay/"class="recharges">立即充值</a>
        <div class="pop-close">
            <img src="http://zmdl-static.upupfile.com/static/ip_new/img/ucenter/pop-close.png" alt="">
        </div>
    </div>
</div>


    <script type="text/javascript" src="{{asset('index_src/js/user')}}/jquery.qrcode.min.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/copy.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/mCustomScrollbar.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/laypage.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/modal.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/uc-control.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/ucenter.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/accountucenter.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/x_ucenter.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/ucenter_order.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/jquery.lineProgressbar.js"></script>

<script type="text/javascript">
    $(function(){

        $(document).on('click','.open_btn',function () {
            if($(this).hasClass('shadow')) return false;
            var username_list=$('.username_list').val();
            var username_arr=username_list.split("\n");
            var users=[];
            username_arr.forEach(function (value) {
                if(value){
                    users.push(value);
                }
            });
            if(users.length==0){
                return false;
            }

            $('.m-open-account .table').html(null);

            $('.m-open-account .opening').show();
            $('.m-open-account .content').hide();

            modal.OpenAccount.open();
    });

        var f=GetQueryString('f');
        var up_ac=GetQueryString('action');

        function numRun(user_id) {
            var numRun4 = $(".numberRun4").numberAnimate({num:user_id, speed:2000});
            var nums4 = user_id;
            var a =String(nums4).split('');
            // var b = a.length;
            $.each(a,function(){
                $(".frames_content").append("<span class='frames'></span>");
            })
        };

    })
    function GetQueryString(name)
    {
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if(r!=null)return  decodeURI(r[2]); return null;
    }
</script>

<script>
$(document).on("click",'.t-span',function () {
    // $(this).prev("input").addClass("red");
    $('input[name="deposit_card"]').removeAttr("checked");
    $(this).prev("input").attr("checked","checked");
})

    //点击关闭
    $(".add-package .close").click(function () {
        $(".add-package").hide()
        $(".add-package").css("opacity","1")
    })


    //注册成功弹窗
    $(document).on('click','.successes .close',function () {
        $('.inform-modal').fadeOut();
    })
    //支付成功弹窗关闭
    $(document).on('click','.m-result .shut',function () {
        $('.m-result').fadeOut();
        $('.deposit-gold').fadeIn();
    })
    //提取体验金弹窗关闭
    $(document).on('click','.m-gold .shut',function () {
        $('.m-gold').fadeOut();
    })

    //个人中心提现弹窗关闭
    $(document).on('click','.now',function () {
        $('.m-golds').fadeOut();
    })

</script>

<div class="modal m-uc-exit ">
    <div class="modal-info-main">
        <button class="close">
            <span></span>
        </button>
        <div class="m-title ">
            <i class="iconfont">&#xe644;</i>
            <h4 >确认退出吗?</h4>
        </div>
        <div class="edit-form">
            <div class="edf-btn-group">
                <a class="edf-btn ok_save logout-link">确认</a>
                <a class="edf-btn cancel">取消</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

@endsection