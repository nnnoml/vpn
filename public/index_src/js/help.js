/**
 * Created by admin on 2017/4/18.
 */
/*可配五角星函数*/
function help_start(num,sum){
    var index=$(".grade-active"+num);
    var width=sum*18+Math.ceil(sum-1)*15;
    index.css("width",width);
}
help_start(1,4);
help_start(2,3);
help_start(3,4);
$(function(){
    /*右侧上部高度计算*/
    function height(goal,index1,index2){
        if(index1.height()>=index2.height()){
            goal.height(index1.height()+10);
        }else{
            goal.height(index2.height()+10);
        }
    }
    height($(".part-up"),$(".left-title"),$(".right-img"));


    /*计算剩余字数*/
    function remaining_word(){
        var content=$(".feedback-area>textarea");
        var word_num=content.val().length;
        $(".numerical_calculation>span")[0].innerText=500-word_num;
        if(word_num>=500) {
            word_content = content.val().substr(0, 499);
            content.val(word_content)
        }
    }
    /*监听文字变化*/
    $('textarea').bind('input propertychange', function() {
        remaining_word()
    });
    var NUM=0;
    var se_num;
    /*五角星特效*/
    function start_fn(index,num){
            $(".start").on("click",function(){
                num++;
            });
            index.on("click",function(){
                 $(this).addClass("hover");
                 if(num==0){
                    $(".content-evaluate>a").css("display","block");
                    var index=$(this).attr("class").split(" ");
                    for(var i=0;i<index.length;i++){
                        if(index[i].substring(0,5)=="start"){
                            se_num="."+index[i];
                        }
                    }
                 }
                 if(!$('#is_score').val()){
                     // common.ajax_jsonp($('#score_url').val(),{arc_id:$('#arc_id').val(),score:$('.start .hover').index()+1},function (data) {
                     //     data=JSON.parse(data);
                     //     if(data.code=='-1'){
                     //         layer.msg(data.msg,{icon:2});
                     //     }else {
                     //         $('#is_score').val('1');
                     //     }
                     // },true,['0.1','#eee'])
                 }else {
                     layer.msg('评论过于频繁，稍后再来',{icon:2});
                     se_num='';
                     $('.content-evaluate a').hide();
                     return;
                 }

            });
                $(".grade-active").mousemove(function(){
                    if(num==0) {
                        $(this).css("background", "url('"+$('#start2_url').val()+"')")
                    }
                }).mouseout(function(){
                    $(this).css("background","")
                });

            index.mousemove(function(){
                $(this).siblings(".grade-active").removeClass("hover");
            });
            $(".start").mousemove(function(){
                index.removeClass("hover");
                $(se_num).addClass("hover");
            })
    }

    start_fn($(".grade-active"),NUM);

    //初始化，如果默认展开，则将图标展开
    var level1=$(".level-1");
    for(var i=0;i<level1.length;i++){
        if(level1.eq(i).hasClass("init-active")){
            level1.eq(i).find(".arrows1").addClass("active");
            level1.eq(i).find(".level-2").find(".arrows2").addClass("active");
        }
    }

    /*左侧导航栏点击事件（没有封装）*/
    level1.on("click",function(){
        $(this).find(".arrows1").toggleClass("active");
        $(this).find(".level-2").slideToggle();
    });

    $(".level-2").on("click",function(e){
        $(this).find(".arrows2").toggleClass("active");
        $(this).find(".level-3").slideToggle();
        $(".level-2>p").removeClass("active");
        $(".level-3>li>a").removeClass("active");
        e.stopPropagation();
        if($(this).find(".level-3").length==0){
            $(this).find("p").addClass("active");
        }
    });
    $(".level-3").on("click",function(e){
        e.stopPropagation();
    });
    $(".level-3>li>a").on("click",function(){
        $(".level-2>p").removeClass("active");
        $(".level-3>li>a").removeClass("active");
        $(this).addClass("active");
    });


    /*搜索结果页面的返回顶部*/
    $(window).scroll(function(){
        if($(window).scrollTop()>=100){
          console.log("123456");
            $(".return-top").css("display","block");
        }else{
            $(".return-top").css("display","none");
        }
    });
    $(".return-top").on("click",function(){
        $("body").animate({
            "scrollTop":0
        },1000)
    });


    /*联系客服-反馈*/
    function expand_selection(index,index2){
        index.on("click",function(){
            index.find("i").toggleClass("iconfont_hover");
            index.siblings(".select_list").toggleClass("select_list_onclick");
        });
        index2.on("click",function(){
            index.find("i").toggleClass("iconfont_hover");
            index.find("input")[0].placeholder=index.find("input").value=$(this)[0].innerHTML;
            index.siblings(".select_list").toggleClass("select_list_onclick");
            $(".cate_id").attr('data-id',$(this).data('id'));
        })
    }
    expand_selection($(".suggestion_feedback1>label"),$(".suggestion_feedback1>ul>li"));

    function comment_list(page_now) {
            var page = page_now || $("#now_page").val();
            if (!page)page = 1;

            var url = $("#get_comment_list").val();
            // common.ajax_jsonp(url, {
            //     "arc_id":$('#arc_id').val() ,
            //     "page": page
            // }, function (rt) {
            //     common.post_tips(rt, function (o_1) {
            //         $(".show-comments").html(o_1.ret_data.html);
            //         // $('#total').html(o_1.ret_data.total);
            //         if(o_1.ret_data.total>0){
            //             laypage({
            //                 cont: 'page',
            //                 pages: o_1.ret_data.pages, //通过后台拿到的总页数
            //                 curr: o_1.ret_data.current || 1, //当前页
            //                 jump: function (obj, first) { //触发分页后的回调
            //                     if (!first) { //点击跳页触发函数自身，并传递当前页：obj.curr
            //                         comment_list(obj.curr);
            //                     }
            //                 }
            //             });
            //         }
            //     })
            // })
        }
        comment_list();
    $(document).on('click','#sub_comment',function () {
        var param=$('#comment_form').serialize();
        var content=$('#content').val();
        if(!content){
            layer.msg('内容不能空',{icon:2});
            return false;
        }
        // common.ajax_jsonp($('#comment_url').val(), param, function (rt) {
        //     common.post_tips(rt, function (obj) {
        //         layer.msg(obj.msg,{icon:1});
        //         $('#content').val('');
        //        // comment_list();
        //     },function (obj) {
        //         layer.msg(obj.msg,{icon:2});
        //         return;
        //     });
        // },true,[0.1,"#eee"]);
    })
    //返回头部
    $(window).scroll(function () {
       var a = $(window).scrollTop();
       if (a > 400) {
           $(".return_top").fadeIn();
       } else {
           $(".return_top").fadeOut();
       };
   });
   $(document).on("click",".return_top",function () {
       $("body,html").animate({scrollTop: 0}, 300);
       return false;
   });
});
