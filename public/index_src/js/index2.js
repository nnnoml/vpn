/**
 * Created by admin on 2017/4/10.
 */
/*新脚本*/
$(function(){

    //新增2张banner,18/6/14增加
    var block_1st=$(".page-container"),
    //-----end--------
        // var block_1st=$(".first-page"),//18/6/14注释,如改回，解除注释


        _w=$(window),
        _b=$("html,body"),
        wh=_w.height(),
        c_st=0,
        lock_timer,
        scroll_lock=false;
    var pages=[],
        page_1=$(".second-page1");
    pages.push(page_1);

    set_mh();
    binds();
    setMapPoints();

    function binds() {
        var ua = navigator.userAgent.toLowerCase();
        if((ua.indexOf("gecko")>-1&&ua.indexOf("khtml")<=-1)|| ua.indexOf("trident")>-1)
        {
            _b=$("html,body");
        }
        /*  var */
        _b.animate({scrollTop:0}, 50);
        _w.on("resize",function(){
            wh=_w.height();
            set_mh();
        });
        $(document).on("click",".toggle-button-icon",function(){
            //console.log(111)
            _b.animate({scrollTop:wh},400);
            scroll_lock=1;
            clearTimeout(lock_timer);
            lock_timer=setTimeout(function(){
                scroll_lock=0;
                $(".second-page1").addClass("active");
            },600);
        });

        switch_animation(".page-bg2",0,"page-active");
        _w.on("scroll",function(e){
            var st = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
            if (st > 0) {


                $(".header").addClass("active").removeClass("year_header");

                switch_animation(".page-bg3",0,"page-active");

            } else {
                $(".header").removeClass("active").addClass("year_header");
            }

        });
        _w.on("mousewheel",function(e){});
    }
    function set_mh() {
        switch_animation(".first-page",0,"page-active","show-active");
        switch_animation(".second-page",0,"page-active","show-active");
        block_1st.height(wh);
    }
    function switch_animation(index,num,animation,active){//（触发元素，开关参数，动画类名,激活类名）

        if(!active){
            active="";
        }
        if(num==0){
            $(index).addClass(animation+" "+active);
        }
        if(num==1){
            $(index).removeClass(animation+" "+active);
        }
    }


    /*数字加载函数*/
    function add_num(index,max){
        var num=Number(index.text());
        var time=setInterval(function(){
            num+=parseInt(max/(20+Math.random()*10));
            if(num>=max){
                num=max;
                clearInterval(time);
            }
            index.text(num)
        },100)
    }


    function setMapPoints(){
        var area=$(".points"),
     /*省份*/
        dates=[
            {name:"北京",x:662,y:270,big:1,active:1},
            {name:"上海",x:740,y:435,big:1,active:1},
            {name:"广东",x:610,y:570,big:1,active:1},
            {name:"四川",x:486,y:440,big:1,active:1},
            {name:"河北",x:647,y:296,active:1,big:1},
            {name:"江苏",x:718,y:400,active:1,big:1},
            {name:"安徽",x:676,y:422,active:1,big:1},
            {name:"浙江",x:721,y:465,active:1,big:1},
            {name:"山东",x:670,y:330,active:1,big:1},
            {name:"徐州",x:672,y:376,active:1,big:1},
            {name:"黑龙江",x:818,y:152,active:1,big:1},
            {name:"甘肃",x:480,y:350,active:1,big:1},
            {name:"湖南",x:587,y:490,active:1,big:1},
            {name:"湖北",x:602,y:435,active:1,big:1},
            {name:"江西",x:652,y:476,active:1,big:1},
            {name:"辽宁",x:770,y:234,active:1,big:1},
            {name:"山西",x:605,y:322,active:1,big:1},
            {name:"内蒙古",x:556,y:252,active:1,big:1},
            {name:"云南",x:463,y:537,active:1,big:1},
            {name:"河南",x:624,y:380,active:1,big:1},
            {name:"福建",x:680,y:520,active:1,big:1},
            {name:"重庆",x:532,y:456,active:1,big:1},
            {name:"陕西",x:552,y:377,active:1,big:1},
        ];
        var html=$('<div class="item"><span></span><p></p></div>');
        var bindex=0;
        $.each(dates,function(){
            var dom=html.clone();
            dom.find("p").text(this.name);
            if(this.active){
                dom.addClass("active");
            }
            if(this.big){
                dom.addClass("big");
                dom.append('<b class="pb-1"></b><b class="pb-2"></b><b class="pb-3"></b>');
                bindex++;
            }else{
                dom.addClass("small");
            }
            setTimeout(function(){
                dom.addClass("am");
            },400*bindex);
            dom.css({left:this.x,top:this.y});
            area.append(dom);
        });
    }


    /*底部注册功能*/
    var w_input=$(".w-input");
    w_input.eq(0).addClass("active");
    w_input.mousemove(function(){
        w_input.removeClass("active");
        $(this).addClass("active");
    });

});


$(function () {
    var func = {
        init: function () {

        },
        //登录提交
        submit: function () {
            var username = $("input[name='username']").val();
            var password = $("input[name='password']").val();
            var url = $("#login_do_url").val();
            if (username == "") {
                layer.msg('用户名不能为空', {icon: 2});
                return;
            }
            if (password == "") {
                layer.msg('密码不能为空', {icon: 2});
                return;
            }
            var param = $("#form_login").serialize();
            console.log(param);
            common.ajax_jsonp(url, param, function (rt) {
                common.post_tips(rt, function () {
                    window.location.href = $("#index_url").val();
                });
            },true,[0.1,'#eee']);
        }
    };
    //登录提交
    $(document).on("click", ".login_sub", function () {
        func.submit();
    });

    $(function () {
        $(document).on("click",".consult_add .title>a",function () {
            var a = $(this).index(".title>a");
            $(this).addClass("active").siblings("a").removeClass("active");
            $(".consult>.ul").eq(a).show().siblings(".consult>.ul").hide();
        })
    })


    var m=$(".modal.warn-tips");
    setTimeout(function(){
        m.show();
        setTimeout(function(){
            m.addClass("active");
        },50)
    },500);
    m.find(".close").add(m.find(".cancel")).on("click",function(){
        m.removeClass("active");
        setTimeout(function(){
            m.hide();
        },300);
    });
});
function KeyDown()
{
    if (event.keyCode == 13)
    {
        $('.login_sub').trigger('click');
    }
}




(function($)  {
    //code here
})(jQuery);
/*右侧通知*/

info();
function info(){
    $(document).on("click",".info_logo",function (e) {
        e.preventDefault();
        $(".inform-modal").fadeIn();
    });

    $(document).on("click",".inform-modal .close",function (e) {
        e.preventDefault();
        $(this).parents(".inform-modal").fadeOut();})
}


//leee 19.6.14 首页文章切换
    $(document).on('click','.info_a',function () {
        var n=$(this).data('val');
        $(this).addClass('active');
        $(this).siblings('.info_a').removeClass('active');
        $('.news-contain .warp').hide();
        $('.news-contain .c'+n).show()
    })
    $(document).on('click','.more-info',function () {
        window.open($('.news-top .active').attr('_href'));
    })