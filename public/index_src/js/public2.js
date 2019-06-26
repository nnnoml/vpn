/**
 * Created by phil on 2016/5/6.
 */

var pub = {
    init: function () {
    },
    //确定提交表单,参数
    ok_submit: function (obj, param, success, fail, type) {
        type = !type ? 1 : 2;
        success = (typeof success != 'function') ? null : success;
        fail = (typeof fail != 'function') ? null : fail;

        var url = obj.data('url');
        if (!param) {
            param = obj.closest('form').serialize();
        }
        param = !param ? false : param;

        common.ajax_post(url, param, true, function (rt) {
            if (success || fail) {
                common.post_tips(rt, success, fail, type);
            }
            else {
                common.post_tips(rt);
            }
        }, true);
    },
    //根据id删除
    del_by_id: function (obj, success, fail) {
        var url = obj.data('url');
        var id = obj.data('id');
        if (!url) {
            layer.msg('删除地址错误');
            return;
        }
        if (!id) {
            layer.msg('删除条目ID不能为空');
            return;
        }
        common.ajax_post(url, {id: id}, true, function (rt) {
            common.post_tips(rt, success, fail);
        })
    },
    //根据id审核
    check_by_id: function (obj, success, fail) {
        var url = obj.data('url');
        var msg = obj.data("msg");
        if (!url) {
            layer.msg(msg+'地址错误');
            return;
        }
        common.ajax_post(url, {}, true, function (rt) {
            common.post_tips(rt, success, fail);
        })
    },
    quit: function () {
        var url = $("#admin_quit").val();
        layer.msg('请稍候..', {shade: [0.1, "#444"]});
        common.ajax_post(url, false, true, function () {
            layer.closeAll();
            layer.msg('退出成功!', {shade: [0.1, "#444"],"icon": 6});
            common.delay(function(){
                window.top.location.reload()
            },1000,1,false);
        });
    },
    delete_all: function (obj) {
        var url = obj.data('url');
        if (!url) {
            layer.msg('删除地址错误',{icon:2});
            return;
        }
        var check_audit = $('.check:checked');
        if(check_audit.length == 0) {
            layer.msg('请选择要删除的内容',{icon:2});
            return false;
        }
        var check_str = '';
        check_audit.each(function () {
            check_str += $(this).data('id') + ',';
        });
        check_str = check_str.substring(0,check_str.length-1);
        layer.confirm("您确定要批量删除选定内容?",{
            btn:["确定","取消"]
        },function(){
            common.ajax_post(url,{id:check_str},true,function(rt){
                common.post_tips(rt);
                var obj = common.str2json(rt);
                if(obj.code == 1){
                    location.replace(location);
                }
            })
        });
    },
    //翻页
    turn_page: function(obj){
        var url = location.href;
        var arr = url.split('?');
        if(arr.length>1){
            location.href = url+"&page="+obj.data("page");
        }else{
            location.href = arr[0]+"?page="+obj.data("page");
        }
    }
};
$.lay_open = function(msg,time){
    if ( !time )
    {
        time = 2;
    }
    $(".pt_layer").html(msg).fadeIn(600);
    setTimeout(function(){
        $(".pt_layer").fadeOut(600);
    },time*1000);
};

var load_index;
$.common_ajax = function(url,data,success,loading,error,before,async){
    if(typeof(async) == "undefined"){
        async = true;
    }
    $.ajax({
        url: url,
        type: 'post',
        data: data,
        dataType: 'json',
        async:async,
        beforeSend: function (){
            if(loading)
            {
                load_index = layer.open({type: 2});
            }
            if(typeof before == 'function' ){
                before();
            }
        },
        success: typeof success == 'function'?success:'',
        complete:function(){
            if ( load_index >= 0 ){
                layer.close(load_index);
            }
        },
        error: function (){
            if(typeof error == 'function' ){
                error();
            }
        }
    });
};

//退出登录
$(document).on("click", ".admin_quit", function () {
    layer.confirm("确认退出吗?", {title: false, btn: ["确认"]}, function () {
        pub.quit();
    });
});

//不可操作的按钮
$(document).on("click", ".disabled_btn", function () {
    layer.msg('该按钮不可操作', {"icon": 4});
});
//提交表单
$(document).on("click", ".ok_submit", function () {
    var obj = $(this);
    pub.ok_submit(obj, null, function () {
        window.parent.location.reload()
    }, function(){

    }, 1);
});


//按照id删除
$(document).on("click", ".del_by_id", function () {
    var obj = $(this);
    layer.confirm('确认删除吗?', {
        btn: ["删除", "返回"],
        title: false,
        closeBtn: false
    }, function () {
        pub.del_by_id(obj, function () {
            layer.msg('删除成功', {icon: 1});
            location.reload()
        }, null, 1);
    });

});

//按照id审核
$(document).on("click", ".check_by_id", function () {
    var obj = $(this);
    var msg = obj.data("msg");
    layer.confirm('确认'+msg+'吗?', {
        btn: [msg+"通过", "返回"],
        title: false,
        closeBtn: false
    }, function () {
        pub.check_by_id(obj, function () {
            layer.msg(msg+'成功', {icon: 1});
            location.reload()
        }, null, 1);
    });

});

//批量删除内容
$(document).on("click",".del_all-btn",function(){
    var obj = $(this);
    pub.delete_all(obj);
});

$(document).on("click",".page_btn",function(){
    var obj = $(this);
    pub.turn_page(obj);
});
$(document).on("click",'.page_go',function () {
    var obj=$(this);
    var page=obj.parents('ul').find('.page_num').val();
    var url='';
    $('.page_admin li a').each(function () {
        if($(this).attr('href')){
            url=$(this).attr('href');
            return false;
        }
    })
    if(url){
        var parse_url=url.split('&page=');
        location.href=parse_url[0]+'&page='+page;
    }
})

pub.init();
