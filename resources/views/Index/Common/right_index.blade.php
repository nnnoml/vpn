@section('right')
    {{--右侧在线咨询--}}
    <div class="float-contact">
        <div class="right-customer">
            <span class="small-blue">在线咨询</span>

            <div class="left-content" style="display: none;">
                <span class="iconfont btn-close">&#xe627;</span>
                <div class="main">
                    <a href="http://q.url.cn/s/gL29h6m?_type=wpa" target="_blank">
                        <div class="item qq_link">
                            <p>售前客服</p>
                            <span>在线客服，实时响应</span>
                        </div>
                    </a>
                    <a class="item qq_after_sale" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3402814787&amp;site=qq&amp;menu=yes" target="_blank">
                        <p>售后客服1</p>
                        <span>在线售后，实时响应</span>
                    </a>
                    <a class="item qq_after_sale" href="http://wpa.qq.com/msgrd?v=3&amp;uin=211221734&amp;site=qq&amp;menu=yes" target="_blank">
                        <p>售后客服2</p>
                        <span>在线售后，实时响应</span>
                    </a>
                    <div class="item">
                        <p>渠道／企业／大客户合作</p>
                        <span class="yellow">客户经理：<span class="kefu-phone">15305445551</span></span>
                    </div>

                    <div class="code">
                    <span>
                        <img src="{{asset('index_src/img')}}/publics.jpg" alt="">芝麻代理公众号</span>
                        <span><img src="{{asset('index_src/img')}}/luhaitao-2.jpg" alt="" class="side_wechat">微信客服</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--大客户--}}
    <a class="passageway ">
        大客户</br>VIP通道
    </a>
    <div class="modal-intros"  >
        <div class="modal-mains">
            <span class="close"></span>
            <div class="left">
                <div class="tit">客户经理</div>
                <div class="subhead">您的专属客户经理</div>
                <div class="qq"><img src="{{asset('index_src/img')}}/qq001.png" alt=""> <span class="">2781589383</span></div>
                <div><img src="{{asset('index_src/img')}}/tell001.png" alt=""> <span class="">18905201785</span></div>
            </div>
            <div class="right">
                <img src="{{asset('index_src/img')}}/weiweiwei.png" class="" alt="">
                <p>微信二维码</p>
            </div>
        </div>
    </div>
@endsection