@section('head')
<div class="layui-header">
    <div class="layui-logo">VPN 后台管理</div>
    <ul class="layui-nav layui-layout-left">
        <li class="layui-nav-item"><a href="/{{config('sys_conf.admin')}}">控制台</a></li>
        <li class="layui-nav-item"><a href="">商品管理</a></li>
        <li class="layui-nav-item"><a href="">用户</a></li>
        <li class="layui-nav-item">
            <a href="javascript:;">其它系统</a>
            <dl class="layui-nav-child">
                <dd><a href="">邮件管理</a></dd>
                <dd><a href="">消息管理</a></dd>
                <dd><a href="">授权管理</a></dd>
            </dl>
        </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
            <a href="javascript:;">
                {{--<img src="//tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg" class="layui-nav-img">--}}
                管理员
            </a>
            <dl class="layui-nav-child">
                <dd><a href="/{{config('sys_conf.admin')}}/changePWD">修改密码</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item"><a href="/{{config('sys_conf.admin')}}/loginOut">退出</a></li>
    </ul>
</div>
@endsection