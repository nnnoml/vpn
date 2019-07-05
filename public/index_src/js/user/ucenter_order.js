$(function () {
    var index;
    var func = {

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


            var type='';
            if($('.inform-modal a').hasClass('active1')){
                type='alipay'
            }else if($('.inform-modal a').hasClass('active2')){
                type='wechat'
            }else {
                layer.msg('请选择支付方式');
                return false;
            }


            var param = {
                uid: $('#encode_user_id').val(),
            };

                common.ajax_post($('#vip_up_order_url').val(), param,false, function (rt) {
                    common.post_tips(rt, function (obj) {
                        var order=obj.ret_data.order_id;
                        switch (type) {
                            case 'alipay':
                                window.open($("#alipay_url").val() + '?order=' + order);
                                return false;
                                break;
                            case 'wechat':

                                func.wechat_pay(order);
                                break;
                        }
                    }, function (obj) {
                        layer.msg(obj.msg);
                    });
                }, true, [0.1, '#eee']);
        },

        //微信支付
        wechat_pay: function (order,dtype) {
            layer.closeAll();
            //获取微信二维码url
            var url=$('#get_qrcode_url').val();

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
        start_scan: function (order) {
            var url = $('#get_order_pay_status').val();

            index = window.setInterval(function () {
                common.ajax_jsonp(url, {'order': order}, function (rt) {
                    common.post_tips(rt, function (obj) {
                        layer.closeAll();
                        func.stop_scan();
                            if(obj.code==1){
                                location.href='/ucenter/';
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

    $(document).on('click','.vip_order_do',function () {

        func.order();

    });
});

function layer_weixin(){
    layer.open({
        type: 1,
        shade: false,
        title: false, //不显示标题
        content: $('.layer_weixin').html(),
    });
}





