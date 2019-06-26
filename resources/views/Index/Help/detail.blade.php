@extends('Index.app')
@section('title',$title)

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
                    <li><a href="help/school">新手学堂</a></li>
                    <li class="active"><a href="/help">文档中心</a></li>
                    <!--<li><a href="/contact">联系客服</a></li>-->
                </ul>
            </div>
        </div>
    </div>
    <div class="document-center">
        <div class="document-center-box">
            @include('Index.Help.left')
            <!--右侧内容-->
            <div class="right-content">
                <div class="content-nav">
                    <a>帮助与文档<span>&gt;</span></a>
                    <a>{{$class_info['hc_name']}}<span>&gt;</span></a>
                    <a>{{$info['title']}}</a>
                </div>
                <h3 class="content-details-title">{{$info['title']}}</h3>
                <p class="turnover-time">
                    最近更新时间   : <a>{{$info['created_at']}}</a>
                </p>
                <div class="details-content">
                    <p style="text-indent: 2em; line-height: 2em;">
                        {!! $info['content'] !!}
                    </p>
                {{--<div class="content-evaluate">--}}
                    {{--<p>以上信息对你是否有帮助?</p>--}}
                    {{--<div class="start-box">--}}
                        {{--<div class="start">--}}
                            {{--<div class="grade-active start1"></div>--}}
                            {{--<div class="grade-active start2"></div>--}}
                            {{--<div class="grade-active start3"></div>--}}
                            {{--<div class="grade-active start4"></div>--}}
                            {{--<div class="grade-active start5"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<a>感谢您的评分！若您有还有其他意见和建议，欢迎在评论区留言，我们会努力做得更好！</a>--}}
                {{--</div>--}}
                <div class="zskf">
                    <div class="name">
                        魏经理
                    </div>
                    <span class="qq">2781589383</span>
                    <span class="tell">18905201785</span>
                    <img src="http://webapi.apehorse.com/static/kefu/weiweiwei.png" alt="">
                </div>
                {{--<form id="comment_form">--}}
                    {{--<div class="feedback-area">--}}
                        {{--<div class="title">--}}
                            {{--<p>反馈</p>--}}

                            {{--<a class="login_modal reg_li_base">登录</a><a class="long-string reg_li_base">|</a><a class="reg_modal reg_li_base">注册</a>--}}

                            {{--<a class="user_a_base_1" style="display: none"></a>--}}

                        {{--</div>--}}
                        {{--<textarea name="content" id="content" maxlength="500"></textarea>--}}
                        {{--<div class="submit-area">--}}
                            {{--<input type="checkbox" id="anonymous" class="anonymous-input" name="is_anonymous">--}}
                            {{--<p class="numerical_calculation">还可以输入<span>500</span>字</p>--}}
                            {{--<label for="anonymous" class="anonymous">--}}
                                {{--<span class="bg"></span>--}}
                                {{--<span class="font">匿名提交</span>--}}
                            {{--</label>--}}
                            {{--<input type="hidden" name="arc_id" value="131">--}}
                            {{--<label class="btn-area">--}}
                                {{--<input type="button" value="提交" id="sub_comment">--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
                {{--<div class="show-comments"></div>--}}
            </div>
        </div>
    </div>

    <div class="return_top" style="display: none;">
        <i class="iconfont"></i>
        <a>回到顶部</a>
    </div>

    <script type="text/javascript" src="{{asset('index_src/js')}}/help.js"></script>
@endsection