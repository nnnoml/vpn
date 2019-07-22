@extends('Index.app')

@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.foot_index')
@extends('Index.Common.alert_index')
@section('main')
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/index2.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/iframe_consult.css" />

    <div class="new-index">
        <!--初始代码-->
        <div class="page-container">
            <div class="first-page page-common">
                <div class="first-page-box">
                    <div class="first-page-bg data-first"></div>
                    <div class="first-page-bg2 data-first"></div>
                    <div class="first-page-content data-first">
                        <span class="icon"></span>
                        <h3>
                            动态IP行业领导者<br>一站式大数据服务提供商
                            <i class="iconfont">&#xe62e;</i>
                            <span class="pro">
                              <a>全局修改： <i>改变整台机器的ip地址，使用后所有软件ip地址都会改变。</i></a>
                              <a>局部修改： <i>http代理仅改某一软件的ip地址，比如可以仅改变浏览器的ip地址。</i></a>
                            </span>
                        </h3>
                        {{--<div class="experience-btn" href="/reg/">--}}
                            {{--<a class="down_pc down-inc"><i class="iconfont">&#xe60c;</i>PC客户端下载</a>--}}
                            {{--<a class="down_android down-inc" ><i class="iconfont">&#xe601;</i>Android下载<img src="{{asset('index_src/img')}}/451b06b5619508da2c5c2d96191aff2b_cyadl7.png"></a>--}}
                            {{--<a target="_blank" href="/ios_use/"><i class="iconfont">&#xe60e;</i>iPhone下载</a>--}}
                            {{--<a  class="eb-download down_mac" ><i class="iconfont">&#xe666;</i>Mac端下载</a>--}}
                            {{--<a  class="eb-links down_plugin" ><i class="iconfont">&#xe724;</i>浏览器插件下载</a>--}}
                        {{--</div>--}}
                        {{--<div class="banner-platform">--}}
                            {{--<span><i class="iconfont">&#xe653;</i>Windows</span>--}}
                            {{--<span><i class="iconfont">&#xe6ec;</i>安卓手机</span>--}}
                            {{--<span><i class="iconfont">&#xe64d;</i>安卓平板</span>--}}
                            {{--<span><i class="iconfont">&#xe694;</i>模拟器</span>--}}
                            {{--<span><i class="iconfont">&#xe651;</i>虚拟机</span>--}}
                            {{--<span><i class="iconfont">&#xe652;</i>iPhone</span>--}}
                            {{--<span><i class="iconfont">&#xe650;</i>iPad</span>--}}
                            {{--<span><i class="iconfont">&#xe666;</i>Mac</span>--}}
                            {{--<span><i class="iconfont">&#xe724;</i>浏览器插件</span>--}}
                        {{--</div>--}}
                    </div>
                    <div class="first-page-footer">
                        <div class="toggle-button">
                            <div class="toggle-button-icon"></div>
                        </div>
                        <p class="warning-font">
                            *本软件仅适用于营销或工作使用, 切勿做违法用途
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-common page-area">
            <span class="pa-bg-cir-1"></span>
            <div class="page-area-body page-com-body">
                <h4>遍布全国的自营服务器节点</h4>
                <p>领先的大数据IP下达系统，无论身在何处，仅需一键，让全国IP尽在掌握</p>
                <div class="infos">
                    <div class="text">
                        <h4>100+</h4>
                        <p>节点</p>
                    </div>
                    <div class="text">
                        <h4>10T</h4>
                        <p>宽带</p>
                    </div>
                    <div class="text">
                        <h4>NO.1</h4>
                        <p>同类产品</p>
                    </div>
                </div>
                <div class="maps">
                    <div class="tips"><a href="JavaScript:;">覆盖北京，深圳，广州，成都等200+城市</a></div>
                    <ul class="notes">
                        <li class="n-1">已开通</li>
                    </ul>
                    <div class="points">
                    </div>
                </div>
            </div>
        </div>
        <div class="page-common page-tech">
            <div class="page-area-body page-com-body">
                <h4>值得信赖的技术服务</h4>
                <p>11VPN提供的高级模式，以专用私有技术，带给您从未有过的极速畅快体验</p>
                <div class="page-tech-contain">
                    <div class="item">
                        <h4><span>用户独享宽带</span><i class="iconfont">&#xe656;</i></h4>
                        <p>高级模式中，用户可以独享固定<br/>
                            带宽资源，光速网络体验，流畅稳定使用</p>
                    </div>
                    <div class="item">
                        <h4><span>高质量出口</span><i class="iconfont">&#xe657;</i></h4>
                        <p>11VPN大数据IP下达系统均为自有机房<br/>
                            数万独拨线路，7*24小时不间断供应IP</p>
                    </div>
                    <div class="item">
                        <h4><span>极速连接体验</span><i class="iconfont">&#xea0c;</i></h4>
                        <p>新增高级模式网速是普通模式的50倍<br/>
                            开展业务效果更好，网速更流畅</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-common page-service">
            <div class="page-area-body page-com-body ">
                <div class="page-am-1"></div>
                <div class="page-am-2"></div>
                <h4>为你提供安全可靠的大数据动态IP服务</h4>
                <p>全球领先,安全,稳定的大数据辅助产品,因为专业,所以简单</p>
                <div class="page-service-block">
                    <div class="item">
                        <h4><i class="iconfont">&#xe65f;</i></h4>
                        <p>海量资源</p>
                    </div>
                    <div class="item">
                        <h4><i class="iconfont">&#xe65e;</i></h4>
                        <p>稳定安全可靠</p>
                    </div>
                    <div class="item">
                        <h4><i class="iconfont">&#xe65b;</i></h4>
                        <p>7*24小时技术支持</p>
                    </div>
                    <div class="item">
                        <h4><i class="iconfont">&#xe68b;</i></h4>
                        <p>智能优化服务</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-common page-choice">
            <div class="page-choice-body page-com-body ">
                <div class="page-am-1"></div>
                <div class="page-am-2"></div>
                <h4>众多的选择,以满足您业务无限的可能性</h4>
                <p>灵活多变的选择以满足你业务全面的需求</p>
                <div class="page-c-contain">
                    <div class="item">
                        <h4>网络技术服务</h4>
                        <p>网站采集/论坛发帖/游戏测试/营销优化</p>
                    </div>
                    <div class="item">
                        <h4>推广优化服务</h4>
                        <p>电子商务/定制化服务/推广营销/数据分析</p>
                    </div>
                    <div class="item">
                        <h4>企业应用服务</h4>
                        <p>大数据/数据爬取/SEO优化/金融理财</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-common page-news">
            <div class="page-com-body ">
                <div class="news-block">
                    <a class="news-img-link" target="_blank" href="https://www.baidu.com">
                        <img src="{{asset('index_src/img')}}/fd980fcf738103ff0a60e88a703a052f.png">
                    </a>
                    <div class="news-top">
                        <a  class="left">最新资讯</a>
                        @foreach($article as $key=>$vo)
                            <a class="info_a @if($loop->index+1 == 1) active @endif"  data-val="{{$loop->index+1}}" _href="/article/{{$vo['ac_id']}}"><h2>{{$vo['ac_name']}}</h2></a>
                        @endforeach
                        <a class="school" href="/school/" target="_blank"><h2>使用帮助</h2></a>
                        <a class="more-info">查看更多></a>
                    </div>
                    <div class="news-contain">
                        @foreach($article as $key=>$vo)
                            <div class="warp c{{$loop->index+1}}"  @if($loop->index+1 != 1) style="display:none" @endif>
                                @foreach($vo['list'] as $key2=>$vo2)
                                    <p class="news-link">
                                        <span>{{date('Y-m-d',strtotime($vo2['created_at']))}}</span>
                                        <a href="./article/{{$vo2['ac_id']}}/{{$vo2['id']}}" target="_blank">{{$vo2['title']}}</a>
                                    </p>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{asset('index_src/js')}}/index2.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js')}}/dynamics.min.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js')}}/inc.js"></script>

    <!-- 首页直接 客服弹框-->
    {{--<div class="service-modal">--}}
        {{--<div class="modal-main">--}}
            {{--<div class="sem-top">--}}
                {{--<span>欢迎使用芝麻软件</span>--}}
                {{--<button class="close"></button>--}}
            {{--</div>--}}
            {{--<div class="sem-body">--}}
                {{--<h4>立即注册，免费试用</h4>--}}
                {{--<p>工作时间:&nbsp; 9:00-24:00</p>--}}
            {{--</div>--}}
            {{--<div class="sem-bot">--}}
                {{--<a class="sem-btn submit">确定</a>--}}
                {{--<a class="sem-btn cancel close">取消</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection