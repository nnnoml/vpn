<div class="up-part">
    <div class="search-box">
        <div class="search-frame">
            <div class="search-title">
                <div class="icon">
                    <i class="iconfont"></i>
                </div>
                <p>帮助与文档</p>
            </div>
            <form action="" method="get" id="search_form">
                <div class="search-input">
                    <label>
                        <i class="iconfont"></i>
                        <input type="text" placeholder="输入您希望搜索的问题，例如“无法登录”" name="keyword" value="" onkeydown=" if (event.keyCode == 13){$('.search-btn').trigger('click')}">
                        <a class="search-btn">立即搜索</a>
                    </label>
                    <ul class="hot-word">
                        搜索热词 :
                        <li class="hot1"><a>账号无法登录</a></li>
                        <li class="hot2"><a>如何充值</a></li>
                        <li class="hot3"><a>如何使用</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function () {
        $(document).on('click','.search-btn',function () {
            var keyword=$("input[name='keyword']").val();
            if(!keyword){
                location.href='/help/school/';
                return false;
            }
            $('#search_form').attr('action','/help/search');
            $('#search_form').submit();
        })
        var keyword=GetQueryString('keyword');
        if(keyword){
            $("input[name='keyword']").val(keyword);
        }
        function GetQueryString(name)
        {
            var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if(r!=null)return  decodeURI(r[2]); return null;
        }
    })
    $(document).on('click','.hot-word a',function () {
        $("input[name='keyword']").val($(this).html())
        $('.search-btn').trigger('click')
    })
</script>