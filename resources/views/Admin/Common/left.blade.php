@section('left')
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">

                {{--<li class="layui-nav-item @if($nav == '') layui-nav-itemed @endif">--}}
                    {{--<a class="" href="javascript:;">基础配置</a>--}}
                    {{--<dl class="layui-nav-child">--}}
                        {{--<dd><a href="javascript:;">列表一</a></dd>--}}
                        {{--<dd><a href="javascript:;">列表二</a></dd>--}}
                        {{--<dd><a href="javascript:;">列表三</a></dd>--}}
                        {{--<dd><a href="">超链接</a></dd>--}}
                    {{--</dl>--}}
                {{--</li>--}}

                <li class="layui-nav-item @if($nav == 'conf') layui-nav-itemed @endif"><a href="/{{config('sys_conf.admin')}}">基础配置</a></li>
                <li class="layui-nav-item @if($nav == 'article') layui-nav-itemed @endif">
                    <a href="javascript:;">文章管理</a>
                    <dl class="layui-nav-child">
                        <dd><a @if($nav2 == 'article_class')  class="layui-this" @endif href="/{{config('sys_conf.admin')}}/ArticleClass">文章分类</a></dd>
                        <dd><a @if($nav2 == 'article_detail')  class="layui-this" @endif href="/{{config('sys_conf.admin')}}/ArticleDetail">文章列表</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item @if($nav == 'help') layui-nav-itemed @endif">
                    <a href="javascript:;">帮助管理</a>
                    <dl class="layui-nav-child">
                        <dd><a @if($nav2 == 'help_class')  class="layui-this" @endif href="/{{config('sys_conf.admin')}}/HelpClass">帮助分类</a></dd>
                        <dd><a @if($nav2 == 'help_detail')  class="layui-this" @endif href="/{{config('sys_conf.admin')}}/HelpDetail">帮助列表</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item @if($nav == 'product') layui-nav-itemed @endif">
                    <a href="javascript:;">产品管理</a>
                    <dl class="layui-nav-child">
                        <dd><a @if($nav2 == 'product')  class="layui-this" @endif href="/{{config('sys_conf.admin')}}/Product">产品信息</a></dd>
                        <dd><a @if($nav2 == 'product_h_type')  class="layui-this" @endif href="/{{config('sys_conf.admin')}}/ProductHType">产品类型列表</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item @if($nav == 'vpn_conf') layui-nav-itemed @endif">
                    <a href="javascript:;">vpn节点管理</a>
                    <dl class="layui-nav-child">
                        <dd><a @if($nav2 == 'vpn_conf')  class="layui-this" @endif href="/{{config('sys_conf.admin')}}/VpnConf">节点列表</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item @if($nav == 'log_center') layui-nav-itemed @endif"><a href="/{{config('sys_conf.admin')}}/LogCenter">日志中心</a></li>
                {{--<li class="layui-nav-item"><a href="">发布商品</a></li>--}}
                {{--<li class="layui-nav-item"><a href="javascript:;">基础配置</a></li>--}}
            </ul>
        </div>
    </div>
@endsection