@section('nav')
<header class="header bg">
    <a class="new-logo seo_logo_base" href="/">
        @if(isset($logo2))
            {{--light--}}
            <img src="{{$sys_conf['logo2']}}" />
        @else
            {{--dark--}}
            <img src="{{$sys_conf['logo']}}" />
        @endif
    </a>
    <ul class="nav">
        <li @if($nav == '') class="index_index nav-active" @else class="index_index" @endif ><a href="/">首页</a></li>
        <li @if($nav == 'setMenu_vpn') class="pay_index pay_year nav-active" @else class="index_index" @endif ><a href="/setMenu/vpn">VPN套餐购买</a></li>

        <li @if($nav == 'setMenu_http') class="pay_index pay_year nav-active" @else class="index_index" @endif ><a href="/setMenu/http">HTTP套餐购买</a></li>

        {{--<li class="index_download"><a href="/download/">软件下载</a></li>--}}
        <li @if($nav == 'ipList') class="index_citylist nav-active" @else class="index_index" @endif ><a href="/ipList">PPTP线路表</a></li>

        <li @if($nav == 'getIp') class="index_citylist nav-active" @else class="index_index" @endif ><a href="/getIP">获取API</a></li>

        <li @if($nav == 'help') class="index_join nav-active" @else class="index_join" @endif><a href="/help/school" >使用帮助</a></li>

        <!--处理登录以后-->

        @if(!$isLogin)
        <li class="register nav-combtn nav-combtn-active reg_modal reg_li_base">
            <a>注册</a>
            {{--<span class="uc-b-tip"><i class="iconfont"></i>注册免费试用</span>--}}
        </li>
        <li class="log-in nav-combtn login_modal reg_li_base"><a>登录</a></li>
        @else
        <li class=" nav-combtn nav-combtn-active has-icon user_li_base">
            <a class="" href="/user">&nbsp;</a>
        </li>
        <li class="log-in nav-combtn user_li_base"><a href="/user/loginOut" class="logout-link">退出登陆</a></li>
        @endif

    </ul>
</header>
@endsection