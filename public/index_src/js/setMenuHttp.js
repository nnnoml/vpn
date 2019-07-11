var rechargeLayer = {
   pay_layer:function() {
     $(".recharge_layer").fadeIn();
     $(document).on("click",".recharge_layer>.item>.close",function() {
       $(this).parent().removeClass("active");
       $(".recharge_layer").fadeOut();
     })
   },
   // 支付弹窗
   recharge_layer:function() {
     this.pay_layer();
     $(".recharge_layer>.pay").addClass("active");
   },

}

$(function () {

    var func = {
        init:function(){

            var thisId = window.location.hash;

            if(thisId =='#recharge'){
                $("#recharge").trigger("click");
            }
            //console.log(thisId);
            if(thisId =='#buy_week'){
                $("#buy_week").trigger("click");
            }

            $(".nav").removeClass("active");
            $(".nav_buy").addClass("active");

        },
        //弹窗
        ready_order:function (btn) {
                rechargeLayer.recharge_layer();//弹出选择窗
//                var $parent = $(btn).parents('li');
//
//                var money = $parent.find(".price").html();
//                var cus_buy_nums = parseInt($parent.find('.s-nums').val());
//                var cus_time_nums = $parent.find('.time-nums').val();
//                var package_id =btn.data('id') ;
//                var buy_type =btn.data('buytype') ;
//                if (buy_type =='recharge'){
//                    money = btn.data("money");
//                }
//
//                var step_num = parseInt($parent.find('.s-reduce').data('num'));
//                cus_buy_nums =  cus_buy_nums/step_num;
//
//
//                $('#cus_time_nums').val(cus_time_nums);
//                $('#cus_buy_nums').val(cus_buy_nums);
//
//                $("#package_id").val(package_id);//套餐选择入位
//                $("#pay_money").val(money);//钱选择入位
//                $("#buy_type").val(buy_type);//购买类型选择入位   recharge or buy  套餐
//                $("#success_url").val("ucenter");//成功跳转  支付宝 用
//                success_url = $("#buy_success_url").val();
//                $("#my_package_url").val(success_url);//成功跳转  微信用
        },
        //下单
        order: function (btn) {
            var p_id =btn.data('pid');
            ajaxDo('/order','post',{'p_id':p_id},function(data){
                if(data.code ==1){
                    switch ($("#pay_type").val()) {
                        case 'alipay':
                            window.open($("#money_alipay_url").val() + '?order=' + order);
                            return false;
                            break;
                        case 'wechat':
                            func.wechat_pay(data.img_url,data.o_id);
                            break;
                    }
                }
                else{
                    layer.msg(data.msg, {icon: 3});
                }
            })
        },

        //微信支付
        wechat_pay: function (order,buy_type) {
            layer.closeAll();
            layer.load(2, {
                shade: [0.1, '#fff'] //0.1透明度的白色背景
            });
            //获取微信二维码url
            var url = $('#get_qrcode_url').val();
            var param = {
                order: order
            };
            common.ajax_jsonp(url, param, function (rt) {
                layer.closeAll();

                common.jsonp_tips(rt, function (obj) {
                    func.start_scan(order,buy_type);
                    var url = obj.url;

                    layer.confirm('请用微信扫描支付<br /><img style="width: 200px;height: 200px;" src="' + url + '" />', {
                        title: false, btn: false, cancel: function () {
                            func.stop_scan();
                        }
                    });
                }, function (obj) {

                    layer.msg(obj.msg);
                });

            });
        },
        //开始扫描
        start_scan: function (order,buy_type) {
            var url = $('#get_order_pay_status').val();
            var jump_url ='';

            if(buy_type=='recharge'){           // 余额充值
                jump_url = "/balance";
            }else if(buy_type=='buy'){
                jump_url ="/my_package";
            }else if(buy_type=='long_buy'){
                jump_url = "/long_pack_manage";
            }else{
                jump_url = $("#my_package_url").val();
            }

            index = window.setInterval(function () {
                common.ajax_jsonp(url, {'order': order}, function (rt) {
                    common.jsonp_tips(rt, function (obj) {
                        layer.closeAll();
                        func.stop_scan();
                        layer.confirm("支付成功!",{title:'支付状态',skin:'layui-layer-lan',fixed:true,icon:1,btn:['确定']},function(){
                            location.href=jump_url;//填个人信息
                        });

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

    //选择支付方式
    $("input[name='radio']").on("click",function () {

        var index=$(this);
        var num=$("input[name='radio']").index(index);

        if(num==0){
            $("#pay_type").val('alipay');//支付宝
        }else if(num==1){
            $("#pay_type").val('wechat');//微信
        }
    });

    //包周套餐 立即购买
    $(document).on('click','.act_pay,.act_pay_pc',function(){
        func.ready_order($(this));
    });

    //弹窗立即支付
    $(".go_to_pay").on('click',function () {
        func.order($(this));
    });

    //2017/7/04 新增
    $(document).on('click','.ul-1>li',function(){
      var a = $(this).index('.ul-1>li');
      $(this).addClass("active").siblings().removeClass("active");
      $('.ul-1>.move').css("left",(a*113)+"px");
      $(".pay_list>ul").eq(a).show().siblings(".pay_list>ul").hide();
      if (a==0) {
        $('.big_customer,.main_customer').show();
        $('.h1_pro').hide();
      }else {
        $('.big_customer,.main_customer').hide();
        $('.h1_pro').show();
      }
    });

    func.init();
});
