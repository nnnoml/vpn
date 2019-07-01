$(function () {

    var func = {
        init: function () {
            $(".nav").removeClass("active");
            $(".nav_get_api").addClass("active");
            // func.get_help_quick_list();

        },

        get_help_quick_list:function () {
            var url = $("#get_help_list_url").val();
            common.ajax_jsonp(url,{},function (rt) {
                common.jsonp_tips(rt,function(obj){
                    $("#help_quick_entrance").html(obj.html);
                },function(obj){

                })
            })

        },

        sub: function () {
            //判断是套餐 还是 余额 获取
            var package_id = $("#use_package_id").val();

            if (package_id > 0) {//套餐
                console.log('1111');
                var data_type =   $("input[name='data_type']:checked").val();//json or txt  html
                var port_type = $("input[name='port_type']:checked").val();//http or sork5
                var url = $("#get_ips").val();
                var num = $("#scrollBarTxt").html();
                // var yys = $(".demo").val();//运营商
                var yys  = $("input[name='demo']:checked").val();//运营商
                var pro_id = $(".pro_id").val();
                var city_id = $(".city_id").val();
                var line_break = $("input[name='line_break']:checked").val();//json or txt  html
                var special_break = $("#special_break").val();

                var port_bit  = $("input[name='port_bit']:checked").val();//端口位数
                var m_repeat  = $("input[name='m_repeat']:checked").val();//ip去重选择
                var region_type = $("#region_type").val();
                var pack_type = $("#use_package_type").val();  // long

                var regions = $("input:checkbox[name='many_regions']:checked").map(function(index,elem) {
                    return $(elem).val();
                }).get().join(',');

                var long_city = $("input:checkbox[name='long_city']:checked").map(function(index,elem) {
                    return $(elem).val();
                }).get().join(',');

                var params = {
                    num: num,
                    package_id: package_id,
                    type: data_type,
                    pro_id: pro_id,
                    port_type: port_type,
                    city_id: city_id,
                    yys: yys,
                    time_show:$("#st-one2").prop('checked'),
                    city_show:$("#st-one3").prop('checked'),
                    yys_show:$("#st-one4").prop('checked'),

                    manyregions:regions,
                    region_type:region_type,

                    line_break:line_break,
                    special_break:special_break,
                    port_bit:port_bit,
                    m_repeat:m_repeat,
                    pack_type:pack_type,
                    long_city:long_city,
                };
                //检测登录
                var rt = check_info_have_pase.to_login();

                if (rt == 1) {
                    common.ajax_jsonp(url, params,function (rt) {
                        common.jsonp_tips(rt,function (obj) {

                            $('#api_link').val(obj.link);
                            $('.openUrl').attr('href',obj.link);
                            $('.openUrl2').attr('href',obj.link2);
                            $('.openUrl3').attr('href',obj.link3);

                            $('#api_link2').val(obj.link2);
                            $('#api_link3').val(obj.link3);
                            console.log("------------------------------")



                        }, function (obj) {
                            layer.msg(obj.msg)
                        })
                    })
                }


            } else {//余额
                var balance = $("#balance_money").val();
                console.log(balance);
                if(balance<=0){
                    payLayer.recharge_layer2();
                    return ;
                }

                var num = $("#scrollBarTxt").html();
                var url = $("#get_ips").val();

                var time_id =   $("input[name='time_select']:checked").val();
                var data_type =   $("input[name='data_type']:checked").val();//json or txt  html
                var port_type = $("input[name='port_type']:checked").val();//http or sork5
                var yys  = $("input[name='demo']:checked").val();//运营商
                var pro_id = $(".pro_id").val();
                var city_id = $(".city_id").val();

                var line_break = $("input[name='line_break']:checked").val();//json or txt  html
                var special_break = $("#special_break").val();

                var port_bit  = $("input[name='port_bit']:checked").val();//端口位数
                var m_repeat  = $("input[name='m_repeat']:checked").val();//ip去重选择


                var region_type = $("#region_type").val();//身份单选  混选

        var  regions = $("input:checkbox[name='many_regions']:checked").map(function(index,elem) {
            return $(elem).val();
        }).get().join(',');

                var params = {
                    num: num,
                    time_id: time_id,
                    type: data_type,
                    pro_id: pro_id,
                    port_type: port_type,
                    city_id: city_id,
                    yys: yys,
                    time_show:$("#st-one2").prop('checked'),
                    city_show:$("#st-one3").prop('checked'),
                    yys_show:$("#st-one4").prop('checked'),

                    manyregions:regions,
                    region_type:region_type,


                    line_break:line_break,
                    special_break:special_break,

                    port_bit:port_bit,
                    m_repeat:m_repeat,

                }


                //检测登录
                var rt = check_info_have_pase.to_login();


                if (rt == 1) {

                    if (time_id == undefined) {
                        layer.msg('请选择时长');
                    }


                    common.ajax_jsonp(url, params,function (rt) {
                        common.jsonp_tips(rt,function (obj) {
                            console.log('=========');

                            $('#api_link').val(obj.link);
                            $('.openUrl2').attr('href',obj.link2);
                            $('.openUrl3').attr('href',obj.link3);
                            $('#api_link2').val(obj.link2);
                            $('#api_link3').val(obj.link3);
                            $('.openUrl').attr('href',obj.link);
                            // payLayer.recharge_api();

                        }, function (obj) {
                            layer.msg(obj.msg)
                        })
                    })
                }

            }


        },
        // 获取活动
        get_day_free_package:function(){
            var url  = $("#get_day_free_url").val();
            common.ajax_jsonp(url,{},function (rt) {

                common.jsonp_tips(rt,function (obj) {
                    layer.msg("领取成功")
                    $(".ok_free_btn").addClass("did")
                    $(".ok_free_btn").removeClass("ok_free_btn")
                    $("#get_free_day_package").text("今日已领免费IP")

                    checkLogin();
                }, function (obj) {
                    layer.msg(obj.msg)
                })
            })

        },




    };

    //
    $(".seclect_pack").on("click", function () {
        func.set_line($(this));
    })

    //
    $(".open").on("click", function () {
        var rr = check_info_have_pase.to_login();

        if(rr==1){
            func.sub();
        }

    })


    //首选项
    checkLogin();
    func.init();


    // 获取用户是否登录
    function checkLogin() {
    }

    //实际计算能买啥
    function get_price(obj) {
        var url = $("#get_api_price_conf").val();
        var money = obj;
        common.ajax_jsonp(url, {money: money},function (rt) {
            common.jsonp_tips(rt,function (obj) {
                $(".line2").html(obj.html);
            }, function (obj) {

            });
        });

    }


    //获取套餐信息
    function get_package_info(mid) {
        var url = $("#get_package_info_url").val();
        common.ajax_jsonp(url, {mid: mid},function (rt) {
            common.jsonp_tips(rt,function (obj) {
                $("#balance_div").after(obj.html);
                $("#package_list").after(obj.list);
            }, function (obj) {

            })
        })

    }

    //获取两条信息  get_other_api_info_url
    function get_other_api_info() {

        var url = $("#get_other_api_info_url").val();
    }

    // 检测用户登录获取用户信息  计算能买什么

    // get_ip_prcie_conf();
setTimeout(function () {
    get_other_api_info();

},200);

    $(document).on("click", ".ok_free_btn", function () {
        var rr = check_info_have_pase.to_login();

        if(rr==1){
                 func.get_day_free_package();
        }

    });



    $(".page_login").on('click', function () {
        go_to.login();
    })

});