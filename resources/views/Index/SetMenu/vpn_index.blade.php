@extends('Index.app')
@section('title',$title)

@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.foot_index')
@extends('Index.Common.alert_index')
@section('main')

    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/setMenu.css" />
    <section class="section">
        <!--五月隐藏-->
        <div class="container" style="display: none">
            <div class="left">
                <h1>基础套餐</h1>
                <ul>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">支持Windows客户端</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">线路延迟：80~100ms</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/error.png" alt="">支持静态线路</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/error.png" alt="">支持浏览器插件</li>
                </ul>
                <ul>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">支持Android客户端</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">每日20万IP</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/error.png" alt="">支持极速线路</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/error.png" alt="">支持MAC客户端</li>
                </ul>
                <ul>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">支持iOS客户端</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">售后服务：普通客服</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/error.png" alt="">支持直连线路</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/error.png" alt="">长效动态</li>
                </ul>
            </div>
            <!--双十二活动隐藏-->
            <div class="right-img"></div>
        </div>
        <div class="container" style="display: block">
            <div class="left">
                <h1>高级套餐</h1>
                <ul>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">支持Windows客户端</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui2.png" alt="">线路延迟：60~80ms</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui2.png" alt="">支持静态线路</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui2.png" alt="">支持浏览器插件</li>
                </ul>
                <ul>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">支持Android客户端</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui2.png" alt="">每日40万IP</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui2.png" alt="">支持极速线路</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui2.png" alt="">支持MAC客户端</li>
                </ul>
                <ul>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui1.png" alt="">支持iOS客户端</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui2.png" alt="">售后服务：VIP专享1对1客服</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui2.png" alt="">支持直连线路</li>
                    <li><img src="http://zmdl-static.upupfile.com/static/ip_new/img/dui2.png" alt="">长效动态</li>
                </ul>
            </div>
            <div class="right-img"></div>
        </div>
        <div class="container" style="display: none">
            <div class="left">
                <h1>充值余额最高<span>赠送60%</span><br>使用余额开通会员服务，获得超高性价比</h1>
                <!--<a class="learn-more">了解更多</a>-->
            </div>
            <div class="right-img"></div>
        </div>
    </section>
    <form id="order_form" method="post" action="" target="_blank">
        <div class="content_inner fadeInUp">

            <div class="choise">
                <div class="item"><i class="iconfont"></i>基础套餐 <div class="hot"></div></div>
                <div class="item active"><img src="http://zmdl-static.upupfile.com/static/ip_new/img/vip.png" alt="" style="margin: -8px 5px 0 0;">高级套餐<div class="light"></div></div>
                <!--<div class="item"><i class="iconfont">&#xe66b;</i>余额充值</div>-->
            </div>



            <div class="pack-tips get-red-packet">
                <span></span>
                <h4>定制路线</h4><!--新春隐藏-->
                <div class="inner-text">
                    <p><i class="iconfont"></i>定制全国任意省会城市路线</p>
                    <p><i class="iconfont"></i>独享一手纯净IP</p>
                    <p><i class="iconfont"></i>高速上下行,不限速</p>
                    <p><i class="iconfont"></i>提供api或者客户端</p>
                    <p><i class="iconfont"></i>更多权利,等你咨询</p>
                    <a class="sur_link">立即联系客服</a>
                </div>
            </div>

            <div class="package_content package_content_open" data-type="add_time" data-coupon="on">
                <!--<span class="the_best"></span>-->
                <div data-id="42" class="package_list">
                    <!-- 做判断 -->
                    <!-- 做判断 -->
                    <i class=""></i>
                    <h1>
                        按月购买            </h1>

                    <h2>119                <!--                 <span>12月31日前,限时特惠!</span>
                 -->
                    </h2>



                    <!--活动前代码-->
                    <h3>原价：200元</h3>

                    <span class="feedback-red">¥
                                         119                    /<a>月</a></span>
                    <!-- 做判断 -->

                    <div class="choice">

                        <label for="" class="Bt_val">
                            <button type="button" name="button" class="reduce"><i class="iconfont"></i></button>
                        </label>
                        <label for="" class="lab_val">
                            <input type="text" value="1" class="price buy_num">
                            <span>个月</span>
                        </label>
                        <label for="" class="Bt_val">
                            <button type="button" name="button" class="add"><i class="iconfont"></i></button>
                        </label>
                    </div>
                    <!--<span class="feedback-tips">买2个月，到账3个月</span>-->
                </div>
                <div data-id="43" class="package_list">
                    <!-- 做判断 -->
                    <!-- 做判断 -->
                    <i class=""></i>
                    <h1>
                        双月购买            </h1>

                    <h2>177                <!--  -->
                    </h2>



                    <!--活动前代码-->
                    <h3>原价：400元</h3>

                    <span class="feedback-red">¥
                                         88                    /<a>月</a></span>
                    <!-- 做判断 -->

                    <div class="choice">

                        <label for="" class="lab_val lable_only">
                            2个月
                        </label>
                        <input type="hidden" class="buy_num" value="1">
                    </div>
                    <!--<span class="feedback-tips">买2个月，到账3个月</span>-->
                </div>
                <div data-id="44" class="package_list   active">
                    <!-- 做判断 -->
                    <!-- 做判断 -->
                    <span class="old_user">最受欢迎套餐！</span>
                    <i class="active"></i>
                    <h1>
                        半年购买            </h1>

                    <h2>499                <!--  -->
                    </h2>



                    <!--活动前代码-->
                    <h3>原价：1200元</h3>

                    <span class="feedback-red">¥
                                         83                    /<a>月</a></span>
                    <!-- 做判断 -->

                    <div class="choice">

                        <label for="" class="lab_val lable_only">
                            6个月
                        </label>

                        <input type="hidden" class="buy_num" value="1">
                    </div>
                    <!--<span class="feedback-tips">买2个月，到账3个月</span>-->
                </div>
                <div data-id="45" class="package_list">
                    <!-- 做判断 -->
                    <!-- 做判断 -->
                    <span class="old_user">限时秒杀500份！</span>
                    <i class=""></i>
                    <h1>
                        全年购买            </h1>

                    <h2>777                <!--  -->
                    </h2>



                    <!--活动前代码-->
                    <h3>原价：2100元</h3>

                    <span class="feedback-red">¥
                                         64                    /<a>月</a></span>
                    <!-- 做判断 -->
                    <!-- <a href="/pay/year.html" class="buyPopping">立即抢购</a> -->

                    <div class="choice">

                        <label for="" class="lab_val lable_only">
                            12个月
                        </label>
                        <input type="hidden" class="buy_num" value="1">
                    </div>
                    <!--<span class="feedback-tips">买2个月，到账3个月</span>-->
                </div>
            </div>

            <div class="package_content package_content_open active" data-type="add_time" data-coupon="off">
                <!--<span class="the_best"></span>-->
                <div data-id="6" class="package_list  active">
                    <!-- 做判断 -->
                    <!-- 做判断 -->
                    <i class="active"></i>
                    <h1>
                        按月购买        </h1>
                    <!--双旦添加-->
                    <!--    <div class="add_active">
                            &lt;!&ndash;<span>立省177元</span>&ndash;&gt;
                        </div>-->
                    <!--end-->
                    <h2>177            <!--             <span>12月31日前,限时特惠!</span>
             -->
                    </h2>

                    <!--双旦活动-->
                    <!--  <h5 class="active-word">
                          &lt;!&ndash;赠送1个月，&ndash;&gt;
                          每月仅需
                          <span>
                           ¥ 88.5               </span></h5>-->

                    <!--活动前代码-->
                    <h3>原价：280元</h3>

                    <span class="feedback-red">¥
                                                 177                        /<a>月</a></span>
                    <!-- 做判断 -->

                    <div class="choice">

                        <label for="" class="Bt_val">
                            <button type="button" name="button" class="reduce"><i class="iconfont"></i></button>
                        </label>
                        <label for="" class="lab_val">
                            <input type="text" value="1" class="price buy_num">
                            <span>个月</span>
                        </label>
                        <label for="" class="Bt_val">
                            <button type="button" name="button" class="add"><i class="iconfont"></i></button>
                        </label>
                    </div>

                    <!--<span class="feedback-tips">买2个月，到账3个月</span>-->
                </div>
                <div data-id="7" class="package_list  ">
                    <!-- 做判断 -->
                    <!-- 做判断 -->
                    <i class=""></i>
                    <h1>
                        双月购买        </h1>
                    <!--双旦添加-->
                    <!--    <div class="add_active">
                            &lt;!&ndash;<span>立省277元</span>&ndash;&gt;
                        </div>-->
                    <!--end-->
                    <h2>277            <!--  -->
                    </h2>

                    <!--双旦活动-->
                    <!--  <h5 class="active-word">
                          &lt;!&ndash;赠送2个月，&ndash;&gt;
                          每月仅需
                          <span>
                           ¥ 69.2               </span></h5>-->

                    <!--活动前代码-->
                    <h3>原价：560元</h3>

                    <span class="feedback-red">¥
                                                 138                        /<a>月</a></span>
                    <!-- 做判断 -->

                    <div class="choice">

                        <label for="" class="lab_val lable_only">
                            2个月
                        </label>
                        <input type="hidden" class="buy_num" value="1">
                    </div>

                    <!--<span class="feedback-tips">买2个月，到账3个月</span>-->
                </div>
                <div data-id="8" class="package_list  ">
                    <!-- 做判断 -->
                    <!-- 做判断 -->
                    <!--<span class="old_user">最受欢迎套餐！</span>&lt;!&ndash;双旦隐藏&ndash;&gt;-->
                    <i class=""></i>
                    <h1>
                        半年购买        </h1>
                    <!--双旦添加-->
                    <!--    <div class="add_active">
                            &lt;!&ndash;<span>立省777元</span>&ndash;&gt;
                        </div>-->
                    <!--end-->
                    <h2>777            <!--  -->
                    </h2>

                    <!--双旦活动-->
                    <!--  <h5 class="active-word">
                          &lt;!&ndash;赠送6个月，&ndash;&gt;
                          每月仅需
                          <span>
                           ¥ 64.7               </span></h5>-->

                    <!--活动前代码-->
                    <h3>原价：1680元</h3>

                    <span class="feedback-red">¥
                                                 129                        /<a>月</a></span>
                    <!-- 做判断 -->

                    <div class="choice">

                        <label for="" class="lab_val lable_only">
                            6个月
                        </label>

                        <input type="hidden" class="buy_num" value="1">
                    </div>

                    <!--<span class="feedback-tips">买2个月，到账3个月</span>-->
                </div>
                <div data-id="25" class="package_list  ">
                    <!-- 做判断 -->
                    <!-- 做判断 -->
                    <!--<span class="old_user">限时秒杀500份！</span>&lt;!&ndash;双旦隐藏&ndash;&gt;-->
                    <i class=""></i>
                    <h1>
                        全年购买        </h1>
                    <!--双旦添加-->
                    <!--    <div class="add_active">
                            &lt;!&ndash;<span>立省888元</span>&ndash;&gt;
                        </div>-->
                    <!--end-->
                    <h2>888            <!--  -->
                    </h2>

                    <!--双旦活动-->
                    <!--  <h5 class="active-word">
                          &lt;!&ndash;赠送12个月，&ndash;&gt;
                          每月仅需
                          <span>
                           ¥ 37               </span></h5>-->

                    <!--活动前代码-->
                    <h3>原价：2920元</h3>

                    <span class="feedback-red">¥
                                                 74                        /<a>月</a></span>
                    <!-- 做判断 -->
                    <!-- <a href="/pay/year.html" class="buyPopping">立即抢购</a> -->

                    <div class="choice">

                        <label for="" class="lab_val lable_only">
                            12个月
                        </label>
                        <input type="hidden" class="buy_num" value="1">
                    </div>

                    <!--<span class="feedback-tips">买2个月，到账3个月</span>-->
                </div>
                <input type="hidden" class="add_terminal" value="0">
            </div>

            <div class="package_content package_content_charge" id="money_btn" data-type="charge">
                <div class="package_list active" data-id="23">
                    <i class="active"></i>
                    <h4>1000送200<span>赠送<a>20</a>%</span></h4>
                    <span class="recharge">充值<a>1000</a>元</span>
                    <span class="recharge actual">到账<a>1200</a>元</span>
                </div>
                <div class="package_list " data-id="24">
                    <i class=""></i>
                    <h4>3000送800<span>赠送<a>26.6</a>%</span></h4>
                    <span class="recharge">充值<a>3000</a>元</span>
                    <span class="recharge actual">到账<a>3800</a>元</span>
                </div>
                <div class="package_list " data-id="25">
                    <i class=""></i>
                    <h4>5000送1800<span>赠送<a>36</a>%</span></h4>
                    <span class="recharge">充值<a>5000</a>元</span>
                    <span class="recharge actual">到账<a>6800</a>元</span>
                </div>
                <div class="package_list " data-id="26">
                    <i class=""></i>
                    <h4>10000送6000<span>赠送<a>60</a>%</span></h4>
                    <span class="recharge">充值<a>10000</a>元</span>
                    <span class="recharge actual">到账<a>16000</a>元</span>
                </div>


                <!--<div class="package_list just-show">-->
                <!--<p class="title">大客户定制</p>-->
                <!--<img src="http://zmdl-static.upupfile.com/static/ip_new/img/buy/wx-code.png" alt="微信二维码">-->
                <!--<p class="tips">扫一扫，联系平台客户经理</p>-->
                <!--</div>-->
            </div>

            <div class="layer_content">
                <div class="layer_list ">
                    <div class="introduce">
                        <i class="triangle_up"></i>
                        <h1>月度会员<br>尊享套餐</h1>
                    </div>
                    <ul>
                        <li>
                    <span>
                      <span>海量资源</span>
                      <span>全国地市网络资源</span>
                    </span>
                            <span class="jisu">
                      <span>极速切换</span>
                      <span>快速切换，更换速度≤100ms</span>
                    </span>
                            <span class="wangsu">
                      <span>网速保证</span>
                      <span>各节点百兆带宽独享</span>
                    </span>
                            <span class="niming">
                      <span>匿名防查</span>
                      <span>高匿名IP，保护隐私，防追踪</span>
                    </span>
                        </li>
                        <li>
                    <span class="pingtai">
                      <span>多平台使用</span>
                      <span>支持Windows、iOS、Android</span>
                    </span>
                            <span class="xianlu">
                      <span>全国线路</span>
                      <span>全国铺设近百个城市线路</span>
                    </span>
                            <span class="jingtai">
                        <span>静态支持</span>
                        <span>支持静态IP，独占一个IP </span>
                    </span>
                            <span class="xieyi">
                      <span>多协议连接</span>
                      <span>支持PPTP/L2TP/IKev2/open协议</span>
                    </span>
                        </li>
                        <li>
                    <span class="dingshi">
                      <span>定时切换</span>
                      <span>支持任意时长定时切换</span>
                    </span>
                            <span class="kuaijie">
                      <span>快捷键切换</span>
                      <span>Ctrl+Q一键切换，更加便捷</span>
                    </span>
                            <span class="qingli">
                      <span>自动清理</span>
                      <span>定时清理缓存cookie，提升运行速度！</span>
                    </span>
                            <span class="guolv">
                      <span>自动过滤</span>
                      <span>系统自动过滤已使用IP</span>
                    </span>
                        </li>
                    </ul>
                </div>
                <div class="layer_list ">
                    <div class="introduce">
                        <i class="triangle_up"></i>
                        <h1>双月会员<br>尊享套餐</h1>
                    </div>
                    <ul>
                        <li>
                  <span>
                    <span>海量资源</span>
                    <span>全国地市网络资源</span>
                  </span>
                            <span class="jisu">
                    <span>极速切换</span>
                    <span>快速切换，更换速度≤100ms</span>
                  </span>
                            <span class="wangsu">
                    <span>网速保证</span>
                    <span>各节点百兆带宽独享</span>
                  </span>
                            <span class="niming">
                    <span>匿名防查</span>
                    <span>高匿名IP，保护隐私，防追踪</span>
                  </span>
                        </li>
                        <li>
                  <span class="pingtai">
                    <span>多平台使用</span>
                    <span>支持Windows、iOS、Android</span>
                  </span>
                            <span class="xianlu">
                    <span>全国线路</span>
                    <span>全国铺设近百个城市线路</span>
                  </span>
                            <span class="jingtai">
                        <span>静态支持</span>
                        <span>支持静态IP，独占一个IP </span>
                  </span>
                            <span class="xieyi">
                    <span>多协议连接</span>
                    <span>支持PPTP/L2TP/IKev2/open协议</span>
                  </span>
                        </li>
                        <li>
                  <span class="dingshi">
                    <span>定时切换</span>
                    <span>支持任意时长定时切换</span>
                  </span>
                            <span class="kuaijie">
                    <span>快捷键切换</span>
                    <span>Ctrl+Q一键切换，更加便捷</span>
                  </span>
                            <span class="qingli">
                    <span>自动清理</span>
                    <span>定时清理缓存cookie，提升运行速度！</span>
                  </span>
                            <span class="guolv">
                    <span>自动过滤</span>
                    <span>系统自动过滤已使用IP</span>
                  </span>
                        </li>
                    </ul>
                </div>
                <div class="layer_list">
                    <div class="introduce">
                        <i class="triangle_up"></i>
                        <h1>半年会员<br>尊享套餐</h1>
                    </div>
                    <ul>
                        <li>
                  <span>
                    <span>海量资源</span>
                    <span>全国地市网络资源</span>
                  </span>
                            <span class="jisu">
                    <span>极速切换</span>
                    <span>快速切换，更换速度≤100ms</span>
                  </span>
                            <span class="wangsu">
                    <span>网速保证</span>
                    <span>各节点百兆带宽独享</span>
                  </span>
                            <span class="niming">
                    <span>匿名防查</span>
                    <span>高匿名IP，保护隐私，防追踪</span>
                  </span>
                        </li>
                        <li>
                  <span class="pingtai">
                    <span>多平台使用</span>
                    <span>支持Windows、iOS、Android</span>
                  </span>
                            <span class="xianlu">
                    <span>全国线路</span>
                    <span>全国铺设近百个城市线路</span>
                  </span>
                            <span class="jingtai">
                    <span>静态支持</span>
                    <span>支持静态IP，独占一个IP </span>
                  </span>
                            <span class="xieyi">
                    <span>多协议连接</span>
                    <span>支持PPTP/L2TP/IKev2/open协议</span>
                  </span>
                        </li>
                        <li>
                  <span class="dingshi">
                    <span>定时切换</span>
                    <span>支持任意时长定时切换</span>
                  </span>
                            <span class="kuaijie">
                    <span>快捷键切换</span>
                    <span>Ctrl+Q一键切换，更加便捷</span>
                  </span>
                            <span class="qingli">
                    <span>自动清理</span>
                    <span>定时清理缓存cookie，提升运行速度！</span>
                  </span>
                            <span class="guolv">
                    <span>自动过滤</span>
                    <span>系统自动过滤已使用IP</span>
                  </span>
                        </li>
                    </ul>
                </div>
                <div class="layer_list">
                    <div class="introduce">
                        <i class="triangle_up"></i>
                        <h1>全年会员<br>尊享套餐</h1>
                    </div>
                    <ul>
                        <li>
                  <span>
                    <span>海量资源</span>
                    <span>全国地市网络资源</span>
                  </span>
                            <span class="jisu">
                    <span>极速切换</span>
                    <span>快速切换，更换速度≤100ms</span>
                  </span>
                            <span class="wangsu">
                    <span>网速保证</span>
                    <span>各节点百兆带宽独享</span>
                  </span>
                            <span class="niming">
                    <span>匿名防查</span>
                    <span>高匿名IP，保护隐私，防追踪</span>
                  </span>
                        </li>
                        <li>
                  <span class="pingtai">
                    <span>多平台使用</span>
                    <span>支持Windows、iOS、Android</span>
                  </span>
                            <span class="xianlu">
                    <span>全国线路</span>
                    <span>全国铺设近百个城市线路</span>
                  </span>
                            <span class="jingtai">
                    <span>静态支持</span>
                    <span>支持静态IP，独占一个IP </span>
                  </span>
                            <span class="xieyi">
                    <span>多协议连接</span>
                    <span>支持PPTP/L2TP/IKev2/open协议</span>
                  </span>
                        </li>
                        <li>
                  <span class="dingshi">
                    <span>定时切换</span>
                    <span>支持任意时长定时切换</span>
                  </span>
                            <span class="kuaijie">
                    <span>快捷键切换</span>
                    <span>Ctrl+Q一键切换，更加便捷</span>
                  </span>
                            <span class="qingli">
                    <span>自动清理</span>
                    <span>定时清理缓存cookie，提升运行速度！</span>
                  </span>
                            <span class="guolv">
                    <span>自动过滤</span>
                    <span>系统自动过滤已使用IP</span>
                  </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="entry">
                <div for="" class="entry_list">
                    <span class="h1_span">账户名称</span>
                    <p class="line-tip package_account_reg">没有账号?<a class="reg_modal">立即注册</a></p>
                    <input type="text" name="username" value="" placeholder="请输入账户名称" class="entry_input pay_p login-username">
                    <span class="close"></span>
                </div>
                <div for="" class="entry_list coupon_div_activity" style="display: none">
                    <span class="h1_span">优惠券</span>
                    <label for="" class="" style="display:none">
                        <input type="text" value="" placeholder="请输入优惠券卡号" class="entry_input entry_input1 coupon_text">
                        <span class="close close1"></span>
                        <span class="confirms confirms1 coupons_ok">确认使用</span>
                        <span class="confirms pay_cancel">取消使用</span>
                    </label>
                    <div class="coupon">
                        <a class="coupon_inner"></a>
                        <span>优惠券仅在活动期间发放，活动时间请关注微信公众号“zhimadaili”</span>
                    </div>
                </div>
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
                    <!-- <a class="choice_a" href="/pay/">
                    </a> -->
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
    <script>
    //banner导航切换

    $(document).on("click",".choise .item",function () {
        $(".container").hide()
        var index=$(".choise .item").index(this);
        $(".container").hide().eq(index).show();
    });

    $(function () {
        var a=2;
//       if(window.location.search.indexOf('type=activity') !== -1){
//           a = 2;
//       }
        $(".layer_list").eq(a).removeClass("active");
        $(".package_content>.package_list").eq(a).addClass("active").siblings(".package_content>.package_list").removeClass("active");
        $(".package_content>.package_list").eq(a).find("i").addClass("active").parents(".package_content>.package_list").siblings(".package_content>.package_list").find("i").removeClass("active");
        // $('.package_list').eq(1).addClass('bimonthly')

        var ac=GetQueryString('action');
        if(ac=='money'){
            $('.choise .item:eq(1)').trigger('click')
        }
        function GetQueryString(name)
        {
            var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if(r!=null)return  decodeURI(r[2]); return null;
        }


    })

    $(document).on("click",".shut_close",function () {
        $('.m-gold').fadeOut();
    });
    $(document).on("click",".re_close",function () {
        $('.m-result').fadeOut();
        $('.m-gold').show();
    });
</script>

@endsection