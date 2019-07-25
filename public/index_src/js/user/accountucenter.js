/**
 * Created by 冯天元 on 2016/8/31.
 */
$(function(){
    var time_index;
    var expire_time = 120;
   var func = {
       init: function () {
           func.get_charge_recharge();
       },
       //修改密码
       edit_pwd:function(){
           var old_pwd = $("input[name='old_pwd']").val();
           //var username = $("input[name='username']").val();
           var new_pwd = $("input[name='new_pwd']").val();
           var re_pwd = $("input[name='re_pwd']").val();
           var verify = $(".verify_pwd").val();

           if(old_pwd == "" || old_pwd.length<6 || old_pwd.length>12){
               $('.old_pwd').parent('.edf-line').addClass('error');
               return;
           }
           if(new_pwd == "" || new_pwd.length<6 || new_pwd.length>12){
               $('.new_pwd').parent('.edf-line').addClass('error');
               return;
           }
           if(re_pwd == "" || re_pwd.length<6 || re_pwd.length>12){
               $('.re_pwd').parent('.edf-line').addClass('error');
               return;
           }
           if(verify == ""){
               $('.verify_pwd').parent('.edf-line').addClass('error');
               return;
           }
           var param = $("#form_edit_pwd").serialize();

           ajaxDo('/user/changePWDLogin','POST',param,function(data){
                if(data.code == 1){
                   layer.msg('修改成功',{icon:1});
                   $('#form_edit_pwd .cancel').trigger('click');
                }else{
                   layer.msg(data.msg,{icon:2});
                   $(".img_verify_password").trigger('click');
                }
           },true)

       },
       //绑定手机号
       bind_phone:function(){
           var phone = $("input[name='phone']").val();
           var verify = $(".bind_phone").val();
           if(phone == ""){
               $(".phone_error").html("*手机号不能为空")
           }
           if(verify == ""){
               $(".verify_phone_error").html("*验证码不能为空").show();
           }
           var url = $("#bind_phone_url").val();
           common.ajax_jsonp(url,{phone:phone,verify:verify},function(rt){
                 var obj = common.str2json(rt);
                if(obj.code == 1){
                    $uc.actions().success(obj.msg,function(){
                        window.location.reload();
                    });
                }else{
                    $uc.actions().warning(obj.msg);
                    $(".img_verify_phone").trigger('click');
                }
           });
       },

       //修改绑定手机号
       modify_phone:function(){
           var phone = $("input[name='phone']").val();
           var verify = $(".modify_phone").val();
           if(phone == ""){
               $(".phone_error").html("*手机号不能为空")
           }
           if(verify == ""){
               $(".verify_phone_error").html("*验证码不能为空").show();
           }
           var url = $("#modify_phone_url").val();
           common.ajax_jsonp(url,{phone:phone,verify:verify},function(rt){
               var obj = common.str2json(rt);
               if(obj.code == 1){
                   $uc.actions().success(obj.msg,function(){
                       window.location.reload();
                   });
               }else{
                   $uc.actions().warning(obj.msg);
                   $(".img_verify_phone").trigger('click');
               }
           });
       },
       bind_account:function()
       {
           var bind_username = $(".bind_username").val();
           var bind_password = $(".bind_pwd").val();

           var url = $("#bind_account_url").val();
           common.ajax_jsonp(url, {username:bind_username,password:bind_password},function(rt){
                var rt = JSON.parse(rt);
                console.log(rt);
                layer.msg(rt.msg);
                if(rt.code == 1){
                    window.location.reload();
                }
           });
       },

       //绑定邮箱
       bind_email:function(){
           var email = $("input[name='email']").val();
           var verify = $(".bind_email").val();
           if(email == ""){
               $(".email_error").html("*邮箱帐号不能为空")
           }
           if(verify == ""){
               $(".verify_email_error").html("*验证码不能为空").show();
           }
           var url = $("#bind_email_url").val();
           common.ajax_jsonp(url,{email:email,verify:verify},function(rt){
               var obj = common.str2json(rt);
               if(obj.code == 1){
                   $uc.actions().success(obj.msg,function(){
                       window.location.reload();
                   });
               }else{
                   $uc.actions().warning(obj.msg);
                   $(".img_verify_email").trigger('click');
               }
           });
       },
       save_phone: function () {
           var obj = $('.m-edit-phone');
           var url = $("#save_phone").val();
           var phone = obj.find("input[name='phone']").val();
           var phone_code = obj.find("input[name='phone_code']").val();
           var login_pass = obj.find("input[name='login_pass']").val();
           common.ajax_jsonp(url, {
               phone: phone,
               phone_code: phone_code,
               login_pass: login_pass
           }, function (rt) {
               common.post_tips(rt, function (o_2) {
                   layer.msg(o_2.msg);
                   location.reload();
               })
           }, true, [0.3, '#444'])

       },
       get_phone_code: function () {
           var obj = $('.m-edit-phone');
           //检查手机号是否符合规范
           var regx = /^[1][3-9][0-9]{9}$|^\w{1,30}\@\w{1,20}\.[a-zA-Z]{2,10}$/;
           var phone = obj.find("input[name='phone']").val();
           var verify = obj.find("input[name='verify']").val();

           if (!regx.test(phone)) {
               layer.msg("请输入正确的手机号码", {icon: 2});
               return;
           }

           if(!verify){
               layer.msg("请输入图形验证码", {icon: 2});
               return;
           }
           var url = $("#get_phone_code").val();
           var reg = "change_phone";

           common.ajax_jsonp(url, {
               reg: reg,
               phone: phone,
               verify: verify,
               username: $('#username').val()
           }, function (rt) {
               common.post_tips(rt, function () {
                   layer.msg("获取验证码成功,请将验证码填入输入框", {icon: 1});
                   func.time_clock(expire_time);
               }, function (o_1) {
                   layer.msg(o_1.msg);
                   obj.find(".img_verify").trigger("click");
               });
           }, true, [0.1, "#eee"]);
       },
       time_clock: function (expire_time) {
           var obj = $('.m-edit-phone');
           obj.find(".phone_code_btn").removeClass('get_phone_code').css('background-color', '#aaa');
           obj.find(".phone_code_btn").html(expire_time + "秒后重试");
           time_index = window.setInterval(function () {
               obj.find(".phone_code_btn").html(--expire_time + "秒后重试");
               if (expire_time == 0) {
                   obj.find(".phone_code_btn").html('获取验证码').addClass("get_phone_code").css('background-color', '#00c3ff');
                   window.clearInterval(time_index);
               }
           }, 1000)
       },
        get_charge_recharge:function (page) {
        var month = $(".tab-change .active").data('time');
        var charge_type = $(".record-sel").attr("data-type");
        if (!page) page = 1;

        var url = $("#get_recharge_list").val();

    },

   };
   func.init();
    /*充值记录下拉*/
    var rec_sel=$(".record-sel");
    rec_sel.find("h4").on("click",function(){
        if(!rec_sel.hasClass("active")){
            rec_sel.addClass("active");
        }
        else{
            rec_sel.removeClass("active");
        }
    });
    $(document).on("click",function(e){
        var target=$(e.target||e.toElement);
        if(!target.hasClass("record-sel")&&target.parents(".record-sel").length<=0){
            rec_sel.removeClass("active");
        }
    });
    rec_sel.find(".download-sel > li").on("click",function(){
        rec_sel.find("h4>span").text($(this).text());
        rec_sel.removeClass("active");
        rec_sel.attr('data-type',$(this).data('type'))
        func.get_charge_recharge();
    });
   $(document).on('focus','#form_edit_pwd input,.m-edit-phone input',function () {
       $(this).parent('.edf-line').removeClass('error');
   })
    //修改密码提交
    $(document).on("click","#edit_pwd",function(){
        func.edit_pwd();
    });

    $(document).on("click", ".tab-change span", function () {
        var obj = $(this);
        $(".tab-change .active").removeClass('active');
        obj.addClass('active');
        func.get_charge_recharge();
    });
    //选择充值方式
    $(document).on("click", ".t_sel", function () {
        var obj = $(this);
        obj.addClass('active');
        obj.removeClass('t_sel');
    });

    //绑定手机号
    $(document).on("click","#bind_phone_btn",function(){
        func.bind_phone();
    });
    //绑定账号
    $(document).on('click','#bind_account', function(){
        func.bind_account();
    });
    //修改绑定手机号
    $(document).on("click","#modify_phone_btn",function(){
        func.modify_phone();
    });
    $(document).on('click', ".get_phone_code", function () {
        func.get_phone_code();
    });

    //绑定邮箱
    $(document).on("click",".bind_email_btn",function(){
        func.bind_email();
    })
    $(document).on('click', ".m-edit-phone .ok_save", function () {
        func.save_phone();
    });

    //第一个弹窗
    $(document).on('click','.get-red',function () {
        var url = $('#get_red_status').val();
        common.ajax_jsonp(url,{},function(rt){
            var obj = JSON.parse(rt);
            if(obj.code == -1){
                $('.m-gold').show();
            }else if(obj.code == 1){
                $('.deposit-gold').show();
            }else if(obj.code == 2){
                $('.m-result').show();
            }else if(obj.code == 3){
                $('.m-result .tit .pay-text').html('');
                $('.m-result').show();
            }
        })
    })

});