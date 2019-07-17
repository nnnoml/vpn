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
                    <li class="active"><a href="/help/school">新手学堂</a></li>
                    <li><a href="/help">文档中心</a></li>
                    <!--<li><a href="/contact">联系客服</a></li>-->
                </ul>
            </div>
        </div>
    </div>
    <div class="school-content">
        <div class="content-box">
            <div class="product-list">
                <div class="product-title">
                    <span></span>
                    <p>了解芝麻软件及产品</p>
                    <!-- <a href="/help">了解更多</a> -->
                </div>
                <div class="product-content">
                    <div class="product product1" data-id="10">
                        <img src="http://zmdl-static.upupfile.com/static/ip_new/img/usinghelp/product1.png" alt="">
                        <div class="cover">
                            <p>IOS端如何使用软件换IP？</p>
                        </div>
                    </div>
                    <div class="product product2" data-id="11">
                        <img src="http://zmdl-static.upupfile.com/static/ip_new/img/usinghelp/product2.png" alt="">
                        <div class="cover">
                            <p>支持哪些设备终端？</p>
                        </div>
                    </div>
                    <div class="product product3" data-id="12">
                        <img src="http://zmdl-static.upupfile.com/static/ip_new/img/usinghelp/product3.png" alt="">
                        <div class="cover">
                            <p>有哪些特色功能？</p>
                        </div>
                    </div>
                    <div class="product product4" data-id="14">
                        <img src="http://zmdl-static.upupfile.com/static/ip_new/img/usinghelp/product4.png" alt="">
                        <div class="cover">
                            <p>IOS移动端如何充值</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="install-list">
                <div class="install-title">
                    <span></span>
                    <p>安装向导</p>
                </div>
                <div class="install-content">
                    <div class="install install1 zm_install hovers" data-sn="ios_install">
                <span>
                    <i class="iconfont"></i>
                </span>
                        <p>iOS移动端</p>
                    </div>
                    <div class="install install2 zm_install hovers" data-sn="android_install">
                <span>
                    <i class="iconfont"></i>
                </span>
                        <p>Android移动端</p>
                    </div>
                    <div class="install install3 zm_install hovers" data-sn="windows_install">
                <span>
                    <i class="iconfont"></i>
                </span>
                        <p>Windows客户端</p>
                    </div>
                    <div class="install install4 zm_install hovers" data-sn="mac_install">
                <span>
                    <i class="iconfont"></i>
                </span>
                        <p>Mac客户端</p>
                        <p>敬请期待...</p>
                    </div>
                    <div class="install install5 zm_install hovers" data-sn="http">
                <span>
                    <i class="iconfont"></i>
                </span>
                        <p>HTTP</p>
                    </div>
                    <div class="install install6 zm_install hovers" data-sn="sdk">
                <span>
                    <i class="iconfont"></i>
                </span>
                        <p>SDK</p>
                    </div>
                </div>
            </div>
            <div class="problem-list">
                <div class="problem-title">
                    <span></span>
                    <p>常见问题</p>
                    <a href="/help">了解更多</a>
                </div>
                <div class="problem-content">
                    <a class="problem problem1" href="/detail/19.html">
                        <p>iOS下载安装教程</p>
                        <span><i class="iconfont"></i></span>
                    </a>
                    <a class="problem problem2" href="/detail/21.html">
                        <p>旗舰版下载安装教程</p>
                        <span><i class="iconfont"></i></span>
                    </a>
                    <a class="problem problem3" href="/detail/14.html">
                        <p>IOS移动端如何充值</p>
                        <span><i class="iconfont"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection