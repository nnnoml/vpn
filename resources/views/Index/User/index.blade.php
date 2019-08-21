@extends('Index.app')

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
    <link rel="stylesheet" type="text/css" href="{{asset('plug/layui/css')}}/layui.css" />

<section class="uc-main" style="margin-top:100px;">
    <aside class="uc-aside">
        <div id="user_info">
            <div class="user-info" style="display: block">
                <img src="{{asset('index_src/img')}}/no_pic.png" class="ava">
                <a class="user-name" >{{$info['account']}}</a>
                @if($info['level'])
                <span class="user-label vip">
                    <img src="{{asset('index_src/img')}}/basics-vip.png" alt="">基础vip
                </span>
                @endif
            </div>
            <div class="user-account" style="">
                @if(!isset($info['vpn_deadline']))
                    <div class="uc-ac-block no_record">
                        <p>尚未开通，购买立享会员服务</p>
                        <a href="/setMenu/vpn">购买套餐</a>
                    </div>
                @else
                    <h4>VPN到期时间</h4>
                    <h4>{{$info['vpn_deadline']}}</h4>
                @endif
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
                <div class="record-sel" data-tab="">
                    <h4><span>充值记录</span><i class="iconfont">&#xe617;</i></h4>
                    <ul class="download-sel">
                        <li data-tab="">全部记录</li>
                        <li data-tab="1">已支付订单</li>
                        <li data-tab="0">未支付订单</li>
                    </ul>
                </div>
                <h4>充值记录</h4>
                <div class="rec-list">
                    <div class="uc-tables">
                        @if($order_list['list'])
                            <ul class="th">
                                <li class="td td-1"><span><i class="iconfont"></i></span>订单名称</li>
                                <li class="td td-2"><span><i class="iconfont"></i></span>订单号</li>
                                <li class="td td-3"><span><i class="iconfont"></i></span>金额</li>
                                <li class="td td-4"><span><i class="iconfont"></i></span>支付方式</li>
                                <li class="td td-5"><span><i class="iconfont"></i></span>充值状态</li>
                                <li class="td td-6"><span><i class="iconfont"></i></span>时间</li>
                            </ul>
                            <div id="orderList">
                            @foreach($order_list['list'] as $key=>$vo)
                                <div class="tr">
                                    <span class="td td-1" style="text-align: left;">{{$vo['order_title']}}</span>
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
                                    <span class="td td-6"
                                        @if($vo['p_type']==1 && $vo['vpn_deadline'])
                                          onmouseenter="layer.tips('本订单vpn到期时间：<br /> {{$vo['vpn_deadline']}}', this)"
                                        @endif
                                    >{{$vo['created_at']}}</span>
                                </div>
                            @endforeach
                            </div>
                            <div id="order_list_page"></div>
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

                        @if($white_list)
                            <ul class="th input_list">
                                <li class="td td-5"><span></span>IP地址</li>
                                <li class="td td-7"></span>操作</li>
                            </ul>
                            @foreach($white_list as $key=>$vo)
                                <div class="tr">
                                    <span class="td td-6">{{$vo}}</span>
                                    <span class="td td-8"><a class="dels do_del white_list_del" data-ip="{{$vo}}">删除</a></span>
                                </div>
                            @endforeach
                        @else
                            <div class="record-none input_list">暂无记录</div>
                        @endif

                        </div>
                    </div>

            </div>

            <div class="module usemoney ">
                    <h4>余额使用记录<p class="mt-tips"><i class="iconfont"></i><span class="titles">您可查询近2周的使用记录，存在略微误差属正常情况，<br>更多使用记录请联系客服。</span></p></h4>
                    <div class="uc-tables-h active">
                        {{--<div class="status">--}}
                            {{--<div class="content">--}}
                                {{--<h1 class="record">使用概况</h1>--}}
                                {{--<ul class="content_inner cont-li">--}}
                                    {{--<li>--}}
                                        {{--<h1>累计使用IP数量</h1>--}}
                                        {{--<h2 class="use_total">0个</h2>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<h1>当日获取IP数量</h1>--}}
                                        {{--<h2 class="get_total">0个</h2>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<h1>当日消耗金额</h1>--}}
                                        {{--<h2 class="get_total_money">null元</h2>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <form id="form_condition" class="form-search" method="get">
                            <div class="screen">
                                <!-- 后端直接引入 layer date 插件 -->
                               {{--<label for="">--}}
                                   {{--<input type="text" id="'start_time" name="start_time" value="" style="width: 200px" class="start_time laydate-icon" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="起始时间" readonly>--}}
                                   {{--<a class="arrow"><i class="iconfont">&#xea09;</i></a>--}}
                               {{--</label>--}}
                               <label for="">
                                   {{--<input type="text" id="end_time" name="end_time" value="" class="finish_time" style="width: 200px" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="终止时间" readonly>--}}
                                   {{--<a class="arrow"><i class="iconfont">&#xea09;</i></a>--}}
                                   <input type="text" class="layui-input" id="usemoney_input" placeholder="请选择日期">
                               </label>
                               <label for="">
                                   <input type="text" name="" class="act_search" readonlyunselectable="on" value="立即搜索" readonly>
                               </label>
                            </div>

                        </form>
                            @if($use_money_list)
                                <ul class="th input_list">
                                    <li class="td td-5"><span></span>计费类型</li>
                                    <li class="td td-7"></span>计费金额</li>
                                    <li class="td td-7"></span>计费时间</li>
                                </ul>
                                <div id="useMoneyList">
                                @foreach($use_money_list['list'] as $key=>$vo)
                                    <div class="tr">
                                        <span class="td td-6">{{$vo['iptype_format']}}
                                        @if($vo['log_ty']==1)
                                            按次余额
                                        @else
                                            按次扣次
                                        @endif
                                        </span>
                                        <span class="td td-6">{{$vo['money']/100}}</span>
                                        <span class="td td-6">{{$vo['create_time']}}</span>
                                    </div>
                                @endforeach
                                </div>
                            @else
                                <div class="record-none input_list">暂无记录</div>
                            @endif
                            <div id="usemoney_page"></div>
                        </div>
                        {{--<div class="none will_input"></div><div class="record-none input_use_history">暂未开放</div>--}}
            </div>

        </div>
    </article>
</section>

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
                <a href="/user/loginOut" class="edf-btn ok_save logout-link">确认</a>
                <a class="edf-btn cancel">取消</a>
            </div>
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
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/ucenter_order.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/jquery.lineProgressbar.js"></script>

    <script type="text/javascript" src="{{asset('plug/layui')}}/layui.js"></script>
    <script>
        var order_list_count = {{$order_list['count']}};

        $("#usemoney_input").val("{{$use_money_list['date']}}")
        var use_money_list_count = {{$use_money_list['count']}};
    </script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/useMoney.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js/user')}}/OrderList.js"></script>

    </body>
</html>

@endsection