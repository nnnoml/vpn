/**
 * Created by deloo on 2016/8/29.
 */
/* var qqlink=["tencent://message/?Menu=yes&amp;uin=23339392&amp;",
 "tencent://message/?Menu=yes&amp;uin=4799313&amp;"];*/
var qqlink=["http://q.url.cn/s/gL29h6m?_type=wpa"];

$(function(){
    window.$public=(function(){
        var nav;
        var scan_qr = true;
        /*初始化*/
        function init(i) {
            nav=$(".menu");
            control();
            links();
            $(".collection").click(function(){
                addFavorite();
            });
            $(".uc-b-tip").on("click",".close",function(){
                $(this).parents(".uc-b-tip").hide();
            });
            $("#show-trigger input").on("focus",function(){
                $(".modal-login.register").find(".hide").removeClass("hide");
            });
            $(document).on("click",".has-see-btn .see-btn",function(){

                $(this).toggleClass("active");
                if($(this).hasClass("active")){
                    $(this).siblings("input").prop("type","text");
                }else{
                    $(this).siblings("input").prop("type","password");
                }

            });
        }
        init();
        /*菜单*/
        function menu(i){
            nav.find("a").removeClass("active");
            if(parseInt(i)>=0){
                nav.find("a").eq(i).addClass("active");
            }
        }
        /*input */
        function control(){
            var cancel=$(".pay_li>.cancel_input");
            cancel.on("click",function(){
                $(this).prev().val("");
            });
        }
        /*link*/
        function links(){

            $(document).on("click",".logout-link",function(){
                log_out();
            });
            $(document).on("click",".sur_link,.link-swt,.link-swt",function(){
                window.open(qqlink[0]);
            });
            $(document).on("click",".extend-link",function(){
                window.open(qqlink[0]);
            });

            $("body").append(html);
            var html=$(".qq_contact");
            if(html.length>0){
                var btn=html.find("a"),
                    modal=$(".qc-modal");
                btn.on("click",function(){
                    modal.show();
                    html.addClass("hidden");
                    setTimeout(function(){
                        modal.addClass("active");
                    },300);
                });
                modal.find(".close").on("click",function(){
                    modal.removeClass("active");
                    setTimeout(function () {
                        modal.hide();
                        html.removeClass("hidden");
                    },300);
                });
                modal.find(".m-qq").on("click",function(){
                    window.open(qqlink[parseInt(Math.random()*qqlink.length)]);
                });
            }



            function log_out(){
                if($("#quit_url").length<=0){
                    return;
                }
                var url = $("#quit_url").val();
                common.ajax_jsonp(url, false, function (rt) {
                    var obj = JSON.parse(rt);
                    if (obj.code == 1) {
                       location.href='/';
                    }
                });
            }
        }
        /*cookie*/
        function cookie() {
            //写cookies
            function setCookie(name,value,day){
                var Days = parseInt(day)>=0?day:1,
                    exp = new Date();
                exp.setTime(exp.getTime() + Days*24*60*60*1000);
                document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
            }
            //读取cookies
            function getCookie(name){
                var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
                if(arr=document.cookie.match(reg))
                    return unescape(arr[2]);
                else
                    return null;
            }
            //删除cookies
            function delCookie(name){
                var exp = new Date(),
                    cval=getCookie(name);
                exp.setTime(exp.getTime() - 1);
                if(cval!=null)
                    document.cookie= name + "="+cval+";expires="+exp.toGMTString();
            }
            return{
                get:getCookie,
                set:setCookie,
                delete:delCookie
            }
        }

        /*初始化 numberpicker*/
        function  init_num_picker(dom){
            if(!dom.length){
                return;
            }
            var picker=dom,
                plus=picker.find(".plus"),
                minus=picker.find(".minus"),
                input=picker.find("input"),
                error=picker.find(".error"),
                setting=picker.data(),
                max=parseInt(setting.max),
                min=parseInt(setting.min),
                val=parseInt(setting.val),
                error_timer,
                error_max=setting.errmax,
                error_min=setting.errmin;
            if(!error_max){
                error_max="数值最大{0}"
            }
            if(!error_min){
                error_min="数值最小{0}"
            }
            error_max=error_max.replace("{0}",setting.max);
            error_min=error_min.replace("{0}",setting.min);
            init();
            /*初始化*/
            function init(){
                set_val();
                init_bind();
            }
            /*刷新显示*/
            function set_val(){
                if(val>=max){
                    if(val>max){
                        error.addClass("active").text(error_max);
                        if(error_timer){
                            clearTimeout(error_timer);
                        }
                        error_timer= setTimeout(function(){
                            error.removeClass("active");
                        },2000);
                    }
                    plus.addClass("disable");
                    val=max;
                }else{
                    plus.removeClass("disable");
                }
                if(val<=min){
                    if(val<min){
                        error.addClass("active").text(error_min);
                        if(error_timer){
                            clearTimeout(error_timer);
                        }
                        error_timer= setTimeout(function(){
                            error.removeClass("active");
                        },2000);
                    }
                    minus.addClass("disable");
                    val=min;
                }else{
                    minus.removeClass("disable");
                }
                input.val(val);
            }
            function get_input(){
                var temp =parseInt(input.val());
                if(!isNaN(temp)){
                    val=temp;
                }
                set_val();
            }
            /*事件绑定*/
            function init_bind(){
                plus.on("click",function(e){
                    if(!$(this).hasClass("disable")){
                        val+=1;
                        set_val();
                    }
                });
                minus.on("click",function(e){
                    if(!$(this).hasClass("disable")){
                        val-=1;
                        set_val();
                    }
                });
                input.on("change",function(){
                    get_input();
                });
                input.on("keyup",function(e){
                    if(e.keyCode>=49&&e.keyCode<=90||e.keyCode>=96&&e.keyCode<=111){
                        get_input();
                    }
                    if(e.keyCode==8||e.keyCode==32){
                        set_val();
                    }
                });
            }
        }

        /*添加到收藏夹*/
        function addFavorite() {
            var url = window.location;
            var title = document.title;
            var ua = navigator.userAgent.toLowerCase();
            if (ua.indexOf("360se") > -1) {
                alert("您的浏览器不支持,请按 Ctrl+D 手动收藏！");
            }
            else if (ua.indexOf("msie 8") > -1) {
                window.external.AddToFavoritesBar(url, title); //IE8
            }
            else if (document.all) {
                try{
                    window.external.addFavorite(url, title);
                }catch(e){
                    alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
                }
            }
            else if (window.sidebar) {
                window.sidebar.addPanel(title, url, "");
            }
            else {
                alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
            }
        }


        /*弹层*/
        function modal_init(dom){
            dom.find(".close").on("click",function(){
                close(dom);
            });
            dom.open=function(){
                open(dom);
            };
            dom.close=function(){
                close(dom);
            };
            function open(e){
                e.show();
                setTimeout(function(){
                    e.addClass("active");
                },50);
            }
            function close(e){
                e.removeClass("active");
                setTimeout(function(){
                    e.hide();
                },300);
            }
            return dom;
        }

        return {
            init:menu,
            num_picker:init_num_picker,
            cookie:cookie(),
            modal:modal_init
        };
    })();
    $(".num-picker").each(function(){
        $public.num_picker($(this));
    });
    var modal=$(".new-year-alert");
    if(!$public.cookie.get("newyear")){
        setTimeout(function(){
            modal.show().removeClass("active");

            setTimeout(function(){
                modal.addClass("active");
            },30);
        },600);
    }
    else{
        modal.removeClass("active").hide();
    }

    modal.on("click",".close",function(){
        modal.removeClass("active");
        $public.cookie.set("newyear","true",7);
        setTimeout(function(){
            modal.hide();
        },300);
    });
    mlogin=$public.modal($(".modal-login.login"));
    mforget=$public.modal($(".modal-login.forget_password"));
    mreg=$public.modal($(".modal-login.register"));
    maddress=$public.modal($(".modal-login.address"));
    $(document).on('click','.reg_modal',function () {
        mlogin.close();
        mforget.close();
        maddress.close();
        $('.footer_modal_reg').find(".modal_verify_reg").trigger('click');
        mreg.open();
        //get_qr_image();
        //leee 19.7.4 刷新登陆验证码
        $("#modal_footer_reg_form").find('img').trigger('click');
    })
    $(document).on('click','.login_modal',function () {
        $('#modal_footer_login_form .form-pro').removeClass('active');
        $('.footer_modal_login .with-code input').val(null);
//        $('.footer_modal_login .with-code').hide();
        mreg.close();
        mforget.close();
        mlogin.open();
        //get_qr_image();
        var username=$('#modal_footer_login_form input[name="username"]').val();
        if(username){
            common.ajax_jsonp($('#modal_account_cache_url').val(),{username:username,type:'web'},function (data) {
                data=JSON.parse(data);
                if(data.code==1){
                    $('.footer_modal_login .modal_verify_reg').trigger('click');
                    $('.footer_modal_login .with-code').show();
                }
            })
        }
    })
    $(document).on('click','.forget_modal',function () {
        mreg.close();
        mlogin.close();
        $('.footer_modal_forget').find(".modal_verify_reg").trigger('click');
        mforget.open();

        //leee 19.7.4 刷新忘记密码验证码
        $(".footer_modal_forget").find('img').trigger('click');
    });
    //新增点击收货按钮弹框
    $(document).on('click','.s-adr-btn',function () {
        mreg.close();
        mlogin.close();
        mforget.close();
        maddress.open()
    });

    //关闭弹窗停止扫描
    $(document).on("click",'.modal-main .close', function(){
        scan_qr = false;
    });
    $(document).on('click','.footer_modal_reg .get_vacode',function () {
        var verify=$('.footer_modal_reg input[name="verify"]').val();
        if(!verify){
            layer.msg('验证码不能空',{icon:2});
            return;
        }
        modal_get_phone_code(verify,$('.footer_modal_reg'));
    })
    $(document).on('click','.footer_modal_forget .get_vacode',function () {
        var verify=$('.footer_modal_forget input[name="verify"]').val();
        if(!verify){
            layer.msg('验证码不能空',{icon:2});
            return;
        }
        modal_get_code(verify);
    })
    $(document).on('click','.modal_reg_do',function () {
        modal_reg_submit();
    })
    $(document).on('click','.modal_login_do',function () {
        modal_login_submit();
    })
    $(document).on('click','.modal_forget_do',function () {
        modal_forget_submit();
    })
});

function reg_keydown() {
    if (event.keyCode == 13)
    {
        $('.modal_reg_do').trigger('click');
    }
}
function login_keydown() {
    if (event.keyCode == 13)
    {
        $('.modal_login_do').trigger('click');
    }
}
function forget_keydown() {
    if (event.keyCode == 13)
    {
        $('.modal_forget_do').trigger('click');
    }
}
function modal_get_phone_code(verify,obj_1) {
    //检查手机号是否符合规范
    var regx = /^[1][3-9][0-9]{9}$/;
    var phone = obj_1.find("input[name='phone']").val();
    if (!regx.test(phone)) {
        layer.msg('手机号格式错误',{icon:2});
        return;
    }
    var url = '/user/sms';

    ajaxDo(url,'post',{'tel':phone,verify: verify,'type':1},function(data){
        if(data['code'] == 1){
             layer.msg("获取短信验证码成功!", {icon: 1});
             obj_1.find(".modal_verify_reg").trigger('click');
             modal_time_clock(obj_1);
        }
        else{
             layer.msg(data.msg, {icon: 2});
        }
    })
    var reg = "reg";
//    common.ajax_jsonp(url, {reg: reg, phone: phone, verify: verify,verify_id:obj_1.find("input[name='modal_verify_login_id']").val()}, function (rt) {
//        common.post_tips(rt, function () {
//            layer.msg("获取短信验证码成功!", {icon: 1});
//            obj_1.find(".modal_verify_reg").trigger('click');
//            modal_time_clock(obj_1);
//        },function (obj) {
//            obj_1.find(".modal_verify_reg").trigger('click');
//            layer.msg(obj.msg,{icon:2});
//        });
//    }, true, [0.1, "#eee"]);
}

function get_qr_image()
{
    var sence = $("#qr_sence_id").val();
    scan_qr = true;
    if(!sence){
        if($("#jsonp_get_qr_image").length>0){
            common.ajax_jsonp($("#jsonp_get_qr_image").val(),'', function(rt){
                var rt = JSON.parse(rt);
                if(rt.ret_data){
                    $(".qr_image").attr('src', rt.ret_data.image);
                    $("#qr_sence_id").val(rt.ret_data.sence_id);
                    get_user_openid();
                        common.delay(function(){
                            get_user_openid();
                        },3000,1,true);

                }
            })
        }
    }
}

function get_user_openid()
{
    if(!scan_qr) return false ;
    var sence_id = $("#qr_sence_id").val();
    var url = $("#get_user_openid_url").val();
    common.ajax_jsonp(url, {sence_id:sence_id}, function(rt){
        console.log(rt);
        var rt = JSON.parse(rt);
        if(rt.code == 1){
            location.href = '/ucenter/';
        }else{
            layer.msg(rt.msg);
        }
    });
}

function modal_get_code(verify) {
        //检查手机号是否符合规范
        var regx = /^[1][3-9][0-9]{9}$|^\w{1,30}\@\w{1,20}\.[a-zA-Z]{2,10}$/;
        var num = $(".footer_modal_forget input[name='phone']").val();

        if (!regx.test(num)) {
            layer.msg('请输入正确的手机号', {icon: 2});
            return;
        }
        var url = '/user/sms';
        ajaxDo(url,'POST',{'tel':num,'verify':verify,'type':2},function(data){
            if(data['code'] == 1){
                layer.msg("获取短信验证码成功", {icon: 1});
                modal_time_clock($('.footer_modal_forget'));
            }
            else{
                $('.footer_modal_forget').find(".modal_verify_reg").trigger('click');
                layer.msg(data.msg,{icon:2});
            }
        })
}
function modal_time_clock(obj_2) {
        var modal_expire_time=60;
        obj_2.find(".vacode").addClass("disable").removeClass("get_vacode");
        obj_2.find(".vacode").html("60 秒后重试");
        modal_time_index = window.setInterval(function () {
            obj_2.find(".vacode").html(--modal_expire_time + "秒后重试");

            if (modal_expire_time == 0) {

                obj_2.find(".vacode").html('获取验证码').addClass("get_vacode").removeClass("disable");
                window.clearInterval(modal_time_index);
            }
        }, 1000)
}

function modal_reg_submit() {
    //注册提交
        if (!$("#st-conte1").is(":checked")) {
            layer.msg("请阅读并同意《软件用户注册协议》", {icon: 2});
            return;
        }
        if ($(".footer_modal_reg input[name='username']").val() == "") {
            layer.msg("用户名不能空",{icon:2});
            return;
        }
        if ($(".footer_modal_reg input[name='password']").val() == "") {
            layer.msg("密码不能空",{icon:2});
            return;
        }
        if ($(".footer_modal_reg input[name='verify']").val() == "") {
            layer.msg("验证码不能为空",{icon:2});
            return;
        }
        var param = {
            username : $(".footer_modal_reg input[name='phone']").val(),
            password : $(".footer_modal_reg input[name='password']").val(),
            verify : $(".footer_modal_reg input[name='verify']").val(),
            sms_code : $(".footer_modal_reg input[name='phone_verify']").val(),
        }
        var url = '/user/reg';
        ajaxDo(url,'POST',param,function(data){
            if(data['code'] == 1){
                location.href="/user/";
            }
            else{
                layer.msg(data.msg, {icon: 2});
                $('.footer_modal_reg').find(".modal_verify_reg").trigger('click');
            }
        });
}

function modal_login_submit() {
    //登录提交
        var username = $(".footer_modal_login input[name='username']").val();
        var password = $(".footer_modal_login input[name='password']").val();
        var verify = $(".footer_modal_login input[name='verify']").val();
        var url = $("#modal_login_do_url").val();
        if (username == "") {
            layer.msg('用户名不能为空', {icon: 2});
            return;
        }
        if (password == "") {
            layer.msg('密码不能为空', {icon: 2});
            return;
        }
        if (verify == "") {
            layer.msg('验证码不能为空', {icon: 2});
            return;
        }
        var param = $("#modal_footer_login_form").serialize();
        ajaxDo('/user/login','post',param,function(data){
            if(data.code == 1){
                location.reload();
            }
            else{
                layer.msg(data.msg,{icon:2});
            }
        })
}

//忘记密码 提交
function modal_forget_submit() {
        var account = $(".footer_modal_forget input[name='phone']").val();
        var verify = $(".footer_modal_forget input[name='verify']").val();
        var sms_code = $(".footer_modal_forget input[name='phone_verify']").val();
        var password = $(".footer_modal_forget input[name='password']").val();
        var re_password = $(".footer_modal_forget input[name='re_password']").val();

        if (account == "") {
           layer.msg('手机号不能空',{icon:2});
            return;
        }
        if (verify == "") {
            layer.msg('验证码不能空',{icon:2});
            return;
        }
        if (sms_code == "") {
            layer.msg('短信验证码不能空',{icon:2});
            return;
        }
        if(!password){
            layer.msg('密码不能空',{icon:2});
            return;
        }
        if(!re_password){
            layer.msg('确认密码不能空',{icon:2});
            return;
        }
        if(password!=re_password){
            layer.msg('两次输入的密码不一致',{icon:2});
            return;
        }

        var url = '/user/changePWD';
        ajaxDo(url,'POST',{account: account, verify: verify,sms_code:sms_code,password:password,re_password:re_password},function(data){
            if(data['code'] == 1){
                location.href='/'
            }
            else{
                layer.msg(data.msg,{icon:2});
            }
        })
}
//
//function setQQModal() {
//    var link="http://q.url.cn/s/gL29h6m?_type=wpa";
//    setTimeout(function(){
//        var modal=$(".service-modal");
//        if(modal.length>0){
//            modal.find(".sem-btn.submit").on("click",function(){
//                window.open(link);
//            });
//            modal.show();
//            setTimeout(function(){
//                modal.addClass("active");
//            },50);
//            modal.find(".close").on("click",function(){
//                modal.removeClass("active");
//                setTimeout(function(){
//                    modal.hide();
//                },300);
//            });
//        }
//        $(".header .nav a").on("click",function(){
//            modal.removeClass("active");
//            setTimeout(function(){
//                modal.hide();
//            },300);
//        });
//    },500);
//
//}
$(function(){
//    setQQModal();
    var referrer = AdGetQueryString('referrer');
    if(referrer) {
        $('#referrer').val(referrer)
        $('.reg_modal').trigger('click')
    }
});

function AdGetQueryString(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  decodeURI(r[2]); return null;
}
