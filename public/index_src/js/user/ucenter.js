
var _uc=(function(){
    var modal={},
        page=[];
    function init(){
        mouse_tip("[data-tip]","tip",20,0);
        init_modal();
        init_bind();
        rest_time();
        set_main_height();
        set_logout();
        set_content_scroll();
        init_pages();
    }

    /*初始化弹层*/
    function  init_modal() {
        modal.ChangePhone=get_modal("m-edit-phone");
        modal.ResetPw=get_modal("m-edit-password");
        modal.ResetEm=get_modal("m-edit-email");
        modal.Exit=get_modal("m-uc-exit");
        modal.Loading=get_modal("loading");
        modal.SetAccount=get_modal("set-up-account");
        modal.OpenAccount=get_modal("m-open-account");//开通账户
        modal.CashCoupon=get_modal("m-cash-coupon");//提现提示
        modal.JuanCoupon=get_modal("m-juan-modal");//提现劵
        window.modal=modal;
    }
    /*初次打开页面*/
    function init_pages(){
        var name=["info","record","invite","iplist","usemoney","change","open","cash","coupons","fetch","carry","popularize"];
        $.each(name,function(){
            page[this]=$(".module."+this);
        });
        var hash;
        hash=(!window.location.hash)?"#info":window.location.hash;
        control(hash.substring(1));
    }

    /*切换页面*/
    function control(cmd){
        var menu=$(".uc-menu>a"),
            modules=$(".uc-modules .module"),
            url = window.location.toString().split("#")[0];
        if(cmd=="logout"){
            modal.Exit.open();
            return;
        }
        if(page[cmd]){
            modules.removeClass("active");
            page[cmd].addClass("active");
            menu.removeClass("active").filter("."+cmd).addClass("active");
            window.location.href=url+"#"+cmd;
            if(cmd=="info"){
                var flip=$(".flip-num");
                flip.html("");
            }
        }

    }

    /*初始化绑定*/
    function init_bind(){
        /*重置密码*/
        $(".uc-btn.change-pw").on("click",function(){
            $('.m-edit-password .edf_line input').val('');
            $('.m-edit-password .img_verify').trigger('click');
            modal.ResetPw.open();
        });
        /*修改手机号*/
        $(".uc-btn.change-phone").on("click",function(){
            $('.m-edit-phone .edf-line input').val('');
            $('.m-edit-phone .img_verify').trigger('click')
            modal.ChangePhone.open();
        });
        /*绑定创建账号*/
        $(".uc-btn.setup-account").on("click",function(){
            $('.m-edit-phone .edf-line input').val('');
            // $('.m-edit-phone .img_verify').trigger('click')
            modal.SetAccount.open();
        });
        /*绑定控制*/
        $(document).on("click","[data-cmd]",function(){
            var cmd=$(this).data("cmd");
            control(cmd);
        });
        /*退出按钮点击*/
        $(".uc-t-logout").on("click",function(){
            control("logout");
        });

    }

    /*重置高度*/
    function set_main_height(){
        var vh=$(window).height(),
            mb=$(".uc-main");
        if(vh>1000){
            mb.height(vh-200);
        }
    }
    /*初始化剩余时间*/
    function rest_time(){
        var dom=$(".uc-a-cir"),
            cir=$(".uc-a-fill"),
            val=parseInt(dom.data("pc")),
            r=parseInt(dom.data("r")),
            percent = val / 100,
            perimeter = Math.PI * 2 *r;
        cir.attr('stroke-dasharray', perimeter * percent + " " + perimeter * (1- percent));
        dom.find("span").text(val+"%");
    }
    /*设置顶部退出按钮效果*/
    function set_logout(){
        var btn=$(".uc-t-ava img"),
            nav=$(".uc-t-ava .uc-t-logout");
        /*btn.on("click",function(){
            if(nav.hasClass("active")){
                close();
            }else{
                open();
            }
        });
        $(document).on("click",function(e){
            var target=$(e.target||e.toElement);
            if(target.parents(".uc-t-ava").length<=0){
               close();
            }
        });*/
        function open(){
            nav.addClass("active");
            dynamics.animate(nav[0], {
                opacity: 1,
                scale: 1
            }, {
                type: dynamics.spring,
                frequency: 200,
                friction: 270,
                duration: 800
            })
        }
        function close(){
            nav.removeClass("active");
            dynamics.animate(nav[0], {
                opacity: 0,
                scale: 0
            }, {
                type: dynamics.easeInOut,
                duration: 300,
                friction: 100
            })
        }
    }

    /*设置内容页滚动条*/
    function set_content_scroll(){
        var content=$(".uc-modules");
        content.mCustomScrollbar({
            axis:"xy",
            theme:"ipn"
        });
    }

    /*弹层初始化*/
    function get_modal(name){
        var dom=$(".modal."+name );
        if(dom.length<=0)return;
        dom.open=function(){
            open_modal($(this));
        };
        dom.close=function(){
            close_modal($(this));
        };
        dom.find(".close").on("click",function(){
            close_modal(dom);
        });
        dom.find(".cancel").on("click",function(){
            close_modal(dom);
        });
        return dom;
        function open_modal(m){
            m.show();
            setTimeout(function(){
                m.addClass("active");
            },50);
        }
        function close_modal(m){
            m.removeClass("active");
            setTimeout(function(){
                m.hide();
            },300);
        }
    }

    /*自定义tips*/
    function mouse_tip(selector,tip,fix_x,fix_y){
        var dom,
            live_on=false;
        if(typeof(selector)=='string')
        {
            dom=$(selector);
            live_on=true;
        }
        if(typeof(selector)=="object")
        {
            dom=selector;
        }
        if(dom.length<=0)
            return;
        tip=tip?tip:"tip";
        fix_x=fix_x?parseInt(fix_x):10;
        fix_y=fix_y?parseInt(fix_y):10;
        var m_tip=$(".mouse_tip");
        if(m_tip.length<=0){
            m_tip=$("<div class='mouse_tip'></div>");
            $("body").append(m_tip);
        }
        if(live_on) {
            $(document).on("mousemove mouseleave", selector, function (e) {
                if (e.type == "mousemove") {
                    dom_show($(this),e);
                }
                else {
                    m_tip.hide();
                }

            });
        }else{
            dom.on("mousemove mouseleave", function (e) {
                if (e.type == "mousemove") {
                    dom_show($(this),e);
                }
                else {
                    m_tip.hide();
                }
            });
        }
        function dom_show(dom,e){
            var text=dom.data(tip),html="",
                top = $(document).scrollTop();
            if(!text)
                return;
            text=text.split("|");
            if(text.length>0){
                $.each(text,function(){
                    if(this.length>0){
                        html+="<br/>"+this;
                    }
                });
                html=html.replace("<br/>","");
            }
            m_tip.html(html);
            m_tip.show().css("left", e.pageX + fix_x).css("top", e.pageY - top + fix_y);
        }
    }


    /*表单错误显示*/
    function input_error_show(name,text){
        var dom=$("input[name='"+name+"']");
        if(dom.length<=0)return;
        var err_tip=dom.siblings(".error-info");
        if(err_tip.length<=0){
            err_tip=$('<div class="error-info "> <i class="iconfont">&#xe630;</i></div>');
            dom.after(err_tip);
        }
        err_tip.html('<i class="iconfont">&#xe630;</i>'+text);
        dom.addClass("error");
    }
    /*表单错误取消*/
    function input_error_hide(name,text){
        var dom=$("input[name='"+name+"']");
        if(dom.length<=0)return;
        dom.removeClass("error");
    }

    /*成功tips提示*/
    function success_tips(text,time){
        if(!time){
            time=2000
        }
        var html=$('<div class="uc-success-tip"><h6><i class="iconfont">&#xe71e;</i><span>' +
            text +
            '</span></h6></div>');
        $("body").append(html);
        setTimeout(function(){
            html.addClass("active");
            setTimeout(function(){
                html.removeClass("active");
                setTimeout(function(){
                    html.remove();
                },300);
            },time);
        },50);
    }

    return {
        init:init
    }
}());
$(function(){
    _uc.init();

    //18/7/30注释
    // $(".sp_url,.sp_code").zclip({
    //     path: $('#clip_url').val(),
    //     copy: function () {
    //         return $(this).prev().val();
    //     }
    // });
    //-------end--------

    /*新人活动*/
    new_person();
    function new_person() {
        $(document).on("click",".new-person",function () {
            $(".new-person-modal").addClass("active");
        });
        $(document).on("click",".new-person-modal .close",function () {
            $(".new-person-modal").removeClass("active");
        });
        $(document).on("click",".new-person-modal .item",function () {
            $(this).addClass("active").siblings().removeClass("active");
        });
    }
    //-------end-------

});
