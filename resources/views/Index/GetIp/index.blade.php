@extends('Index.app')
@section('title',$title)

@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.foot_index')
@extends('Index.Common.alert_index')
@section('main')

    {{--<link rel="stylesheet" type="text/css" href="http://vpns.com/index_src/css/index2.css" />--}}


    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/index2.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/iframe_consult.css" />

    <link href="http://static.http.cnapi.cc/static/index/src/css/newApi.css" rel="stylesheet">


    <section style="margin-top:120px;">
        <div class="dial_left fadeInLeft">
            <h1>提取IP/生成IP</h1>
            <div class="region">
                <div class="region_list">
                    <h1 class="left">请选择提取类型</h1>
                    <div class="right">
                        <div class="set_meal">
                            <a>按次提取</a>
                            <ul class="m_zlxg3 mCustomScrollbar _mCS_3 mCS_no_scrollbar" style="display: none;"><div id="mCSB_3" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0" style="max-height: 45px;"><div id="mCSB_3_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                                        <li class="savecookie" id="package_list">按次提取</li>
                                    </div><div id="mCSB_3_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_3_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 0px; top: 0px; max-height: 7px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></ul>
                        </div>
                        <div class="free_btn ok_free_btn"><a id="get_free_day_package">领取每日免费IP</a></div>
                    </div>
                    <input type="hidden" id="use_package_id" value="">
                    <input type="hidden" id="use_package_type" value="">
                </div>
                <h1>
                    账户概况
                    <span class="left">获取不扣费，使用才扣费</span>
                </h1>
                <div class="survey survey1" id="balance_div" style="display: block;">
                    <div class="survey_content">
                        <div class="line1">
                                          <span class="left balance_money">
                                              <a>当前账户余额（芝麻币）</a>
                                              <a id="balance">0</a>
                                              <input type="hidden" id="balance_money" value="0">
                                          </span>
                            <a class="actPay" href="/pay/" target="_blank">立即充值</a>
                            <a class="right go_to_pay gologin" style="display: none">您还未登录！<i class="page_login">立即登录</i></a>
                            <a href="/pay/#recharge" class="right" id="balance_lower" style="display: none">您的余额不足，<i class="">立即充值</i></a>

                        </div>
                        <ul class="line2">
                        </ul>
                    </div>
                </div>
                <div class="region_list no_long_pack" id="get_number_div">
                    <h1 class="left">提取数量</h1>
                    <div class="right">
                        <!--<div id="Demo">-->
                        <!--<div id="Main">-->
                        <!--<div id="scrollBar">-->
                        <!--<div id="scroll_Track"></div>-->
                        <!--<div id="scroll_Thumb"></div>-->
                        <!--</div>-->
                        <!--<span class="img_1"><i></i><span>20个</span></span>-->
                        <!--<span class="img_2"><i></i><span>2500个</span></span>-->
                        <!--<span class="img_3"><i></i><span>5000个</span></span>-->
                        <!--<span class="img_4"><i></i><span>10000个</span></span>-->
                        <!--</div>-->
                        <!--<div id="count" class="count">-->
                        <!--<i class="left savecookie" id="left">-</i>-->
                        <!--<span id="scrollBarTxt" class="savecookie">0</span>-->
                        <!--<i class="right savecookie" id="right">+</i>-->
                        <!--</div>-->
                        <!--&lt;!&ndash; <a href="#" class="new_pro">联系平台客服定制单次数量></a> &ndash;&gt;-->
                        <!--</div>-->

                        <div id="Demo">
                            <div id="Main">
                                <div id="scrollBar">
                                    <div id="scroll_Track" style="width: 2px;"></div>
                                    <div id="scroll_Thumb" style="margin-left: 0px;"></div>
                                </div>
                                <!--<span id="scrollBarTxt" style="text-align:center;"></span>-->
                                <span class="img_1"><i></i><span>1个</span></span>
                                <!--<span class="img_2"><i></i>2500个</span>-->
                                <span class="img_3"><i></i><span id="scrollBarmid">200个</span></span>
                                <span class="img_4"><i></i><span id="scrollBarend">400个</span></span>
                            </div>
                            <div id="count" class="count">
                                <i class="left savecookie" id="left">-</i>
                                <span id="scrollBarTxt" class="savecookie">1</span>
                                <i class="right savecookie" id="right">+</i>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="region_list">
                    <h1 class="left">
                        IP协议
                    </h1>
                    <div class="right agent">
                        <label>
                            <input type="radio" name="port_type" class="savecookie" value="1" checked="checked">
                            <i class="radios"></i>
                            HTTP
                        </label>
                        <label class="no_long_pack">
                            <input type="radio" name="port_type" class="savecookie" value="11">
                            <i class="radios"></i>
                            HTTPS
                        </label>

                        <label>
                            <input type="radio" name="port_type" class="savecookie" value="2">
                            <i class="radios"></i>
                            SOCKS5
                        </label>
                    </div>
                </div>
                <div class="region_list">
                    <h1 class="left time_length">
                        稳定使用时长
                    </h1>
                    <div class="right stable time_length">

                        <label>
                            <input type="radio" name="time_select" class="savecookie" value="1" checked="checked" data-id="1">
                            <i class="radios"></i>
                            05分钟至25分钟【0.04芝麻币/个】                  </label>
                        <label>
                            <input type="radio" name="time_select" class="savecookie" value="2" data-id="2">
                            <i class="radios"></i>
                            25分钟至03小时【0.1芝麻币/个】                  </label>
                        <label>
                            <input type="radio" name="time_select" class="savecookie" value="3" data-id="3">
                            <i class="radios"></i>
                            03小时至06小时【0.2芝麻币/个】                  </label>
                        <label>
                            <input type="radio" name="time_select" class="savecookie" value="4" data-id="4">
                            <i class="radios"></i>
                            06小时至12小时【0.5芝麻币/个】                  </label>
                        <label>
                            <input type="radio" name="time_select" class="savecookie" value="7" data-id="7">
                            <i class="radios"></i>
                            48小时至72小时【5芝麻币/个】                  </label>

                        <a href="http://h.zhimaruanjian.com/help/" target="_blank" class="more">了解更多&gt;</a>
                    </div>
                </div>

                <div class="region_list">
                    <h1 class="left">
                        数据格式
                    </h1>
                    <div class="right agent">
                        <label class="buttons ">
                            <input type="radio" name="data_type" value="1" checked="checked" class="buttons_txt">
                            <i class="radios"></i>
                            TXT
                        </label>
                        <label class="buttons ">
                            <input type="radio" name="data_type" value="2" class="buttons_json">
                            <i class="radios"></i>
                            JSON
                        </label>
                        <label class="buttons ">
                            <input type="radio" name="data_type" value="3" class="buttons_html">
                            <i class="radios"></i>
                            HTML
                        </label>
                    </div>
                </div>


                <!-- 分隔符 -->
                <div class="region_list choose_fg">
                    <h1 class="left">
                        分隔符
                    </h1>
                    <div class="right stable">
                        <label class="choose_txt">
                            <input type="radio" name="line_break" value="1" checked="checked">
                            <i class="radios"></i>
                            回车换行（ \ r \ n ）
                        </label>
                        <label class="choose_html" style="display:none">
                            <input type="radio" name="line_break" value="2">
                            <i class="radios"></i>
                            换行（ /br )
                        </label>
                        <label class="choose_txt">
                            <input type="radio" name="line_break" value="3">
                            <i class="radios"></i>
                            回车（ \ r )
                        </label>
                        <label class="choose_txt">
                            <input type="radio" name="line_break" value="4">
                            <i class="radios"></i>
                            换行（ \ n )
                        </label>
                        <label class="choose_txt">
                            <input type="radio" name="line_break" value="5">
                            <i class="radios"></i>
                            Tab（ \ t )
                        </label>

                        <label class="choose_other">
                            <input type="radio" name="line_break" value="6">
                            <i class="radios"></i>
                            其他符号:
                        </label>
                        <input type="text" name="special" id="special_break" value="">
                    </div>
                </div>

                <!-- 选择属性 -->
                <div class="region_list choose_sx" style="display:none;">
                    <h1 class="left">选择属性</h1>
                    <div class="right agent nature">
                        <label>
                            <input type="checkbox" name="st-con" checked="checked" id="st-one1">
                            <i class="radios"></i>
                            IP：Port
                        </label>

                        <label>
                            <input type="checkbox" name="st-con" id="st-one2">
                            <i class="radios"></i>
                            过期时间
                        </label>

                        <label>
                            <input type="checkbox" name="st-con" id="st-one3">
                            <i class="radios"></i>
                            城市
                        </label>

                        <label>
                            <input type="checkbox" name="st-con" id="st-one4">
                            <i class="radios"></i>
                            运营商
                        </label>
                    </div>
                </div>

                <div class="region_list no_long_pack" id="regin_check_div">
                    <h1 class="left">地区选择</h1>
                    <div class="right">
                        <!-- nature -->
                        <div class="appointe">
                            <label class="label1">
                                <input type="radio" name="st-con" checked="checked" id="region_appoint">
                                <i class="radios"></i>
                                指定城市
                            </label>
                            <label class="label2">
                                <input type="radio" name="st-con" id="region_all_radio">
                                <i class="radios"></i>
                                省份混拨
                                <span style="color:red">（注：未勾选默认全国混拨）</span>
                            </label>
                        </div>
                        <input type="hidden" value="1" name="region_type" id="region_type">

                        <div class="appointe-city" style="display:none" id="region_all_check">

                            <label>
                                <input type="checkbox" name="many_regions" value="110000" class="many_regions">
                                <i class="radios"></i>
                                北京市                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="130000" class="many_regions">
                                <i class="radios"></i>
                                河北省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="140000" class="many_regions">
                                <i class="radios"></i>
                                山西省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="150000" class="many_regions">
                                <i class="radios"></i>
                                内蒙古自治区                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="210000" class="many_regions">
                                <i class="radios"></i>
                                辽宁省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="230000" class="many_regions">
                                <i class="radios"></i>
                                黑龙江省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="310000" class="many_regions">
                                <i class="radios"></i>
                                上海市                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="320000" class="many_regions">
                                <i class="radios"></i>
                                江苏省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="330000" class="many_regions">
                                <i class="radios"></i>
                                浙江省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="340000" class="many_regions">
                                <i class="radios"></i>
                                安徽省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="350000" class="many_regions">
                                <i class="radios"></i>
                                福建省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="360000" class="many_regions">
                                <i class="radios"></i>
                                江西省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="370000" class="many_regions">
                                <i class="radios"></i>
                                山东省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="420000" class="many_regions">
                                <i class="radios"></i>
                                湖北省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="430000" class="many_regions">
                                <i class="radios"></i>
                                湖南省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="440000" class="many_regions">
                                <i class="radios"></i>
                                广东省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="500000" class="many_regions">
                                <i class="radios"></i>
                                重庆市                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="510000" class="many_regions">
                                <i class="radios"></i>
                                四川省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="530000" class="many_regions">
                                <i class="radios"></i>
                                云南省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="610000" class="many_regions">
                                <i class="radios"></i>
                                陕西省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="620000" class="many_regions">
                                <i class="radios"></i>
                                甘肃省                    </label>

                            <label>
                                <input type="checkbox" name="many_regions" value="640000" class="many_regions">
                                <i class="radios"></i>
                                宁夏回族自治区                    </label>


                        </div>
                        <div id="sjld">
                            <div class="m_zlxg" id="shenfen">
                                <i class="selects iconfont"></i>
                                <p title="">请选择</p>
                                <div class="m_zlxg2 mCustomScrollbar _mCS_1 mCS_no_scrollbar" style="display: none;"><div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: 0px;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                                            <ul><li>江苏省</li><li>江西省</li><li>云南省</li><li>安徽省</li><li>浙江省</li><li>福建省</li><li>广东省</li><li>辽宁省</li><li>山西省</li><li>山东省</li><li>四川省</li><li>内蒙古自治区</li><li>重庆市</li><li>甘肃省</li><li>湖北省</li><li>宁夏回族自治区</li><li>陕西省</li><li>北京市</li><li>湖南省</li><li>上海市</li><li>黑龙江省</li></ul>
                                        </div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
                            </div>
                            <div class="m_zlxg" id="chengshi">
                                <i class="selects iconfont"></i>
                                <p title="">请选择</p>
                                <div class="m_zlxg2 mCustomScrollbar _mCS_2 mCS_no_scrollbar" style="display: none;"><div id="mCSB_2" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0" style="max-height: 0px;"><div id="mCSB_2_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                                            <ul><li>请选择</li></ul>
                                        </div><div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
                            </div>

                            <input name="city_id" class="city_id" type="hidden" value="">
                            <input name="pro_id" class="pro_id" type="hidden" value="">

                        </div>
                        <!-- <div class="prov com" style="display:none">
                            <div id="divselect2" class="divselect">
                                <cite data-id=""><span>省份</span><i class="iconfont">&#xe61e;</i></cite>
                                <ul class="ul-select ul-select1">
                                    <li class="li-select"><a class="select-pro" href="javascript:;" selected="0" data-id="0">省份随意</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="110000" data-id="110000">北京市</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="130000" data-id="130000">河北省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="140000" data-id="140000">山西省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="150000" data-id="150000">内蒙古自治区</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="210000" data-id="210000">辽宁省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="230000" data-id="230000">黑龙江省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="310000" data-id="310000">上海市</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="320000" data-id="320000">江苏省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="330000" data-id="330000">浙江省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="340000" data-id="340000">安徽省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="350000" data-id="350000">福建省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="360000" data-id="360000">江西省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="370000" data-id="370000">山东省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="420000" data-id="420000">湖北省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="430000" data-id="430000">湖南省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="440000" data-id="440000">广东省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="500000" data-id="500000">重庆市</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="510000" data-id="510000">四川省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="530000" data-id="530000">云南省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="610000" data-id="610000">陕西省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="620000" data-id="620000">甘肃省</a></li>
                                                                <li class="li-select"><a class="select-pro savecookie" href="javascript:;" selected="640000" data-id="640000">宁夏回族自治区</a></li>
                                                            </ul>
                            </div>
                            <input name="pro_id" class ='pro_id'type="hidden" value="" id="inputselect2"/>
                        </div>
                        <div class="city  com" style="display:none">
                            <div id="divselect3" class="divselect" >
                                <cite class="be_select" data-id=""><span>城市</span><i class="iconfont">&#xe61e;</i></cite>
                                  <div class="city_ul_append">
                                    <ul id="city_ul" class="ul-select ul-select2">

                                    </ul>
                                  </div>
                            </div>
                            <input name="city_id" class='city_id'type="hidden" value="" id="inputselect3"/>
                        </div> -->
                    </div>
                </div>
                <div style="clear:both">

                </div>

                <div class="region_list no_long_pack">
                    <h1 class="left">
                        端口位数
                    </h1>
                    <div class="right agent">
                        <label>
                            <input type="radio" name="port_bit" value="4" checked="checked">
                            <i class="radios"></i>
                            4位端口
                        </label>
                        <label>
                            <input type="radio" name="port_bit" value="5">
                            <i class="radios"></i>
                            5位端口
                        </label>

                        <label>
                            <input type="radio" name="port_bit" value="45">
                            <i class="radios"></i>
                            端口位数随机
                        </label>
                    </div>
                </div>

                <div class="region_list no_long_pack" id="ip_uniq_div">
                    <h1 class="left">
                        IP去重
                    </h1>
                    <div class="right agent">
                        <label>
                            <input type="radio" name="m_repeat" value="1" checked="checked">
                            <i class="radios"></i>
                            360天去重（默认）
                        </label>
                        <label>
                            <input type="radio" name="m_repeat" value="2">
                            <i class="radios"></i>
                            当日去重
                        </label>
                        <label>
                            <input type="radio" name="m_repeat" value="3">
                            <i class="radios"></i>
                            不去重
                        </label>
                    </div>
                </div>

                <div class="region_list no_long_pack">
                    <h1 class="left">
                        运营商
                    </h1>
                    <div class="right agent">
                        <label>
                            <input type="radio" name="demo" value="0" checked="checked">
                            <i class="radios"></i>
                            不限
                        </label>
                        <label>
                            <input type="radio" name="demo" value="100026">
                            <i class="radios"></i>
                            联通
                        </label>
                        <label>
                            <input type="radio" name="demo" value="100017">
                            <i class="radios"></i>
                            电信
                        </label>
                    </div>
                </div>

                <!--长效IP需要的地区-->
                <div class="region_list long_city_div" style="display: none;">
                    <h1 class="left">
                        开通地区
                    </h1>
                    <div class="right agent nature" id="long_citys_div">
                        <label>
                            <input type="checkbox" name="long_city" value="beijing" class="many_regions">
                            <i class="radios"></i>北京
                        </label>
                        <label>
                            <input type="checkbox" name="long_city" value="shanghai" class="many_regions">
                            <i class="radios"></i>上海
                        </label>
                        <label>
                            <input type="checkbox" name="long_city" value="hangzhou" class="many_regions">
                            <i class="radios"></i>杭州
                        </label>
                        <label>
                            <input type="checkbox" name="long_city" value="shenzhen" class="many_regions">
                            <i class="radios"></i>深圳
                        </label>
                        <label>
                            <input type="checkbox" name="long_city" value="huhehaote" class="many_regions">
                            <i class="radios"></i>呼和浩特
                        </label>
                        <label>
                            <input type="checkbox" name="long_city" value="qingdao" class="many_regions">
                            <i class="radios"></i>青岛
                        </label>
                        <label>
                            <input type="checkbox" name="long_city" value="zhangjiakou" class="many_regions">
                            <i class="radios"></i>张家口
                        </label>
                    </div>
                </div>
            </div>
            <div class="pay">
                <span class="open savecookie">生成API链接</span>
            </div>

            <div class="link">

                <label style="font-size:20px">直连IP</label><span>（请复制下面的链接地址，在新的浏览器或标签页打开并查看)</span>
                <input id="api_link" class="api_link" placeholder="点击上方按钮，生成API链接：">
                <input type="button" class="copyUrl" readonly="readonly" id="copyUrl" value="复制链接">

                <a href="#" class="openUrl" target="_blank">打开链接</a>

                <label id="con" style="font-size:20px">隧道IP<i class="iconfont"></i>
                    <span class="hint">专线中转，不同的端口号分配不同的出口IP</span>
                </label><span>（请复制下面的链接地址，在新的浏览器或标签页打开并查看)</span>
                <input id="api_link2" class="api_link" placeholder="点击上方按钮，生成API链接：">
                <input type="button" class="copyUrl" readonly="readonly" id="copyUrl2" value="复制链接">
                <a href="#" class="openUrl2" target="_blank">打开链接</a>

                <!--         <label  style="font-size:20px" >芝麻独享IP<i class="iconfont" ></i>
                             <span class="hint">专线中转，不同的端口号分配不同的出口IP</span>
                         </label><span>（三千万纯净独享IP全新上线，可用率超99.99%)</span>
                         <input id="api_link3" class="api_link" placeholder="点击上方按钮，生成API链接：">
                         <input type="button" class="copyUrl" readonly='readonly' id="copyUrl3" value="复制链接" />
                         <a href="#" class="openUrl3" target="_blank">打开链接</a>-->


                <div class="annotate">
                    <h1>请求参数注释</h1>
                    <!--<ul>-->
                    <!--<li><a>num</a><span>获取数量</span></li>-->
                    <!--<li><a>pro</a><span>代表省份</span></li>-->
                    <!--<li><a>city</a><span>城市</span></li>-->
                    <!--<li><a>yys</a><span>运营商(0:不限 100026:联通 100017:电信)</span></li>-->
                    <!--<li><a>port</a><span>IP协议（1:HTTP 2:SOCK5 11:HTTPS ）</span></li>-->
                    <!--<li><a>time</a><span>稳定时长(1-5)</span></li>-->
                    <!--<li><a>type</a><span>数据格式（1TXT 2JSON 3html）</span></li>-->
                    <!--<li><a>pack</a><span>用户套餐ID</span></li>-->
                    <!--<li><a>ts</a><span>是否显示IP过期时间（1显示  2不显示）</span></li>-->
                    <!--<li><a>ys</a><span>是否显示IP运营商（1显示  0不显示）</span></li>-->
                    <!--<li><a>cs</a><span>是否显示位置信息（1显示  0不显示）</span></li>-->
                    <!--<li><a>lb</a><span>分隔符(1:\r\n  2:/br  3:\r 4:\n 5:\t 6 :自定义)</span></li>-->
                    <!--<li><a>sb</a><span>自定义分隔符</span></li>-->
                    <!--<li><a>mr</a><span>去重选择（1:360天去重 2:单日去重 3:不去重）</span></li>-->
                    <!--<li><a>pb</a><span>端口位数（4:4位端口  5:5位端口）</span></li>-->
                    <!--<li><a>regions</a><span>全国混拨地区</span></li>-->
                    <!--</ul>-->

                    <div class="table">
                        <div class="th">
                            <div class="td td-1">名称</div>
                            <div class="td td-1">类型</div>
                            <div class="td td-1">必选</div>
                            <div class="td td-2">说明</div>
                        </div>

                        <div class="tr">
                            <div class="td td-1">num</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">是</div>
                            <div class="td td-2">提取IP数量</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">pro</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">否</div>
                            <div class="td td-2">省份，默认全国</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">city</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">否</div>
                            <div class="td td-2">城市，默认全国</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">regions</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">否</div>
                            <div class="td td-2">全国混拨地区</div>
                        </div>

                        <div class="tr">
                            <div class="td td-1">yys</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">是</div>
                            <div class="td td-2">0:不限 100026:联通 100017:电信</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">port</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">是</div>
                            <div class="td td-2">IP协议 1:HTTP 2:SOCK5 11:HTTPS</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">time</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">按次提取必填</div>
                            <div class="td td-2">稳定时长</div>
                        </div>

                        <div class="tr">
                            <div class="td td-1">type</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">否</div>
                            <div class="td td-2">数据格式：1:TXT 2:JSON 3:html</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">pack</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">否</div>
                            <div class="td td-2">用户套餐ID</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">ts</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">否</div>
                            <div class="td td-2">是否显示IP过期时间: 1显示  2不显示</div>
                        </div>

                        <div class="tr">
                            <div class="td td-1">ys</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">否</div>
                            <div class="td td-2">是否显示IP运营商: 1显示</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">cs</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">否</div>
                            <div class="td td-2">否显示位置: 1显示</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">lb</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">否</div>
                            <div class="td td-2">分隔符(1:\r\n  2:/br  3:\r 4:\n 5:\t 6 :自定义)</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">sb</div>
                            <div class="td td-1">string</div>
                            <div class="td td-1">否</div>
                            <div class="td td-2">自定义分隔符</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">mr</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">否</div>
                            <div class="td td-2">去重选择（1:360天去重 2:单日去重 3:不去重）</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">pb</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1">否</div>
                            <div class="td td-2">端口位数（4:4位端口  5:5位端口）</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="result">
                <h1>返回结果示例</h1>
                <div class="box">
          <pre>
        {
          "code":0,
          "success":true,
          "msg":"0",
          "data":[
              {
                  "ip":"49.68.68.197",
                  "port":33220,
                  "expire_time":"2019-05-24 08:58:31",
                  "city":"徐州市",
                  "isp":"电信"
              },
              {
                  "ip":"58.218.201.108", //隧道ip （代理ip）
                  "port":2690,           // 代理端口
                  "expire_time":"2019-05-24 08:55:31",
                  "city":"苏州市",
                  "isp":"电信",
                  "outip":"219.136.47.161",  // 隧道ip的出口ip
              }
          ]
        }
         </pre>
                </div>
                <div class="annotate" style="background-position: -3px -447px;">
                    <h1>结果注释</h1>
                    <!--<ul>-->
                    <!--<li><a>code</a><span>0为成功，1为失败</span></li>-->
                    <!--<li><a>success</a><span>true为成功，false为失败</span></li>-->
                    <!--&lt;!&ndash;	 <li><a>msg</a><span>为返回信息，0为XX,1为XX，等等</span></li>&ndash;&gt;-->
                    <!--<li><a>mark</a><span>iP</span></li>-->
                    <!--<li><a>port</a><span>端口</span></li>-->
                    <!--<li><a>city</a><span>城市（地级市名称）</span></li>-->
                    <!--<li><a>isp</a><span>运营商（电信、联通）</span></li>-->
                    <!--<li><a>expire_time </a><span>过期时间</span></li>-->
                    <!--</ul>-->
                    <div class="table">
                        <div class="th">
                            <div class="td td-1">名称</div>
                            <div class="td td-1">类型</div>
                            <div class="td td-1 td-left">说明</div>
                        </div>

                        <div class="tr">
                            <div class="td td-1">code</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1 td-left">0为成功，1为失败</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">success</div>
                            <div class="td td-1">bool</div>
                            <div class="td td-1 td-left">true为成功，false为失败</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">ip</div>
                            <div class="td td-1">string</div>
                            <div class="td td-1 td-left">IP</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">port</div>
                            <div class="td td-1">int</div>
                            <div class="td td-1 td-left">端口号</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">expire_time</div>
                            <div class="td td-1">string</div>
                            <div class="td td-1 td-left">过期时间</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">city</div>
                            <div class="td td-1">string</div>
                            <div class="td td-1 td-left">城市</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">isp</div>
                            <div class="td td-1">string</div>
                            <div class="td td-1 td-left">运营商（电信、联通）</div>
                        </div>
                        <div class="tr">
                            <div class="td td-1">outip</div>
                            <div class="td td-1">string</div>
                            <div class="td td-1 td-left">隧道ip的出口ip</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ways">
                <h1>使用方法</h1>
                <p class="example">
                    <span>* 生成API链接，调用HTTP GET请求即可返回所需的IP结果</span>
                    <span>* 可以直接按照以下格式组装所需的API链接:<a class="link">https.com/getip/num/10/type/2/pro/0/city/0/port/1/time/1/yys/0</a></span>
                    <span>* 获取余额接口:</span>
                    <span class="balance_api">web.http.cnapi.cc/index/index/get_my_balance?neek=XX&amp;appkey=XX</span>
                    <span>* 添加白名单接口:</span>
                    <span class="white_api">web.http.cnapi.cc/index/index/save_white?neek=XX&amp;appkey=XX&amp;white=您的ip</span>
                    <span>* 删除白名单接口:</span>
                    <span class="white_del">web.http.cnapi.cc/index/index/del_white?neek=XX&amp;appkey=XX&amp;white=您的ip</span>
                </p>
            </div>

            <div class="demo-down">
                <h1>用户接入芝麻HTTP代码demo</h1>
                <div class="demo-box">
                    <div class="demo-list">
                        <span>C语言</span>
                        <p>用户接入芝麻HTTP代码demo</p>
                        <a href="http://com-download.getlema.com/public/C%E8%AF%AD%E8%A8%80%E4%BB%A3%E7%90%86%E7%94%A8%E6%B3%95.zip" target="_blank">点此下载</a>
                    </div>
                    <div class="demo-list">
                        <span>GO语言</span>
                        <p>用户接入芝麻HTTP代码demo</p>
                        <a href="http://com-download.getlema.com/public/GO%E8%AF%AD%E8%A8%80%E4%BB%A3%E7%90%86%E7%94%A8%E6%B3%95.zip" target="_blank">点此下载</a>
                    </div>
                    <div class="demo-list">
                        <span>Phantomjs语言</span>
                        <p>用户接入芝麻HTTP代码demo</p>
                        <a href="http://com-download.getlema.com/public/Phantomjs%E4%BB%A3%E7%90%86%E7%94%A8%E6%B3%95.txt" target="_blank">点此下载</a>
                    </div>
                    <div class="demo-list">
                        <span>Php语言</span>
                        <p>用户接入芝麻HTTP代码demo</p>
                        <a href="http://com-download.getlema.com/public/php%E4%BB%A3%E7%90%86%E7%94%A8%E6%B3%95.txt" target="_blank">点击下载</a>
                    </div>
                    <div class="demo-list">
                        <span>Java语言</span>
                        <p>用户接入芝麻HTTP代码demo</p>
                        <a href="http://com-download.getlema.com/public/proxy_sdk_java_v1.zip" target="_blank">点此下载</a>
                    </div>
                    <div class="demo-list">
                        <span>Python语言</span>
                        <p>用户接入芝麻HTTP代码demo</p>
                        <a href="http://com-download.getlema.com/public/python%E4%BB%A3%E7%90%86%E7%94%A8%E6%B3%95.txt" target="_blank">点此下载</a>
                    </div>
                    <div class="demo-list">
                        <span>Selenium语言</span>
                        <p>用户接入芝麻HTTP代码demo</p>
                        <a href="http://com-download.getlema.com/public/Selenium%E4%BB%A3%E7%90%86%E7%94%A8%E6%B3%95.txt" target="_blank">点此下载</a>
                    </div>
                    <div class="demo-list">
                        <span>易语言</span>
                        <p>用户接入芝麻HTTP代码demo</p>
                        <a href="http://com-download.getlema.com/public/%E6%98%93%E8%AF%AD%E8%A8%80.zip" target="_blank">点此下载</a>
                    </div>
                    <div class="demo-list">
                        <span>C#语言</span>
                        <p>用户接入芝麻HTTP代码demo</p>
                        <a href="http://com-download.getlema.com/public/ClientProxyDemo.zip" target="_blank">点此下载</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="detection-down fadeInRight ipchecktool" href="/agent" target="_blank">
            IP检测工具入口
        </a>
        <a href="http://h.zhimaruanjian.com/help/245.html" class="demo" target="_blank">代码接入DEMO</a>
        <div class="dial_right fadeInRight">
            <h1>平台保证</h1>
            <p><i class="iconfont"></i><span>永久去重，永远不会用到重复的IP</span> </p>
            <p><i class="iconfont"></i><span>单次提取数量400，请求时间&lt;1秒</span> </p>
            <p><i class="iconfont"></i><span>每日提取数量及使用数量不限制</span> </p>
            <p><i class="iconfont"></i><span>延迟≤10毫秒</span> </p>
            <p><i class="iconfont"></i><span>可用性≥99.99%</span> </p>
            <p><i class="iconfont"></i><span>每日30万稳定12小时-24小时IP</span> </p>
            <p><i class="iconfont"></i><span>全部IP皆机房资产，非扫描</span> </p>
            <p><i class="iconfont"></i><span>并发请求数量不限制</span> </p>
            <p><i class="iconfont"></i><span>单IP单白名单仅扣费一次</span> </p>
        </div>
        <div class="quick_entry fadeInRight">
            <!--<a class="go"></a>-->
            <h1><span>快速帮助入口</span></h1>
            <div class="list" id="help_quick_entrance">

                <a href="/help/88.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">能不能免费试用？可以的！</a>
                <a href="/help/93.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">IP稳定性如何？</a>
                <a href="/help/95.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">如何进行扣费？</a>
                <a href="/help/96.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">充值的芝麻币有过期时间吗？</a>
                <a href="/help/92.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">IP存在时长及对应价格</a>
                <a href="/help/91.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">生成API链接后怎么使用</a>
                <a href="/help/94.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">为什么通过API获取的IP不能用</a>
                <a href="/help/252.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">芝麻HTTP现在覆盖这些城市</a>
                <a href="/help/225.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">如何在搜狗浏览器内设置代理IP</a>
                <a href="/help/226.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">如何在QQ浏览器内设置代理IP</a>
                <a href="/help/227.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">如何在谷歌浏览器内设置代理IP</a>
                <a href="/help/228.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">如何在UC浏览器内设置代理IP</a>
                <a href="/help/229.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">如何在火狐浏览器内设置代理IP</a>
                <a href="/help/230.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">如何在猎豹浏览器内设置代理IP</a>
                <a href="/help/231.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">如何在IE浏览器内设置代理IP</a>
                <a href="/help/245.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">用户接入芝麻HTTP代码demo</a>
                <a href="/help/373.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">如何在360浏览器内设置代理IP</a>
                <a href="/help/376.html" style="overflow: hidden; text-overflow: ellipsis" target="_blank">如何检测代理IP的匿名度和连接速度?</a>

            </div>
        </div>

        <!--返回顶部-->
        <div class="return_top">
            <i class="iconfont"></i>
            <a>回到顶部</a>
        </div>
    </section>
@endsection