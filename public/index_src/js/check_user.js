/**
 * Created by admin on 2017/6/21.
 */
$(function () {
    if(!IsPC()){
        var ad_link = $_GET['ad'];
        var url = '/wap';
        if(ad_link){
            url += '/?ad='+ad_link;
        }
        location.href=url;
    }
    function IsPC() {
        var userAgentInfo = navigator.userAgent;
        var Agents = ["Android", "iPhone",
            "SymbianOS", "Windows Phone",
            "iPad", "iPod"];
        var flag = true;
        for (var v = 0; v < Agents.length; v++) {
            if (userAgentInfo.indexOf(Agents[v]) > 0) {
                flag = false;
                break;
            }
        }
        return flag;
    }

    isSafari();
    function isSafari() {
        var ua = window.navigator.userAgent;
        var r= ua.indexOf("Safari") != -1 && ua.indexOf("Version")!=-1;
        if(r){
            var url=window.location.href;
            common.ajax_jsonp($('#modal_account_safari_cookie_url').val(),'',function (rt) {
                var rt=JSON.parse(rt);
                if(rt.code=='-1'){
                    location.href=$('#modal_account_safari_url').val()+'?url='+encodeURIComponent(url);
                }
            })
        }
    }
    jsonp_user_info();
    function jsonp_user_info() {
        if($('#jsonp_get_user_info').length>0){
            common.ajax_jsonp($('#jsonp_get_user_info').val(),'',function (rt) {
                var rt=JSON.parse(rt);




                //add
                if(rt.ret_data.order_ok_count > 0 && !rt.ret_data.wechat_openid && !rt.ret_data.qrcode_show){
                    $('.m-result').show();
                    $('.m-buy-flag').show();
                }
                //add



                if(rt.ret_data.username){
                    $('.reg_li_base').hide();
                    // $('.user_li_base .user_a_base').html(rt.ret_data.username);
                    $('.user_li_base').show();
                    $('.user_a_base_1').html(rt.ret_data.username).show();

                    if($('.activity_pak_new').length>0){
                        $('.activity_pak_new').removeClass('reg_modal');
                        $('.activity_pak_new').attr('href','http://www.zhimaruanjian.com/info/975.html');
                        $('.activity_pak_new').attr('target','_blank');
                    }
                }
                if(rt.ret_data.phone){
                    if($('.user_li_base .uc-b-tip').length>0){
                        $('.user_li_base .uc-b-tip').hide();
                    }
                }
                if(rt.ret_data.user_id){
                    if($('#base_footer_user_key_shouhou').length>0) {
                        $('#base_footer_user_key_shouhou').val(rt.ret_data.user_id);
                    }
                    if($('.package_account_reg').length>0){
                        $('.package_account_reg').hide();
                    }
                }
                if(rt.ret_data.pak_show==1){
                    if($('.new-person').length>0){
                        $('.new-person').show();
                        // $('.new-person').trigger('click');
                    }
                }

                if($('.zm_m_3').length>0){
                    $('.zm_m_3').html(rt.ret_data.money)
                }
                if($('.yu-e').length>0){
                    $('.yu-e').html(rt.ret_data.money)
                }

                if($('#ucenter_money_input').length>0){
                    $('#ucenter_money_input').val(rt.ret_data.money)
                }
                if($('.ucenter_money').length>0){
                    $('.ucenter_money').html(rt.ret_data.money)
                }

            })
        }
    }

    function isContains(str, substr) {
        return str.indexOf(substr) >= 0?true:false;
    }

})