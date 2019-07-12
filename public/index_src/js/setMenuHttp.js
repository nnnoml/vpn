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
    var p_id = 0;
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
                this.p_id = btn.data('pid');
        },
        //下单
        order: function (btn) {
            var p_id =this.p_id;
            var type = $("input[name='radio']:checked").val();
            ajaxDo('/order/addOrder/http','post',{'p_id':p_id,'type':type},function(data){
                if(data.code ==1){
                    switch (type) {
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
                    layer.closeAll();
                    layer.msg(data.msg, {icon: 3});
                }
            })
        },

        //微信支付
        wechat_pay: function (img_url,o_id) {
            layer.closeAll();
            func.start_scan(o_id);
            layer.confirm('请用微信扫描支付<br /><img style="width: 200px;height: 200px;" src="' + img_url + '" />', {
                title: false, btn: false, cancel: function () {
                    func.stop_scan();
                }
            });
        },
        //开始扫描
        start_scan: function (o_id) {

            index = window.setInterval(function () {
                ajaxDo('/order/scan/'+o_id,'get',{},function(data){
                    if(data.code==1){
                        layer.closeAll();
                        func.stop_scan();
                        layer.confirm("支付成功!",{title:'支付状态',skin:'layui-layer-lan',fixed:true,icon:1,btn:['确定']},function(){
                            location.href='/user';//填个人信息
                        });
                    }
                })

            }, 3000);
        },
        //停止扫描
        stop_scan: function () {
            window.clearInterval(index);
        }
    };

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
