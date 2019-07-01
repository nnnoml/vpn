@extends('Index.app')
@section('title',$title)

@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.foot_index')
@extends('Index.Common.alert_index')
@section('main')
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/index2.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/iframe_consult.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/getip.css" >

    <link rel="stylesheet" href="{{asset('plug/layui/css')}}/layui.css"  media="all">
    <script src="{{asset('plug/layui')}}/layui.js" charset="utf-8"></script>

    <section style="margin-top:120px;">
        <div class="dial_left fadeInLeft">
            <h1>提取IP/生成IP</h1>

            <div class="region">
                <div class="region_list">
                    <h1 class="left">请选择提取类型</h1>
                    <div class="right">
                        <form class="layui-form" action="" style="float:left;margin-top:10px;">
                            <div class="layui-form-item">
                                <label class="layui-form-label">单行选择框</label>
                                <div class="layui-input-inline">
                                    <select name="type" lay-filter="">
                                        <option value="0">按次提取</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="free_btn ok_free_btn"><a id="get_free_day_package">领取每日免费IP</a></div>
                    </div>
                </div>
                <h1>账户概况
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
                <div class="region_list no_long_pack">
                    <h1 class="left">提取数量</h1>
                    <div class="right">
                        <div id="Demo">
                            <div id="Main">
                                <div id="slideTest1"></div>
                                <span class="img_1"><i></i><span>1个</span></span>
                                <span class="img_3"><i></i><span id="scrollBarmid">200个</span></span>
                                <span class="img_4"><i></i><span id="scrollBarend">400个</span></span>
                            </div>
                            <div id="count" class="count">
                                <i class="left " id="left">-</i>
                                <span id="scrollBarTxt" class="">1</span>
                                <i class="right " id="right">+</i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="region_list">
                    <h1 class="left">IP协议</h1>
                    <div class="right agent">
                        <label>
                            <input type="radio" name="port_type" value="1" checked="checked">
                            <i class="radios"></i>HTTP
                        </label>
                        <label class="no_long_pack">
                            <input type="radio" name="port_type" value="11">
                            <i class="radios"></i>HTTPS
                        </label>
                        <label>
                            <input type="radio" name="port_type" value="2">
                            <i class="radios"></i>SOCKS5
                        </label>
                    </div>
                </div>

                <div class="region_list">
                    <h1 class="left time_length">稳定使用时长</h1>
                    <div class="right stable time_length">
                        @foreach($h_type_list as $key=>$vo)
                        <label>
                            <input type="radio" name="time_select" value="{{$vo['h_type_id']}}"@if($loop->index ==0) checked="checked" @endif>
                            <i class="radios"></i>{{$vo['start_second_format']}}至{{$vo['end_second_format']}}【{{$vo['price']/100}}芝麻币/个】
                        </label>
                        @endforeach
                        <a href="/help" target="_blank" class="more">了解更多&gt;</a>
                    </div>
                </div>

                <div class="region_list">
                    <h1 class="left">数据格式</h1>
                    <div class="right agent">
                        <label class="buttons ">
                            <input type="radio" name="data_type" value="1" checked="checked" class="buttons_txt">
                            <i class="radios"></i>TXT
                        </label>
                        <label class="buttons ">
                            <input type="radio" name="data_type" value="2" class="buttons_json">
                            <i class="radios"></i>JSON
                        </label>
                        <label class="buttons ">
                            <input type="radio" name="data_type" value="3" class="buttons_html">
                            <i class="radios"></i>HTML
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
                            <i class="radios"></i>回车换行（ \ r \ n ）
                        </label>
                        <label class="choose_html" style="display:none">
                            <input type="radio" name="line_break" value="2">
                            <i class="radios"></i>换行（ /br )
                        </label>
                        <label class="choose_txt">
                            <input type="radio" name="line_break" value="3">
                            <i class="radios"></i>回车（ \ r )
                        </label>
                        <label class="choose_txt">
                            <input type="radio" name="line_break" value="4">
                            <i class="radios"></i>换行（ \ n )
                        </label>
                        <label class="choose_txt">
                            <input type="radio" name="line_break" value="5">
                            <i class="radios"></i>Tab（ \ t )
                        </label>

                        <label class="choose_other">
                            <i class="radios"></i>
                            其他符号:
                        </label>
                        <input type="text" name="special" value="">
                    </div>
                </div>

                <div class="region_list no_long_pack" id="regin_check_div">
                    <h1 class="left">地区选择</h1>
                    <div class="right">
                        <div class="appointe">
                            <label class="label1">
                                <input type="radio" name="st-con" checked="checked" value="1">
                                <i class="radios"></i>
                                指定城市
                            </label>
                            <label class="label2">
                                <input type="radio" name="st-con" value="0">
                                <i class="radios"></i>
                                省份混拨
                                <span style="color:red">（注：未勾选默认全国混拨）</span>
                            </label>
                        </div>

                        <form class="layui-form" action="">
                            <div class="layui-form-item">
                                <div class="layui-input-inline">
                                    <select name="pro">
                                        <option value="">请选择省</option>
                                        <option value="浙江" selected="">浙江省</option>
                                        <option value="你的工号">江西省</option>
                                        <option value="你最喜欢的老师">福建省</option>
                                    </select>
                                </div>
                                <div class="layui-input-inline">
                                    <select name="city">
                                        <option value="">请选择市</option>
                                        <option value="杭州">杭州</option>
                                        <option value="宁波" disabled="">宁波</option>
                                        <option value="温州">温州</option>
                                        <option value="温州">台州</option>
                                        <option value="温州">绍兴</option>
                                    </select>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="region_list no_long_pack">
                    <h1 class="left">端口位数</h1>
                    <div class="right agent">
                        <label>
                            <input type="radio" name="port_bit" value="4" checked="checked">
                            <i class="radios"></i>4位端口
                        </label>
                        <label>
                            <input type="radio" name="port_bit" value="5">
                            <i class="radios"></i>5位端口
                        </label>

                        <label>
                            <input type="radio" name="port_bit" value="45">
                            <i class="radios"></i>端口位数随机
                        </label>
                    </div>
                </div>

                <div class="region_list no_long_pack" id="ip_uniq_div">
                    <h1 class="left">IP去重</h1>
                    <div class="right agent">
                        <label>
                            <input type="radio" name="m_repeat" value="1" checked="checked">
                            <i class="radios"></i>360天去重（默认）
                        </label>
                        <label>
                            <input type="radio" name="m_repeat" value="2">
                            <i class="radios"></i>当日去重
                        </label>
                        <label>
                            <input type="radio" name="m_repeat" value="3">
                            <i class="radios"></i>不去重
                        </label>
                    </div>
                </div>

                <div class="region_list no_long_pack">
                    <h1 class="left">运营商</h1>
                    <div class="right agent">
                        <label>
                            <input type="radio" name="demo" value="0" checked="checked">
                            <i class="radios"></i>不限
                        </label>
                        <label>
                            <input type="radio" name="demo" value="100026">
                            <i class="radios"></i>联通
                        </label>
                        <label>
                            <input type="radio" name="demo" value="100017">
                            <i class="radios"></i>电信
                        </label>
                    </div>
                </div>

            </div>
            <div class="pay">
                <span class="open">生成API链接</span>
            </div>

            <div class="link">

                <label style="font-size:20px">直连IP</label><span>（请复制下面的链接地址，在新的浏览器或标签页打开并查看)</span>
                <input id="api_link" class="api_link" placeholder="点击上方按钮，生成API链接：">
                <input type="button" class="copyUrl" readonly="readonly" id="copyUrl" value="复制链接">

                <a href="#" class="openUrl" target="_blank">打开链接</a>

                <label id="con" style="font-size:20px">隧道IP<i class="iconfont"></i>
                    <span class="hint">专线中转，不同的端口号分配不同的出口IP</span>
                </label><span>（请复制下面的链接地址，在新的浏览器或标签页打开并查看)</span>
                <input id="api_link2" class="api_link" placeholder="点击上方按钮，生成API链接：">
                <input type="button" class="copyUrl" readonly="readonly" id="copyUrl2" value="复制链接">
                <a href="#" class="openUrl2" target="_blank">打开链接</a>

                <div class="annotate">
                    <h1>请求参数注释</h1>
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
                @foreach($help_list['list'] as $key=>$vo)
                <a href="/help/{{$vo['hc_id']}}/{{$vo['id']}}" style="overflow: hidden; text-overflow: ellipsis" target="_blank">{{$vo['title']}}</a>
                @endforeach
            </div>
        </div>

    </section>

    <script>
    layui.use(['slider','form','layer'], function(){
      var $ = layui.$;
      var slider = layui.slider;
      var form = layui.form;
      var layer = layui.layer;
      //默认滑块
      var ins1 = slider.render({
        elem: '#slideTest1'
        ,min: 1 //最小值
        ,max: 400 //最大值
        ,change: function(value){
            $("#scrollBarTxt").html(value);
        }
      });

      $(document).on("click","#right",function(){
            var foo = $(this).parent().find('span');
            var a = foo.html();
            if (a>=0) {
                foo.html(parseInt(a)+1);
                ins1.setValue(parseInt(a))
            }else{
                foo.val(1);
                ins1.setValue(1)
            }
        });

      $(document).on("click","#left",function(){
            var foo = $(this).parent().find('span');
            var a = foo.html();
            if(a>1){
                foo.html(a-1)
                ins1.setValue(a-2)
            }else{
                foo.val(1);
                ins1.setValue(0)
            }
        });


$(".open").click(function(){

    var post = {};
    post['num'] = $("#scrollBarTxt").html();
    post['port'] = $("input[name='port_type']:checked").val();
    post['time'] = $("input[name='time_select']:checked").val();
    post['type'] = $("input[name='data_type']:checked").val();

    if($("input[name='special']").val() == '' || $("input[name='special']").val() == undefined){
        post['lb'] = $("input[name='line_break']:checked").val();
    }
    else{
        post['lb'] = $("input[name='special']").val();
    }

    if($("input[name='st-con']").val()){
        post['pro'] = $("select[name='pro']").val();
        post['city'] = $("select[name='city']").val();
    }
    else{
        post['pro'] = 0;
        post['city'] = 0;
    }

    post['pb'] = $("input[name='port_bit']:checked").val();
    post['mr'] = $("input[name='m_repeat']:checked").val();
    post['yys'] = $("input[name='demo']:checked").val();

    var url = '';
    ajaxDo(url,'post',post,function(data){
        if (data['code'] == '1'){
            $("#api_link").val(data['msg']);
            $("#api_link2").val(data['msg']);
        }else{
            layer.msg(data['msg']);
        }
    });

});


    });

</script>
@endsection