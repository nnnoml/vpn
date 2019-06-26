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
        <!-- 三列 ul + class => "list3" -->
        <ul class="ul-1 list3">

            <li id="recharge" class="active">
                按次购买
                <i class="iconfont"></i>
                <span class="pro">
        包月/按次质量都是独享优质IP，质量上没有区别。<br>按次：使用起来更加灵活，余额没有到期时间，不受时间限制。
      </span>
            </li>

            <li id="buy_week">
                包周套餐
                <i class="iconfont"></i>
                <span class="pro">
        按次/包周/包月/质量都是独享优质IP，质量上没有区别。<br>包周：使用起来更加优惠，包周套餐相当于按次购买的<a class="red">7</a>折。
      </span>
            </li>
            <li>
                包月套餐
                <i class="iconfont"></i>
                <span class="pro">
        按次/包周/包月/质量都是独享优质IP，质量上没有区别。<br>包月：使用起来更加优惠，包月套餐相当于按次购买的<a class="red">6</a>折。
      </span>
            </li>
            <li>
                长效IP
                <i class="iconfont"></i>
                <span class="pro">
        高质量长效IP，存活时间超过24小时，有效期内不限使用次数，可灵活续费使用。
                    <!-- 按次/包周/包月/质量都是独享优质IP，质量上没有区别。<br>包月：使用起来更加优惠，包月套餐相当于按次购买的<a class="red">6</a>折。 -->
      </span>
            </li>

            <li class="move"></li>
        </ul>
        <div class="pay_list">
            <ul style="display:block">
                <li style="display:block">
                      <span class="line">
                        <i></i>
                        预充值金额
                      </span>
                    <span class="line2">
                          <a class="price">50</a>
                        <!--<a class="sd">实到<i>50</i>元</a>-->
                        <!--        <a class="sends">
         <i>限时赠送<br>5元</i>
       </a>-->
                        <!--<a class="no-use">实到：50元</a>-->
      				    <a class="prime_cost">实到：<i>50</i>元</a>
                      </span>
                    <span class="line3">
                          价目表
                      </span>

                    <span class="line4">
                                                    <i>5 - 25</i>分钟：<i>0.04</i>元/IP
                                                </span>
                    <span class="line4">
                                                    <i>25分钟 - 3</i>小时：<i>0.10</i>元/IP
                                                </span>
                    <span class="line4">
                                                      <i>3 - 6</i>小时：<i>0.20</i>元/IP
                                                </span>
                    <span class="line4">
                                                      <i>6 - 12</i>小时：<i>0.50</i>元/IP
                                                </span>
                    <span class="line4">
                                                      <i>48 - 72</i>小时：<i>5.00</i>元/IP
                                                </span>
                    <!-- <p class="two-active"><span class="give">赠送</span><span class="percent">0%</span></p>--><!--双旦代码-->
                    <a data-id="1" data-money="50" data-buytype="recharge" class="act_pay pay">立即充值</a>
                </li>
                <li style="display:block">
                      <span class="line">
                        <i></i>
                        预充值金额
                      </span>
                    <span class="line2">
                          <a class="price">200</a>
                        <!--<a class="sd">实到<i>200</i>元</a>-->
                        <!--        <a class="sends">
         <i>限时赠送<br>5元</i>
       </a>-->
                        <!--<a class="no-use">实到：200元</a>-->
      				    <a class="prime_cost">实到：<i>200</i>元</a>
                      </span>
                    <span class="line3">
                          价目表
                      </span>

                    <span class="line4">
                                                    <i>5 - 25</i>分钟：<i>0.04</i>元/IP
                                                </span>
                    <span class="line4">
                                                    <i>25分钟 - 3</i>小时：<i>0.10</i>元/IP
                                                </span>
                    <span class="line4">
                                                      <i>3 - 6</i>小时：<i>0.20</i>元/IP
                                                </span>
                    <span class="line4">
                                                      <i>6 - 12</i>小时：<i>0.50</i>元/IP
                                                </span>
                    <span class="line4">
                                                      <i>48 - 72</i>小时：<i>5.00</i>元/IP
                                                </span>
                    <!-- <p class="two-active"><span class="give">赠送</span><span class="percent">0%</span></p>--><!--双旦代码-->
                    <a data-id="2" data-money="200" data-buytype="recharge" class="act_pay pay">立即充值</a>
                </li>
                <li style="display:block">
                      <span class="line">
                        <i></i>
                        预充值金额
                      </span>
                    <span class="line2">
                          <a class="price">500</a>
                        <!--<a class="sd">实到<i>550</i>元</a>-->
                        <!--五月活动之前代码-->
                          <a class="send">
                            <i>赠送<br>10%</i>
                              <!--<i>限时赠送<br>￥50</i>-->
                          </a>
                        <!--        <a class="sends">
         <i>限时赠送<br>5元</i>
       </a>-->
                        <!--<a class="no-use">实到：550元</a>-->
      				    <a class="prime_cost">实到：<i>550</i>元</a>
                      </span>
                    <span class="line3">
                          价目表
                      </span>

                    <span class="line4">
                                                    <i>5 - 25</i>分钟：<i>0.04</i>元/IP
                                                </span>
                    <span class="line4">
                                                    <i>25分钟 - 3</i>小时：<i>0.10</i>元/IP
                                                </span>
                    <span class="line4">
                                                      <i>3 - 6</i>小时：<i>0.20</i>元/IP
                                                </span>
                    <span class="line4">
                                                      <i>6 - 12</i>小时：<i>0.50</i>元/IP
                                                </span>
                    <span class="line4">
                                                      <i>48 - 72</i>小时：<i>5.00</i>元/IP
                                                </span>
                    <!-- <p class="two-active"><span class="give">赠送</span><span class="percent">10%</span></p>--><!--双旦代码-->
                    <a data-id="3" data-money="500" data-buytype="recharge" class="act_pay pay">立即充值</a>
                </li>
                <li style="display:block">
                      <span class="line">
                        <i></i>
                        预充值金额
                      </span>
                    <span class="line2">
                          <a class="price">1000</a>
                        <!--<a class="sd">实到<i>1200</i>元</a>-->
                        <!--五月活动之前代码-->
                          <a class="send">
                            <i>赠送<br>20%</i>
                              <!--<i>限时赠送<br>￥200</i>-->
                          </a>
                        <!--        <a class="sends">
         <i>限时赠送<br>5元</i>
       </a>-->
                        <!--<a class="no-use">实到：1200元</a>-->
      				    <a class="prime_cost">实到：<i>1200</i>元</a>
                      </span>
                    <span class="line3">
                          价目表
                      </span>

                    <span class="line4">
                                                    <i>5 - 25</i>分钟：<i>0.04</i>元/IP
                                                </span>
                    <span class="line4">
                                                    <i>25分钟 - 3</i>小时：<i>0.10</i>元/IP
                                                </span>
                    <span class="line4">
                                                      <i>3 - 6</i>小时：<i>0.20</i>元/IP
                                                </span>
                    <span class="line4">
                                                      <i>6 - 12</i>小时：<i>0.50</i>元/IP
                                                </span>
                    <span class="line4">
                                                      <i>48 - 72</i>小时：<i>5.00</i>元/IP
                                                </span>
                    <!-- <p class="two-active"><span class="give">赠送</span><span class="percent">20%</span></p>--><!--双旦代码-->
                    <a data-id="4" data-money="1000" data-buytype="recharge" class="act_pay pay">立即充值</a>
                </li>

            </ul>

            <ul class="package">


                <li>

                    <!-- <div class="act-11-flag qq_link">
                        <h6>联系客服</h6>
                        <h4>买二<br/>送一</h4>
                      </div> -->
                    <!--<div class="discount">-->
                    <!--<p>原价:98元</p>-->
                    <!--<span>立省</span>-->
                    <!--<a>18元</a>-->
                    <!--</div>-->
                    <span class="line">
        	<i></i>
                    按周购买-5分钟版        	</span>
                    <span class="line2">
        	<a class="price" data-price="98">98</a>

        	</span>
                    <span class="line3">
                    价目表
        	</span>
                    <span class="line4">
            每天使用上限：
                        <!--<i class="red">700</i>-->
                 <div class="order">
                      <a class="reduce s-reduce act" data-num="700">-</a>
                       <input type="text" class="nums s-nums" value="700" readonly="">
                      <a class="add s-add" data-num="700">+</a>
                 </div>
          	</span>
                    <span class="line4">
           套餐包周数量：
                        <!--<i class="red">700</i>-->
                 <div class="order">
                      <a class="reduce time-reduce act" data-num="1">-</a>
                       <input type="text" class="nums time-nums" value="1" readonly="">
                      <a class="add time-add" data-num="1">+</a>
                    </div>
          	</span>
                    <span class="line4">
                  稳定时长：1~5分钟        	</span>
                    <span class="line4">
                  一次最多提取数量：
                                            400
                    个
        	</span>
                    <span class="line4">
                    重复度：360天去重
        	</span>
                    <span class="line4">
                    匿名度：高匿
        	</span>
                    <span class="line4">
                    API最快调用频率：1秒一次
        	</span>
                    <span class="line4">
                    并发请求数量：不限制
        	</span>
                    <span class="line4">
                    HTTP,HTTPS,SOCK5支持
        	</span>
                    <a data-id="28" data-money="98.00" data-buytype="cus_buy" class="act_pay pay">立即购买</a>
                </li>

                <li>

                    <!-- <div class="act-11-flag qq_link">
                        <h6>联系客服</h6>
                        <h4>买二<br/>送一</h4>
                      </div> -->
                    <!--<div class="discount">-->
                    <!--<p>原价:98元</p>-->
                    <!--<span>立省</span>-->
                    <!--<a>18元</a>-->
                    <!--</div>-->
                    <span class="line">
        	<i></i>
                    按周购买-25分钟版        	</span>
                    <span class="line2">
        	<a class="price" data-price="98">98</a>

        	</span>
                    <span class="line3">
                    价目表
        	</span>
                    <span class="line4">
            每天使用上限：
                        <!--<i class="red">500</i>-->
                 <div class="order">
                      <a class="reduce s-reduce act" data-num="500">-</a>
                       <input type="text" class="nums s-nums" value="500" readonly="">
                      <a class="add s-add" data-num="500">+</a>
                 </div>
          	</span>
                    <span class="line4">
           套餐包周数量：
                        <!--<i class="red">500</i>-->
                 <div class="order">
                      <a class="reduce time-reduce act" data-num="1">-</a>
                       <input type="text" class="nums time-nums" value="1" readonly="">
                      <a class="add time-add" data-num="1">+</a>
                    </div>
          	</span>
                    <span class="line4">
                  稳定时长：5~25分钟        	</span>
                    <span class="line4">
                  一次最多提取数量：
                                            400
                    个
        	</span>
                    <span class="line4">
                    重复度：360天去重
        	</span>
                    <span class="line4">
                    匿名度：高匿
        	</span>
                    <span class="line4">
                    API最快调用频率：1秒一次
        	</span>
                    <span class="line4">
                    并发请求数量：不限制
        	</span>
                    <span class="line4">
                    HTTP,HTTPS,SOCK5支持
        	</span>
                    <a data-id="19" data-money="98.00" data-buytype="cus_buy" class="act_pay pay">立即购买</a>
                </li>

                <li>

                    <!-- <div class="act-11-flag qq_link">
                        <h6>联系客服</h6>
                        <h4>买二<br/>送一</h4>
                      </div> -->
                    <!--<div class="discount">-->
                    <!--<p>原价:98元</p>-->
                    <!--<span>立省</span>-->
                    <!--<a>18元</a>-->
                    <!--</div>-->
                    <span class="line">
        	<i></i>
                    按周购买-3小时版        	</span>
                    <span class="line2">
        	<a class="price" data-price="98">98</a>

        	</span>
                    <span class="line3">
                    价目表
        	</span>
                    <span class="line4">
            每天使用上限：
                        <!--<i class="red">200</i>-->
                 <div class="order">
                      <a class="reduce s-reduce act" data-num="200">-</a>
                       <input type="text" class="nums s-nums" value="200" readonly="">
                      <a class="add s-add" data-num="200">+</a>
                 </div>
          	</span>
                    <span class="line4">
           套餐包周数量：
                        <!--<i class="red">200</i>-->
                 <div class="order">
                      <a class="reduce time-reduce act" data-num="1">-</a>
                       <input type="text" class="nums time-nums" value="1" readonly="">
                      <a class="add time-add" data-num="1">+</a>
                    </div>
          	</span>
                    <span class="line4">
                  稳定时长：25分钟~3小时        	</span>
                    <span class="line4">
                  一次最多提取数量：
                                            200个
        	</span>
                    <span class="line4">
                    重复度：360天去重
        	</span>
                    <span class="line4">
                    匿名度：高匿
        	</span>
                    <span class="line4">
                    API最快调用频率：1秒一次
        	</span>
                    <span class="line4">
                    并发请求数量：不限制
        	</span>
                    <span class="line4">
                    HTTP,HTTPS,SOCK5支持
        	</span>
                    <a data-id="20" data-money="98.00" data-buytype="cus_buy" class="act_pay pay">立即购买</a>
                </li>

                <li>

                    <!-- <div class="act-11-flag qq_link">
                        <h6>联系客服</h6>
                        <h4>买二<br/>送一</h4>
                      </div> -->
                    <!--<div class="discount">-->
                    <!--<p>原价:98元</p>-->
                    <!--<span>立省</span>-->
                    <!--<a>18元</a>-->
                    <!--</div>-->
                    <span class="line">
        	<i></i>
                    按周购买-6小时版        	</span>
                    <span class="line2">
        	<a class="price" data-price="98">98</a>

        	</span>
                    <span class="line3">
                    价目表
        	</span>
                    <span class="line4">
            每天使用上限：
                        <!--<i class="red">100</i>-->
                 <div class="order">
                      <a class="reduce s-reduce act" data-num="100">-</a>
                       <input type="text" class="nums s-nums" value="100" readonly="">
                      <a class="add s-add" data-num="100">+</a>
                 </div>
          	</span>
                    <span class="line4">
           套餐包周数量：
                        <!--<i class="red">100</i>-->
                 <div class="order">
                      <a class="reduce time-reduce act" data-num="1">-</a>
                       <input type="text" class="nums time-nums" value="1" readonly="">
                      <a class="add time-add" data-num="1">+</a>
                    </div>
          	</span>
                    <span class="line4">
                  稳定时长：3~6小时        	</span>
                    <span class="line4">
                  一次最多提取数量：
                                            100个
        	</span>
                    <span class="line4">
                    重复度：360天去重
        	</span>
                    <span class="line4">
                    匿名度：高匿
        	</span>
                    <span class="line4">
                    API最快调用频率：1秒一次
        	</span>
                    <span class="line4">
                    并发请求数量：不限制
        	</span>
                    <span class="line4">
                    HTTP,HTTPS,SOCK5支持
        	</span>
                    <a data-id="21" data-money="98.00" data-buytype="cus_buy" class="act_pay pay">立即购买</a>
                </li>

                <li>

                    <!-- <div class="act-11-flag qq_link">
                        <h6>联系客服</h6>
                        <h4>买二<br/>送一</h4>
                      </div> -->
                    <!--<div class="discount">-->
                    <!--<p>原价:98元</p>-->
                    <!--<span>立省</span>-->
                    <!--<a>18元</a>-->
                    <!--</div>-->
                    <span class="line">
        	<i></i>
                    按周购买-12小时版        	</span>
                    <span class="line2">
        	<a class="price" data-price="98">98</a>

        	</span>
                    <span class="line3">
                    价目表
        	</span>
                    <span class="line4">
            每天使用上限：
                        <!--<i class="red">40</i>-->
                 <div class="order">
                      <a class="reduce s-reduce act" data-num="40">-</a>
                       <input type="text" class="nums s-nums" value="40" readonly="">
                      <a class="add s-add" data-num="40">+</a>
                 </div>
          	</span>
                    <span class="line4">
           套餐包周数量：
                        <!--<i class="red">40</i>-->
                 <div class="order">
                      <a class="reduce time-reduce act" data-num="1">-</a>
                       <input type="text" class="nums time-nums" value="1" readonly="">
                      <a class="add time-add" data-num="1">+</a>
                    </div>
          	</span>
                    <span class="line4">
                  稳定时长：6~12小时        	</span>
                    <span class="line4">
                  一次最多提取数量：
                                            40个
        	</span>
                    <span class="line4">
                    重复度：360天去重
        	</span>
                    <span class="line4">
                    匿名度：高匿
        	</span>
                    <span class="line4">
                    API最快调用频率：1秒一次
        	</span>
                    <span class="line4">
                    并发请求数量：不限制
        	</span>
                    <span class="line4">
                    HTTP,HTTPS,SOCK5支持
        	</span>
                    <a data-id="22" data-money="98.00" data-buytype="cus_buy" class="act_pay pay">立即购买</a>
                </li>


            </ul>


            <ul class="package">


                <li>
          	    <span class="line">
          	<i></i>
                      按月购买-5分钟版          	</span>
                    <span class="line2">
          	<a class="price price_1" data-price="360">360</a>


            </span>
                    <span class="line3">
                      价目表
          	</span>
                    <span class="line4">
                  每天使用上限：
                        <!--<i class="red">700</i>个-->

                    <div class="order">
                      <a class="reduce reduce_1 act s-reduce" data-num="700">-</a>
                      <input type="text" class="nums  s-nums" value="700" readonly="">
                      <a class="add add_1 s-add" data-num="700">+</a>
                    </div>

                </span>
                    <span class="line4">
                  套餐包月数量：
                        <!--<i class="red">700</i>个-->

                    <div class="order">
                      <a class="reduce reduce_1 act time-reduce" data-num="1">-</a>
                      <input type="text" class="nums time-nums" value="1" readonly="">
                      <a class="add add_1 time-add" data-num="1">+</a>
                    </div>

                </span>
                    <span class="line4">
                    稳定时长：1~5分钟          	</span>
                    <span class="line4">
                    一次最多提取数量：
                                            400
                    个
          	</span>
                    <span class="line4">
                      重复度：360天去重
          	</span>
                    <span class="line4">
                      匿名度：高匿
          	</span>
                    <span class="line4">
                      API最快调用频率：1秒一次
          	</span>
                    <span class="line4">
                      并发请求数量：不限制
          	</span>
                    <span class="line4">
                      HTTP,HTTPS,SOCK5支持
          	</span>
                    <a data-id="27" data-money="360.00" data-buytype="cus_buy" data-key="1" class="act_pay_pc pay act_pay_1">立即购买</a>
                </li>

                <li>
          	    <span class="line">
          	<i></i>
                      按月购买-25分钟版          	</span>
                    <span class="line2">
          	<a class="price price_2" data-price="360">360</a>


            </span>
                    <span class="line3">
                      价目表
          	</span>
                    <span class="line4">
                  每天使用上限：
                        <!--<i class="red">500</i>个-->

                    <div class="order">
                      <a class="reduce reduce_2 act s-reduce" data-num="500">-</a>
                      <input type="text" class="nums  s-nums" value="500" readonly="">
                      <a class="add add_2 s-add" data-num="500">+</a>
                    </div>

                </span>
                    <span class="line4">
                  套餐包月数量：
                        <!--<i class="red">500</i>个-->

                    <div class="order">
                      <a class="reduce reduce_2 act time-reduce" data-num="1">-</a>
                      <input type="text" class="nums time-nums" value="1" readonly="">
                      <a class="add add_2 time-add" data-num="1">+</a>
                    </div>

                </span>
                    <span class="line4">
                    稳定时长：5~25分钟          	</span>
                    <span class="line4">
                    一次最多提取数量：
                                            400
                    个
          	</span>
                    <span class="line4">
                      重复度：360天去重
          	</span>
                    <span class="line4">
                      匿名度：高匿
          	</span>
                    <span class="line4">
                      API最快调用频率：1秒一次
          	</span>
                    <span class="line4">
                      并发请求数量：不限制
          	</span>
                    <span class="line4">
                      HTTP,HTTPS,SOCK5支持
          	</span>
                    <a data-id="23" data-money="360.00" data-buytype="cus_buy" data-key="2" class="act_pay_pc pay act_pay_2">立即购买</a>
                </li>

                <li>
          	    <span class="line">
          	<i></i>
                      按月购买-3小时版          	</span>
                    <span class="line2">
          	<a class="price price_3" data-price="360">360</a>


            </span>
                    <span class="line3">
                      价目表
          	</span>
                    <span class="line4">
                  每天使用上限：
                        <!--<i class="red">200</i>个-->

                    <div class="order">
                      <a class="reduce reduce_3 act s-reduce" data-num="200">-</a>
                      <input type="text" class="nums  s-nums" value="200" readonly="">
                      <a class="add add_3 s-add" data-num="200">+</a>
                    </div>

                </span>
                    <span class="line4">
                  套餐包月数量：
                        <!--<i class="red">200</i>个-->

                    <div class="order">
                      <a class="reduce reduce_3 act time-reduce" data-num="1">-</a>
                      <input type="text" class="nums time-nums" value="1" readonly="">
                      <a class="add add_3 time-add" data-num="1">+</a>
                    </div>

                </span>
                    <span class="line4">
                    稳定时长：25分钟~3小时          	</span>
                    <span class="line4">
                    一次最多提取数量：
                                            200个
          	</span>
                    <span class="line4">
                      重复度：360天去重
          	</span>
                    <span class="line4">
                      匿名度：高匿
          	</span>
                    <span class="line4">
                      API最快调用频率：1秒一次
          	</span>
                    <span class="line4">
                      并发请求数量：不限制
          	</span>
                    <span class="line4">
                      HTTP,HTTPS,SOCK5支持
          	</span>
                    <a data-id="24" data-money="360.00" data-buytype="cus_buy" data-key="3" class="act_pay_pc pay act_pay_3">立即购买</a>
                </li>

                <li>
          	    <span class="line">
          	<i></i>
                      按月购买-6小时版          	</span>
                    <span class="line2">
          	<a class="price price_4" data-price="360">360</a>


            </span>
                    <span class="line3">
                      价目表
          	</span>
                    <span class="line4">
                  每天使用上限：
                        <!--<i class="red">100</i>个-->

                    <div class="order">
                      <a class="reduce reduce_4 act s-reduce" data-num="100">-</a>
                      <input type="text" class="nums  s-nums" value="100" readonly="">
                      <a class="add add_4 s-add" data-num="100">+</a>
                    </div>

                </span>
                    <span class="line4">
                  套餐包月数量：
                        <!--<i class="red">100</i>个-->

                    <div class="order">
                      <a class="reduce reduce_4 act time-reduce" data-num="1">-</a>
                      <input type="text" class="nums time-nums" value="1" readonly="">
                      <a class="add add_4 time-add" data-num="1">+</a>
                    </div>

                </span>
                    <span class="line4">
                    稳定时长：3~6小时          	</span>
                    <span class="line4">
                    一次最多提取数量：
                                            100个
          	</span>
                    <span class="line4">
                      重复度：360天去重
          	</span>
                    <span class="line4">
                      匿名度：高匿
          	</span>
                    <span class="line4">
                      API最快调用频率：1秒一次
          	</span>
                    <span class="line4">
                      并发请求数量：不限制
          	</span>
                    <span class="line4">
                      HTTP,HTTPS,SOCK5支持
          	</span>
                    <a data-id="25" data-money="360.00" data-buytype="cus_buy" data-key="4" class="act_pay_pc pay act_pay_4">立即购买</a>
                </li>

                <li>
          	    <span class="line">
          	<i></i>
                      按月购买-12小时版          	</span>
                    <span class="line2">
          	<a class="price price_5" data-price="360">360</a>


            </span>
                    <span class="line3">
                      价目表
          	</span>
                    <span class="line4">
                  每天使用上限：
                        <!--<i class="red">40</i>个-->

                    <div class="order">
                      <a class="reduce reduce_5 act s-reduce" data-num="40">-</a>
                      <input type="text" class="nums  s-nums" value="40" readonly="">
                      <a class="add add_5 s-add" data-num="40">+</a>
                    </div>

                </span>
                    <span class="line4">
                  套餐包月数量：
                        <!--<i class="red">40</i>个-->

                    <div class="order">
                      <a class="reduce reduce_5 act time-reduce" data-num="1">-</a>
                      <input type="text" class="nums time-nums" value="1" readonly="">
                      <a class="add add_5 time-add" data-num="1">+</a>
                    </div>

                </span>
                    <span class="line4">
                    稳定时长：6~12小时          	</span>
                    <span class="line4">
                    一次最多提取数量：
                                            40个
          	</span>
                    <span class="line4">
                      重复度：360天去重
          	</span>
                    <span class="line4">
                      匿名度：高匿
          	</span>
                    <span class="line4">
                      API最快调用频率：1秒一次
          	</span>
                    <span class="line4">
                      并发请求数量：不限制
          	</span>
                    <span class="line4">
                      HTTP,HTTPS,SOCK5支持
          	</span>
                    <a data-id="26" data-money="360.00" data-buytype="cus_buy" data-key="5" class="act_pay_pc pay act_pay_5">立即购买</a>
                </li>


            </ul>

            <ul class="long_ip">
                <li>
                    <div class="item">
                        <p>匿名度</p><span>高匿</span>
                    </div>
                    <div class="item">
                        <p>支持类型</p><span>HTTP,SOCK5</span>
                    </div>
                    <div class="item">
                        <p>稳定时长</p>
                        <label for="r-17">
                            <input type="radio" id="r-17" data-price="5.00" value="17" name="time-length" checked="">
                            <span></span>
                            1天
                        </label>

                        <label for="r-19">
                            <input type="radio" id="r-19" data-price="33.00" value="19" name="time-length">
                            <span></span>
                            7天
                        </label>

                        <label for="r-20">
                            <input type="radio" id="r-20" data-price="130.00" value="20" name="time-length">
                            <span></span>
                            30天
                        </label>

                        <label for="r-21">
                            <input type="radio" id="r-21" data-price="380.00" value="21" name="time-length">
                            <span></span>
                            90天
                        </label>


                    </div>
                    <div class="item">
                        <p>购买数量</p>
                        <div class="order">
                            <a class="reduce reduce1">-</a>
                            <input type="text" class="nums long_nums" value="10">
                            <a class="add add1">+</a>
                        </div>
                    </div>
                    <div class="item">
                        <p>购买金额</p>
                        <a id="all_money">¥50</a>
                    </div>

                    <div class="btns">
                        <a data-money="5000" data-buytype="long_buy" class=" pay go_to_buy_long">立即购买</a>
                        <a class="links" href="javascript:;" target="_blank">联系客服</a>
                        <p><i class="iconfont"></i>更长时间需要联系客服</p>
                    </div>
                </li>
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

    <h1 class="big_customer"><i class="iconfont"></i>大客户专区</h1>
    <ul class="main_customer">

        <!--双旦代码-->
        <!--  <div class="old_man" style="    position: absolute;   left: -90px; top: 40px;">
              <img src="http://static.http.cnapi.cc/static/index/src/img/may-active/may-man.png" alt="">
          </div>-->
        <!--end-->
        <li>


            <span class="money">2000</span>
            <span class="reality">实到<a>2600</a>元</span>
            <a class="recharge act_pay" data-id="5" data-buytype="recharge" data-money="2000">立即充值</a>
            <!--<span class="give">限时赠送<a>600</a>元</span>&lt;!&ndash;双旦代码&ndash;&gt;-->
            <span class="give">额外送<a>30%</a></span>
        </li>
        <!--双旦代码-->
        <!--  <div class="old_man" style="    position: absolute;   left: -90px; top: 40px;">
              <img src="http://static.http.cnapi.cc/static/index/src/img/may-active/may-man.png" alt="">
          </div>-->
        <!--end-->
        <li>


            <span class="money">5000</span>
            <span class="reality">实到<a>7000</a>元</span>
            <a class="recharge act_pay" data-id="6" data-buytype="recharge" data-money="5000">立即充值</a>
            <!--<span class="give">限时赠送<a>2000</a>元</span>&lt;!&ndash;双旦代码&ndash;&gt;-->
            <span class="give">额外送<a>40%</a></span>
        </li>

        <li>
            <div class="phone">
                <img src="http://static.http.cnapi.cc/static/kefu/hengyongchao.png" class="kefu-img" alt="客户经理">
            </div>
            <div class="text">
                <h2>大客户定制</h2>
                <p>打开微信“扫一扫”<br>联系平台客户经理</p>
            </div>
        </li>

    </ul>
@endsection