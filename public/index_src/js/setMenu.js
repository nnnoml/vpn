$(function () {
    var sum_price;
    // var red_packet_money;
    var index;
    var func = {
        init: function () {
            // func.pay_type($('.payment.sel'));
            // func.init_login_user();

        },
        accsub:function(arg1,arg2){
            var r1,r2,m;
            try{
                r1=arg1.toString().split(".")[1].length
            }catch(e){
                r1=0
            }
            try{
                r2=arg2.toString().split(".")[1].length
            }catch(e){
                r2=0
            }
            m=Math.pow(10,Math.max(r1,r2))
            return (arg1*m-arg2*m)/m
        },
        exec_price : function(){
            if(typeof sum_price == "undefined"){
                return;
            }
            var type = $(".sel").data("type");
            if(type == "alipay"){
                var show_money = sum_price;
                $(".price").html(show_money); //add
            }else{
                $(".price").html(sum_price); //add
            }
        },
        //实时计算
        exec: function () {
            var obj=$('.package_content.active');
            var url = $('#gateway').val();
            var username = $("input[name='username']").val();
            var pak_id = obj.find('.package_list.active').data('id');
            var coupon = $(".coupon_text").val();

            var add_terminal = $(".add_terminal").val();
            var type=obj.data('type');
            if(type=='add_time'){
                var num = obj.find('.package_list.active').find(".buy_num").val();
            }else {
                var num = 1;
            }

            if(!username) return false;
            var param = {
                'username': username,
                'req_type': '1',
                'exec_type': type,
                'balance_flag': 'false',
                'pak_id': pak_id,
                'coupon': coupon,
                'num': num,
                'add_terminal': add_terminal
            };
            // common.ajax_jsonp(url, param, function (rt) {
            //     common.post_tips(rt, function (obj) {
            //         var msg=obj.msg;
            //         obj = obj.ret_data;
            //         sum_price = obj.sum_price;
            //         // red_packet_money = obj.red_packet
            //         $('#is_money_input').val(obj.is_money);
            //         //计算价格
            //         if(obj.is_money==1&&type=='add_time'){

            //             $('.price').html(sum_price)
            //             //$('.pay_last').show();
            //             $('.zm_m_1').html(obj.money_last);
            //             $('.discount_ali').hide();
            //             $('.last_money').hide();
            //             // $('.zm_m_2').html(obj.money_last);
            //         }else {
            //             //$('.pay_last').hide();
            //             func.exec_price();
            //         }
            //         if(obj.is_money==1&&type=='add_time'){

            //             $('.price').html(sum_price); //add
            //             //$('.pay_last').show();
            //             $('.zm_m_1').html(obj.money_last);
            //             $('.discount_ali').hide();
            //             $('.last_money').hide();
            //             // $('.zm_m_2').html(obj.money_last);
            //         }else {
            //             // $('.pay_last').hide();
            //             func.exec_price();
            //         }
            //         if(type=='charge'){
            //             $('.last_money').hide();
            //             $('.coupon_div_activity').hide();
            //             $('.payment_list').show();
            //         }
            //         if(type=='add_time') {
            //             if (obj.activity_money > 0) {
            //                 $('.coupon_text').val(null);
            //                 $('.coupon_div_activity').hide();
            //                 $('.discount_reg_new').show();
            //                 $('.discount_reg_new a').html(obj.activity_money);
            //                 $('.payment_list').show();
            //             } else {
            //                 // $('.coupon_text').val(null);discount_coupon
            //                 if(obj.rec_price>0){
            //                     $('.discount_rec_user').show();
            //                     $('.discount_rec_user a').html(obj.rec_price);
            //                 }
            //                 if(obj.is_money==1){
            //                     $('.coupon_text').val(null);
            //                     $('.coupon_div_activity').hide();
            //                     $('.payment_list').hide();
            //                 }else {
            //                     // $('.last_money').show();
            //                     $('.coupon_div_activity').show();
            //                     $('.discount_reg_new').hide();
            //                     $('.discount_reg_new a').html(null)
            //                     $('.payment_list').show();
            //                     //如果优惠券正确,禁用优惠券
            //                     if (obj.coupon_info.code && obj.coupon_info.code == '1') {
            //                         if(obj.coupon_info.val>0){
            //                             $('.discount_coupon').show();
            //                             $('.discount_coupon a').html(obj.coupon_info.val);
            //                         }
            //                         func.lock_coupon();
            //                     }else if(obj.coupon_info.code == '2'){
            //                         // $('.discount').hide();
            //                         $('.coupon_inner').trigger('click');
            //                         $('.coupon_text').val(obj.coupon_info.coupon_num);
            //                         $('.discount_coupon').show().find('a').html(obj.coupon_info.val);
            //                         func.lock_coupon();
            //                     }
            //                     else {
            //                         if (coupon) {
            //                             layer.msg(msg);
            //                         }
            //                         func.unlock_coupon();
            //                     }
            //                     if($('.package_content.active').data('coupon') == 'off'){
            //                     }else{
            //                         $('.coupon_div_activity').show()
            //                     }
            //                 }

            //             }
            //         }
            //         //返回的套餐信息
            //         func.enable_pay(obj);
            //     }, function (obj) {
            //         //func.disable_pay();
            //         layer.msg(obj.msg);
            //         if(type=='add_time') {
            //             if (coupon) {
            //                 func.unlock_coupon();
            //             }
            //         }
            //     })
            // }, true, [0.1, '#eee'])
        },
        //禁用优惠券
        lock_coupon: function () {
            $(".coupons_ok").hide();
            $(".pay_cancel").show();
            $(".coupons_cancel").show();
            $(".coupon_text").prop('readonly',true);
        },
        //禁用优惠券
        unlock_coupon: function () {
            $(".pay_cancel").hide();
            $(".coupons_ok").show();
            $(".coupon_text").val(null).prop('readonly',false);
            // $("#top_up").val('');
        },
        //支付可用
        enable_pay: function () {
            $('.pay_can').show();
            $('.pay_not').hide();
        },
        //支付可用
        disable_pay: function () {
            $('.pay_not').show();
            $('.pay_can').hide();
        },
        //根据支付类型,改变相关按钮选项
        pay_type: function (o) {
            switch (o.data('type')) {
                case "alipay":
                    $('.payment').removeClass('sel').removeClass('payment_act1').removeClass('payment_act2').removeClass('payment_act3');
                    o.addClass('payment_act1').addClass('sel');
                    $("#pay_btn").attr('type', 'submit');
                    break;

                case "wechat":
                    $('.payment').removeClass('sel').removeClass('payment_act1').removeClass('payment_act2').removeClass('payment_act3');
                    o.addClass('payment_act2').addClass('sel');
                    $("#pay_btn").attr('type', 'button');
                    break;

                case "under_line":
                    $('.payment').removeClass('sel').removeClass('payment_act1').removeClass('payment_act2').removeClass('payment_act3');
                    o.addClass('payment_act3').addClass('sel');
                    $("#pay_btn").attr('type', 'button');
                    $("#pay_btn").attr('type', 'submit');
                    break;
                default:
                    layer.msg('支付方式不存在')
            }
        },
        // //获取登录用户信息
        // init_login_user: function () {
        //     var url = $("#get_login_user").val();
        //     common.ajax_jsonp(url, false, function (rt) {
        //         common.post_tips(rt, function (obj) {

        //             $("input[name='username']").val(obj.ret_data.username);
        //             $('#is_login').val(1);
        //             func.exec();
        //         }, function () {
        //             $('.package_content .old_user:eq(2)').show();
        //             $('.package_content .old_user:eq(3)').show();
        //             $('#is_login').val(0);
        //         });
        //     })
        // },
        //改变用户的时候
        change_user: function () {
            func.exec();
        },
        //下单
        order: function () {
            var obj=$('.package_content.active');
            var type = $('.payment.sel').data('type');
            var url = $('#gateway').val();
            var username = $("input[name='username']").val();
            var pak_id = obj.find('.package_list.active').data('id');
            var coupon = $(".coupon_text").val();
            var dtype=obj.data('type');
            if(dtype=='add_time'){
                var num = obj.find('.package_list.active').find(".buy_num").val();
            }else {
                var num = 1;
            }
            var add_terminal = $(".add_terminal").val();

            var param = {
                username: username,
                req_type: '2',
                exec_type: dtype,
                pak_id: pak_id,
                coupon: coupon,
                num: num,
                add_terminal: add_terminal,
                plat:'web',
            };
            var is_money_input=$('#is_money_input').val();
            if(is_money_input=='1'){
                common.ajax_jsonp(url, param, function (rt) {
                    common.post_tips(rt, function (obj) {
                        if(obj.ret_data.is_money==1){
                            layer.msg(obj.msg,{icon:1});
                            setTimeout(function () {
                                location.reload()

                            },2000);
                            return true;
                        }
                        var order = obj.ret_data.order;
                        if (!order) {
                            if (dtype=='add_time'&&obj.ret_data.coupon_info.code =='0') {
                                func.unlock_coupon();
                                func.exec();
                                func.order();
                            }
                            return false;
                        }
                        switch (type) {
                            case 'alipay':
                                if(dtype=='add_time'){
                                    window.open($("#alipay_url").val() + '?order=' + order);
                                }else if (dtype=='charge') {
                                    window.open($("#money_alipay_url").val() + '?order=' + order);
                                }
                                return false;
                                // $("#order_form_none").attr('action', $("#alipay_url").val() + '?order=' + order);
                                // $('#order_form_none').submit();
                                break;
                            case 'wechat':

                                func.wechat_pay(order,dtype);


                                break;
                            case 'under_line':
                                $("#order_form").attr("action", '/under_line?order=' + order);
                                break;
                        }
                    }, function (obj) {
                        layer.msg(obj.msg);
                    });
                }, true, [0.1, '#eee']);
            }else {
                common.ajax_post(url, param,false, function (rt) {
                    common.post_tips(rt, function (obj) {
                        if(obj.ret_data.is_money==1){
                            layer.msg(obj.msg,{icon:1});
                            setTimeout(function () {
                                location.reload()

                            },2000);
                            return true;
                        }
                        var order = obj.ret_data.order;
                        if (!order) {
                            if (dtype=='add_time'&&obj.ret_data.coupon_info.code =='0') {
                                func.unlock_coupon();
                                func.exec();
                                func.order();
                            }
                            return false;
                        }
                        switch (type) {
                            case 'alipay':
                                if(dtype=='add_time'){
                                    window.open($("#alipay_url").val() + '?order=' + order);


                                }else if (dtype=='charge') {
                                    window.open($("#money_alipay_url").val() + '?order=' + order);
                                }
                                return false;
                                // $("#order_form_none").attr('action', $("#alipay_url").val() + '?order=' + order);
                                // $('#order_form_none').submit();
                                break;
                            case 'wechat':

                                func.wechat_pay(order,dtype);


                                break;
                            case 'under_line':
                                $("#order_form").attr("action", '/under_line?order=' + order);
                                break;
                        }
                    }, function (obj) {
                        layer.msg(obj.msg);
                    });
                }, true, [0.1, '#eee']);
            }

        },
        newWinUrl:function( url ){
            var f=document.createElement("form");
            f.setAttribute("action" , url );
            f.setAttribute("method" , 'get' );
            f.setAttribute("target" , '_blank' );
            document.body.appendChild(f)
            f.submit();
        },
        //微信支付
        wechat_pay: function (order,dtype) {
            layer.closeAll();
            //获取微信二维码url
            if(dtype=='add_time'){
                var url=$('#get_qrcode_url').val();
            }else if (dtype=='charge'){
                var url=$('#get_qrcode_money_url').val();
            } else {
                return false;
            }
            var param = {
                order: order
            };
            common.ajax_jsonp(url, param, function (rt) {
                layer.closeAll();
                common.post_tips(rt, function (obj) {
                    func.start_scan(order,dtype);
                    var url = obj.ret_data.url;
                    $('.layer_weixin img').attr('src',url);
                    layer_weixin();
                }, function (obj) {
                    layer.msg(obj.msg);
                });

            });
        },
        //开始扫描
        start_scan: function (order,dtype) {
            if(dtype=='add_time'){
                var url = $('#get_order_pay_status').val();

            }else if (dtype=='charge'){
                var url = $('#get_money_order_pay_status').val();

            } else {
                return false;
            }


            index = window.setInterval(function () {
                common.ajax_jsonp(url, {'order': order}, function (rt) {
                    common.post_tips(rt, function (obj) {
                        layer.closeAll();
                        func.stop_scan();


                        if(dtype=='add_time'){
                            if(obj.code==1){

                                location.href='/pay_result/success.html?out_trade_no='+order;

                                //add
                                //window.location.reload();
                                // location.href='/ucenter/#info';
                                //add

                            }else {
                                location.href='/pay_result/fail.html';
                            }
                        }else {
                            if(obj.code==1){
                                $('.layer_weixin').fadeOut();
                                layer.msg('充值成功',{icon:1});
                                setTimeout(function () {
                                    location.href='/ucenter/'
                                },2000)
                            }
                        }

                    }, function () {
                        console.log('扫描订单支付状态');
                    })
                });
            }, 3000);
        },
        //停止扫描
        stop_scan: function () {
            window.clearInterval(index);
        }
    };

    $(document).on("click",".choise .item",function () {
        var index=$(this).index();
        $(this).addClass("active")
            .siblings(".item").removeClass("active");

        $(".content_inner .package_content").removeClass("active")
            .eq(index).addClass("active");
        if(index==1){
            $(".content_inner span.discount").removeClass("active");
            $('.pay_last').removeClass('active');
            $('.coupon_div_activity').hide();
            var type = $(".sel").data("type");
            $('.payment_list').show();
            if(type == "alipay"){
                $('.discount_ali').show();
            }else{
                $('.discount_ali').hide();
            }
        }
        func.exec();
    })

    //使用优惠券号
    $(document).on("click", ".use_coupons", function () {
        $(".coupons_box").hide();
        $(".coupons_block").show();
        $(".coupons_ok").show();
        $(".coupons_cancel").hide();
    });
    //优惠券改变时
    $(document).on("change", ".coupon_text", function () {
        func.exec();
    });
    $(document).on("click", ".coupons_ok", function () {
        func.exec();
    });
    //取消
    $(document).on("click", ".coupons_cancel", function () {
        func.unlock_coupon();
        func.exec();
    });
    //取消选择
    $(document).on('click', '.cancel_input', function () {
        var obj = $(this);
        obj.closest('li').find('input').val('')
    });
    //改变用户
    $(document).on('change', 'input[name="username"]', function () {
        func.change_user();
    });
    //支付方式
    $(document).on('click', '.payment', function () {
        var obj = $(this);
        func.pay_type(obj);
        func.exec();
        if(obj.data("type")=="alipay"){
            $(".entry_list > .discount_ali").show();

        }else{
            $(".entry_list > .discount_ali").hide();
        }
    });
    //支付
    $(document).on('click', '#pay_btn', function () {
        var obj = $(this);
        func.order(obj);
    });
    //改变数量
    $(document).on('change', "input[name='buy_num']", function () {
        func.exec();
    });
    //禁止提交
    $(document).on('click', '.can_not_pay', function () {
        layer.msg('您的信息有误,请修改后提交');
    });
    $(document).on("click",".pay_cancel",function(){
        $(".coupon").fadeIn();
        $(".entry_list>label").hide();
        $(this).siblings("input").removeProp("readonly").css("background-color","#fff").val("");
        func.exec();
    });
    //弹框
    var x_layer = {
        // 等高
        x_layer_ul:function x_layer_ul() {
            var x_layer_ul = $(".n_x_layer>ul").height();
            $(".n_x_layer>span").height(x_layer_ul+5);
        },
        // 弹出
        n_x_layer:function n_x_layer() {
            $(".n_x_layer>a").on("click",function(){
                $(".n_x_layer").removeClass("n_x_layer_act");
                $(".b_layer").fadeOut(500);
            })
        },
        // 弹进
        x_layer_act:function x_layer_act() {
            $(".n_x_layer").addClass("n_x_layer_act");
            $(".b_layer").fadeIn(500);
        }
    };
    x_layer.x_layer_ul();
    x_layer.n_x_layer();
    // x_layer.x_layer_act();
    function layer_weixin(){
        $(".layer_weixin").fadeIn();
        $(".weixin_inner").addClass("fadeInDown");
        $(document).on("click",".weixin_inner>span",function(){
            $(".weixin_inner").removeClass("fadeInDown");
            $(".layer_weixin").fadeOut();
            func.stop_scan();
        });
    }
    //点击选择终端数量
    $(document).on('click', '.terminal-sel', function () {
        var obj = $(this);
        $('.terminal-sel').removeClass('active');
        obj.addClass('active');
        var num = $('.terminal-sel.active').eq(0).data('num');
        if (common.empty(num)) num = 0;
        $("input[name='buy_num']").val(num);
        func.exec();
    });
    $(document).on("click",".package_content>.package_list",function(){
        if($(this).hasClass('just-show')){
            return false;
        }
        var a =  $(this).index(".package_content>.package_list");
        $(".layer_list").eq(a).removeClass("active");
        $(".package_content>.package_list").eq(a).addClass("active").siblings(".package_content>.package_list").removeClass("active");
        $(".package_content>.package_list").eq(a).find("i").addClass("active").parents(".package_content>.package_list").siblings(".package_content>.package_list").find("i").removeClass("active");
        var username=$("input[name='username']").val();
        if(username){
            func.exec();
        }
    })
    //增加数量的时候触发
    $(document).on('click', '.plus,.minus', function () {
        func.exec();
    });
























    func.init();
});

/**
 * Created by deloo on 2017/1/7.
 */
var _package=(function(){

    /*初始化*/
    function init() {
        var text=[
            "土豪请拉我一把！",
            "土豪不用剁手，快拉我！",
            "只有买买买的人生才是完整的人生！"
        ];
        $(".num-picker").each(function(){
            init_num_picker($(this));
        });
        var cus_np=init_num_picker($(".pn-num-picker"));
        var pns= init_slide_ver(".pn-slide",
            function(dom,i,is_up){
                cus_np.val(i);
                var text_dom=dom.find(".slide-btn>p"),
                    text_temp,
                    text_type=text_dom.data("type");

                if(isNaN(is_up)){
                    return;
                }
                if(is_up>0){
                    text_temp=text[1];
                    if(text_type!="up"){
                        text_dom.html("");
                        for(var i in text_temp){
                            text_dom.append("<span>"+text_temp[i]+"</span>");
                        }
                        text_dom.data("type","up");
                    }
                }
                if(is_up<0){
                    text_temp=text[2];
                    if(text_type!="down") {
                        text_dom.html("");
                        for (var i in text_temp) {
                            text_dom.append("<span>" + text_temp[i] + "</span>");
                        }
                        text_dom.data("type","down");
                    }
                }
            },
            function(dom){
                var text_dom=dom.find(".slide-btn>p");
                text_dom.data("type","common");
                text_dom.html("");
                for (var i in text[0]) {
                    text_dom.append("<span>" + text[0][i] + "</span>");
                }
            }
        );
        x_help()
        rn_height();
    }
    function x_help() {
        $("html,body").css("background","#fff");
        $(".package_span1,.meal_span").click(function(){
            $(".n_set_meal").removeClass("n_set_meal_act2");
            $(".package_span1").addClass("package_span1_act");
            $(".package_span2").removeClass("package_span2_act");
        });

        $(".package_span2,.meal_span1").click(function(){
            $(".n_set_meal").addClass("n_set_meal_act2");
            $(".package_span1").removeClass("package_span1_act");
            $(".package_span2").addClass("package_span2_act");
        });
    }
    function rn_height(){
        var a = $(".rn_li").height();
        var b = $(".rn_li2").height();
        if (a>b) {
            $(".rn_li2").height(a);
            $(".rn_li0").height(a+6);
            $(".rn_li3").height(a);
        }else if (b>a) {
            $(".rn_li").height(b);
            $(".rn_li0").height(b+6);
            $(".rn_li3").height(b);
        } else if(a=b){
            $(".rn_li3").height(a);
            $(".rn_li0").height(a+6);
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
            var con_timer,
                flag=0,
                con_delay=800;
            plus.on({
                "mousedown":function(){
                    flag=1;
                    con_timer=setInterval(function(){
                        if(!flag){
                            clearInterval(con_timer);
                        }
                        else{
                            flag+=20;
                            if(flag>=con_delay&&val<max){
                                val+=1;
                                set_val();
                            }
                        }
                    },20);
                },
                "mouseup":function(){
                    flag=0;
                    clearInterval(con_timer);
                    con_timer=null;
                },
                "mouseleave":function(){
                    flag=0;
                    clearInterval(con_timer);
                    con_timer=null;
                },
                "click":function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    if(!$(this).hasClass("disable")){
                        val+=1;
                        set_val();
                    }
                }
            });
            minus.on({
                "mousedown":function(){
                    flag=1;
                    con_timer=setInterval(function(){
                        if(!flag){
                            clearInterval(con_timer);
                        }
                        else{
                            flag+=20;
                            if(flag>=con_delay&&val>min){
                                val-=1;
                                set_val();
                            }
                        }
                    },20);
                },
                "mouseup":function(){
                    flag=0;
                    clearInterval(con_timer);
                },
                "click":function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    if(!$(this).hasClass("disable")){
                        val-=1;
                        set_val();
                    }
                }});

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

        function set_get(i){
            if(i){
                var temp =parseInt(i);
                if(!isNaN(temp)){
                    val=temp;
                }
                set_val();
            }
            return val;
        }
        return {
            val:set_get
        }
    }

    /*初始化slide picker (new)*/
    function init_slide_ver(dom,onchange,unfun){
        if(typeof(dom)=="string"){
            dom=$(dom);
        }
        if(!dom||!dom.length||dom.length<=0){
            return null;
        }
        var max=parseInt(dom.data("max")),
            min=parseInt(dom.data("min")),
            slide=dom.find(".slide-btn"),
            w=dom.outerWidth(),
            fix=slide.outerWidth()/2,
            input=dom.find("input"),
            fr_block=dom.find(".slide-front"),
            x_temp,l_temp,flag;
        if(isNaN(max)||isNaN(min)){
            return null;
        }

        init_bind();
        /*初始化&绑定事件*/
        function init_bind(){
            slide.css({
                "left":-fix
            });
            fr_block.width(0);
            $(document).on({
                "mousemove":function(e){
                    if(flag){
                        var left=l_temp+e.pageX-x_temp;
                        slide_con(left);
                    }
                },
                "mouseup":function(e){
                    if(flag){
                        flag=0;
                    }
                    if(typeof(unfun)=="function"){
                        unfun(dom);
                    }
                }
            });
            slide.on({
                "mousedown":function(e){
                    x_temp=e.pageX;
                    l_temp=parseInt(slide.css("left"));
                    flag=1;
                }
            });
        }
        /*slide滑动控制*/
        function slide_con(left){
            if(left<=-fix){
                left=-fix;
            }else if(left>=w-fix){
                left=w-fix
            }
            slide.css({
                "left":left
            });
            fr_block.width(left+fix);
            change_val();
        }
        /*数值改变控制*/
        function change_val(){
            var left=parseInt(slide.css("left"))  + fix,
                val=parseInt((max-min)*(left/w)+min),
                change_temp=val-parseInt(input.val());
            input.val(val);
            if(typeof(onchange)=="function"){
                onchange(dom,val,change_temp);
            }
        }
        /*设置&获取*/
        function set_get(i){
            i=parseInt(i);
            if(!isNaN(i)){
                if(i<min){
                    i=min;
                }
                if(i>max){
                    i=max;
                }
                var left=w*i/(max-min);
                slide_con(left);
            }
            return input.val();
        }
        return {
            val:set_get
        }
    }

    return {
        init:init
    }
})();
function GetQueryString(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  decodeURI(r[2]); return null;
}

//2017/04/15 改版
function scrollTops(){
    // $(".section>a").addClass("active");
    $(window).scroll(function () {
        $(".More_Profit>h1").addClass("fadeInDown");
        $(".More_Profit>h2").addClass("fadeInUp");
        // var a = $(".More_Profit")[0].offsetTop;
        // if (a >= $(window).scrollTop() && a < ($(window).scrollTop()+$(window).height())) {
        //
        // }
    });
}

function choice(){

}
function close(){
    $(document).on("click",".close",function(){
        $(this).prev("input").val("");
        $(".pay_not").show().siblings(".pay_can").hide();
        $(this).prev("input").removeProp("readonly").css("background-color","#fff");
        $(this).siblings(".confirms").removeClass("active");

        $(".pay_cancel").hide();
        $(".coupons_ok").show();
    });
    $(document).on("click",".coupon_inner",function(){
        $(".coupon").hide();
        $(".entry_list>label").fadeIn();
        var rec=GetQueryString('rec');
        if(rec){
            $('.coupon_text').val(rec)
        }
        $(".pay_cancel").hide();
    });
    $(document).on("click",".confirms1",function(){
        if ($(this).siblings("input").val() !=="") {
            $(this).siblings("input").attr("readonly","readonly").css("background","rgba(204, 204, 204, 0.27)");
            $(this).addClass("active");
        }
    });


    $(document).on("click",".payment",function(){
        $(this).addClass("active").siblings(".payment").removeClass("active");
        $(this).find(".iconfont").addClass("active").parent().siblings(".payment").find(".iconfont").removeClass("active");
        $(this).find(".choice_ok").addClass("active").parent().siblings(".payment").find(".choice_ok").removeClass("active");
    });
}
function hovers(){
    $("#lower_btn>.package_list").mouseenter(function(){
        var a = $(this).index("#lower_btn>.package_list");
        $(".layer_list").eq(a).addClass("active");
    });
    $("#lower_btn>.package_list").mouseleave(function(){
        $(".layer_list").removeClass("active");
    });
}
function add(){
    function adds(){
        $(document).on("click",".add",function(){
            var a = $(".price").val();
            if (a>=0) {
                a++;
                $(".price").val(a);
            }else{
                $(".price").val(0);
            }

        });
    }
    adds();


    $(document).on("click",".reduce",function(){
        var a = $(".price").val();
        if(a>1){
            a--;
            $(".price").val(a)
        }else{
            $(".price").val(1);
        }
    })
}
/*切换选项卡*/
function tabs(){


    // $(document).on("click",".container",function () {
    //     $(".choise .item").removeClass("active")
    //         .eq(1).addClass("active");
    //     $(".content_inner .package_content").removeClass("active")
    //         .eq(1).addClass("active");
    // })
}
$(function(){
    choice();
    scrollTops();
    hovers();
    close();
    add();
    //layer_weixin();
    _package.init();
    tabs();
    // open_red_packet('first');
    // //点击领红包
    // $(document).on('click','.get-red-packet',function(){
    //     var username = $('#is_login').val();  //判断登陆
    //     if(username != 1){
    //         $('.login_modal').trigger('click');
    //         return false
    //     }
    //     open_red_packet('check')
    // })
    // //点击打开红包
    // $(document).on('click','.open-red-packet',function(){
    //     var username = $('#is_login').val();  //判断登陆
    //     if(username != 1){
    //         $('.login_modal').trigger('click');
    //         return false
    //     }
    //     open_red_packet('open')
    //     $(this).addClass('animated')
    //     $(this).addClass('flip')
    //     $(".pop-up").fadeOut(2500)
    //     $(".pop-ups").fadeIn(3000)
    // })
    //
    // $(document).on('click','.red-packet-use',function () {
    //     $(".pop-ups").fadeOut()
    // })
    // $(".shut > .shut_img").click(function () {
    //     $(".pop-up").hide()
    //     $(".pop-ups").hide()
    // })
    // function open_red_packet(type) {
    //     var url = $('#open_red_packet').val()
    //     common.ajax_jsonp(url, {type: type}, function (rt) {
    //         var obj = JSON.parse(rt)
    //         if(type == 'first'){
    //             if(obj.code == '-1'){
    //                 $(".pop-up").show()
    //             }
    //             return ;
    //         }
    //         if(type == 'open') {
    //             if(obj.code == '-1'){
    //                 location.reload();
    //                 return ;
    //             }
    //         }
    //         if (obj.code == 1) {
    //             var date = obj.ret_data.expires_time;
    //             var timestamp = new Date(date).getTime(); // 毫秒级
    //             var nowTime = new Date();
    //             if(timestamp>nowTime && obj.ret_data.status == 1){
    //                 getCountDown(timestamp);
    //             }else{
    //                 $(".expires-time").html('已过期');
    //             }
    //             $('.red-packet-money').html(obj.ret_data.money);
    //             if (obj.ret_data.status == 2) {
    //                 $('.red-packet-use').html('今日红包已使用').attr('href', 'javascript:;')
    //             } else if (obj.ret_data.status == 3) {
    //                 $('.red-packet-use').html('今日红包已过期').attr('href', 'javascript:;')
    //             }
    //             if (obj.ret_data.open == -1) {
    //                 $(".pop-ups").show()
    //             } else {
    //                 $(".pop-up").show()
    //             }
    //         }
    //     },false)
    // }
    // function getCountDown(endTime){
    //     var timer = setInterval(function(){
    //         var nowTime = new Date();
    //         var t = endTime - nowTime.getTime();
    //         if(t <= 0){
    //             $(".expires-time").html('已过期');
    //             clearInterval(timer);
    //             return false;
    //         }
    //         var hour=Math.floor(t/1000/60/60%24);
    //         var min=Math.floor(t/1000/60%60);
    //         var sec=Math.floor(t/1000%60);
    //
    //         if (hour < 10) {
    //             hour = "0" + hour;
    //         }
    //         if (min < 10) {
    //             min = "0" + min;
    //         }
    //         if (sec < 10) {
    //             sec = "0" + sec;
    //         }
    //         var countDownTime = hour + ":" + min + ":" + sec;
    //         $(".expires-time").html(countDownTime);
    //     },1000);
    // }
});

$(function () {
    /*套餐抵用劵记录下拉*/
    var rec_sel=$(".coupons-sel");
    rec_sel.find(".coupons-h4").on("click",function(){
        if(!rec_sel.hasClass("active")){
            rec_sel.addClass("active");
        }
        else{
            rec_sel.removeClass("active");
        }
    });
    $(document).on("click",function(e){
        var target=$(e.target||e.toElement);
        if(!target.hasClass("coupons-sel")&&target.parents(".coupons-sel").length<=0){
            rec_sel.removeClass("active");
        }
    });
    rec_sel.find(".download-sel > li").on("click",function(){
        rec_sel.find(".coupons-h4>p").text($(this).text());
        rec_sel.removeClass("active");
        rec_sel.addClass('success')
    });

})