$(function () {
    var index;
    var func = {
        //实时计算
        exec: function () {
            var foo = $('div.package_list.active').find(".buy_num");

            var num = foo.val();
            if(num != undefined){
                var price = foo.attr('price');
                $('.price').html(num*price)
            }
            else{
                foo = $('div.package_list.active').find('h2').html();
                $('.price').html(foo)
            }
            if($('input[name="username"]').val()!=''){
                this.enable_pay();
            }
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
        //下单
        order: function () {
            var obj=$('.package_content.active');
            var type = $('.payment.sel').data('type');
            var username = $("input[name='username']").val();
            var p_id = $('.package_list.active').data('id');
            var coupon = $(".coupon_text").val();
            var num = $('.package_list.active').find(".buy_num").val();
            num == undefined ? num=1 : '';

            var param = {
                username: username,
                p_id: p_id,
                num: num,
                type:type
            };

                ajaxDo('/order/addOrder/vpn','post',param,function(data){
                    if(data.code == 1){
                        switch (type) {
                            case 'alipay':
                                window.open('/order/alipay/' + data.o_id);
                                return false;
                                break;
                            case 'wechat':
                                func.wechat_pay(data.img_url,data.o_id);
                                break;
                        }
                    }
                    else{
                        layer.msg(data.msg,{icon:0});
                    }
                },true)

        },
        //微信支付
        wechat_pay: function (img_url,o_id) {
            layer.closeAll();

            func.start_scan(o_id);
            $('.layer_weixin img').attr('src','/order/qrCode?url='+img_url);
            layer_weixin();
        },
        //开始扫描
        start_scan: function (o_id) {

            index = window.setInterval(function () {
                ajaxDo('/order/scan/'+o_id,'get',{},function(data){
                    if(data.code==1){
                        layer.closeAll();
                        func.stop_scan();
                        $('.layer_weixin').fadeOut();
                        layer.msg('充值成功',{icon:1});
                        setTimeout(function () {
                            window.location.href='/user'
                        },2000)
                    }
                })
            }, 3000);
        },
        //停止扫描
        stop_scan: function () {
            window.clearInterval(index);
        }
    };

    $(document).on("click",".choise .item",function () {
        var index=$(this).index();
        $(this).addClass("active").siblings(".item").removeClass("active");

        $(".content_inner .package_content").removeClass("active").eq(index).addClass("active");

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
    //支付方式
    $(document).on('click', '.payment', function () {
        var obj = $(this);
        func.pay_type(obj);
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
    //
    $(document).on("click",".package_content>.package_list",function(){
        if($(this).hasClass('just-show')){
            return false;
        }
        var a =  $(this).index(".package_content>.package_list");
        $(".layer_list").eq(a).removeClass("active");
        $(".package_content>.package_list").eq(a).addClass("active").siblings(".package_content>.package_list").removeClass("active");
        $(".package_content>.package_list").eq(a).find("i").addClass("active").parents(".package_content>.package_list").siblings(".package_content>.package_list").find("i").removeClass("active");

        func.exec();
    })
    //增加数量的时候触发
    $(document).on('click', '.reduce,.add', function () {
        func.exec();
    });

    //leee 19.7.10 新增
    //检测充值账户是否有输入
    $('input[name="username"]').bind('input propertychange', function(){
        if($(this).val()==''){
            func.disable_pay();
        }
        else{
            if(!isNaN($('.price').html())){
                func.enable_pay();
            }
        }
    })

});

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

function add(){
    $(document).on("click",".add",function(){
        var foo = $(this).parent().parent().find('label').eq(1).find('input');
        var a = foo.val();
        if (a>=0) {
            foo.val(parseInt(a)+1);
        }else{
            foo.val(0);
        }
    });

    $(document).on("click",".reduce",function(){
        var foo = $(this).parent().parent().find('label').eq(1).find('input');
        var a = foo.val();
        if(a>1){
            foo.val(a-1)
        }else{
            foo.val(1);
        }
    });
}

$(function(){
    close();
    add();
//    layer_weixin();
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

