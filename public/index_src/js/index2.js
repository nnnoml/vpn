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

            // 下滑滚动
            // if(scroll_lock){
            //     c_st=st;
            //     e.preventDefault();
            //     e.stopPropagation();
            //     return false;
            // }else{
            //     if(st<wh&&st>0&&st>c_st&&!scroll_lock){
            //         _b.animate({scrollTop:wh},400);
            //         scroll_lock=1;
            //         clearTimeout(lock_timer);
            //         lock_timer=setTimeout(function(){
            //             scroll_lock=0;
            //         },400);
            //     }
            //     if(st<wh&&st<c_st&&!scroll_lock){
            //         _b.animate({scrollTop:0},400);
            //         scroll_lock=1;
            //         clearTimeout(lock_timer);
            //         lock_timer=setTimeout(function(){
            //             scroll_lock=0;
            //
            //         },400);
            //     }
            // }
            // c_st=st;
        });
        _w.on("mousewheel",function(e){
            // if(scroll_lock){
            //     e.preventDefault();
            //     e.stopPropagation();
            //     return false;
            // }
        });
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
            /*城市*/
     /*   dates=[
            {name:"北京",x:662,y:270,big:1},
            {name:"上海",x:740,y:435,big:1},
            {name:"广州",x:610,y:570,big:1},
            {name:"天津",x:677,y:286,big:1},
            {name:"成都",x:486,y:440,big:1},
            // {name:"德州",x:665,y:320,active:1},
            {name:"日照",x:712,y:350,active:1},
            {name:"铜陵",x:685,y:440,active:1},
            {name:"乐山",x:480,y:460,active:1},
            {name:"辽阳",x:764,y:250,active:1},
            //{name:"连云港",x:705,y:372,active:1},
            {name:"南京",x:705,y:418,active:1,big:1},
            {name:"合肥",x:676,y:422,active:1,big:1},
            {name:"吉安",x:648,y:508,active:1},
            {name:"烟台",x:740,y:320,active:1},
            {name:"阜阳",x:652,y:402,active:1},
            //{name:"枣庄",x:680,y:368,active:1},
            {name:"丹东",x:775,y:272,active:1},
            //{name:"威海",x:748,y:322,active:1},
            //{name:"宁波",x:738,y:460,active:1},
            {name:"杭州",x:730,y:448,active:1,big:1},
            {name:"池州",x:732,y:466,active:1},
            {name:"泸州",x:494,y:472,active:1},
            {name:"济南",x:670,y:330,active:1,big:1},
            // {name:"滨州",x:676,y:321,active:1},
            //{name:"绍兴",x:733,y:450,active:1},
            //{name:"芜湖",x:695,y:434,active:1},
            // {name:"莱芜",x:685,y:340,active:1},
            {name:"金华",x:710,y:472,active:1},
            {name:"徐州",x:672,y:376,active:1,big:1},
            {name:"盐城",x:720,y:396,active:1},
            {name:"哈尔滨",x:818,y:152,active:1,big:1},
            {name:"泰州",x:716,y:404,active:1},
            {name:"池州",x:678,y:448,active:1},
            {name:"台州",x:736,y:478,active:1},
            {name:"安庆",x:666,y:457,active:1},
            {name:"兰州",x:480,y:350,active:1,big:1},
            //{name:"苏州",x:724,y:430,active:1},
           // {name:"资阳",x:486,y:450,active:1},
            //{name:"遂宁",x:502,y:440,active:1},
            {name:"景德镇",x:676,y:470,active:1},
            {name:"益阳",x:602,y:475,active:1},
            {name:"宿迁",x:690,y:382,active:1},
            // {name:"扬州",x:707,y:410,active:1},
            {name:"抚州",x:665,y:487,active:1},
            //{name:"常州",x:723,y:423,active:1},
            //{name:"珠海",x:620,y:578,active:1},
            {name:"锦州",x:249,y:739,active:1},
            // {name:"镇江",x:710,y:412,active:1},
            {name:"韶关",x:620,y:542,active:1},
            {name:"鹤壁",x:633,y:356,active:1},
            {name:"阜新",x:739,y:234,active:1},
            {name:"菏泽",x:360,y:653,active:1},
            {name:"温州",x:488,y:728,active:1,big:1},
            // {name:"淮北",x:667,y:379,active:1},
            {name:"南昌",x:652,y:476,active:1,big:1},
            {name:"沈阳",x:770,y:234,active:1,big:1},
            {name:"松原",x:792,y:168,active:1},
            //{name:"眉山",x:483,y:450,active:1},
            {name:"忻州",x:615,y:292,active:1},
            {name:"泰安",x:675,y:342,active:1},
            //{name:"嘉兴",x:734,y:445,active:1},
            //{name:"衢州",x:703,y:473,active:1},
            {name:"昆明",x:463,y:537,active:1,big:1},
            {name:"许昌",x:624,y:380,active:1},
            {name:"漳州",x:680,y:546,active:1},
            {name:"宜春",x:634,y:492,active:1},
            //{name:"萍乡",x:629,y:494,active:1},
            // {name:"鞍山",x:761,y:254,active:1},
            {name:"重庆",x:532,y:456,active:1},
            {name:"安康",x:552,y:407,active:1},
            //{name:"淄博",x:690,y:332,active:1},
            {name:"玉溪",x:455,y:550,active:1},
            // {name:"铁岭",x:775,y:231,active:1},
            {name:"南通",x:418,y:734,active:1},
            {name:"西宁",x:444,y:336,active:1,big:1},
            //{name:"宣城",x:694,y:440,active:1},
            {name:"张掖",x:424,y:290,active:1},
            {name:"晋城",x:610,y:356,active:1},

        ];*/
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

// 313 半年活动
$(function() {

  $(document).on("click",".year-close",function(e) {

    $(".half-a-year").addClass("active");
    $(".header").removeClass("year_header");
      event.stopPropagation();


      $(".header").removeClass("year_header");
      e.preventDefault();
      $(".two-year").removeClass("show").fadeOut();
  });

    $(document).on("click",".half-a-year",function () {
        window.open('/pay/?type=activity');
    });

    function init(time) {
        if(!/^\d+$/.test(time)){
            return false;
        }

        var dom = $(".count-down .time_out");
        var time_out = setInterval(function () {
            dom.html(time);
            time = time - 1;
            if(time<0){
                clearInterval(time_out);
                $(".half-a-year").addClass("active");
                $(".header").removeClass("year_header");
            }
        },1000)
    }

    init(5);
});
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