$(function() {
    $(window).scroll(function () {
        var a = $(window).scrollTop();
        if (a > 25) {
            $(".header").addClass("active");
        } else {
            $(".header").removeClass("active");
        };
    });

    $(".down-list > a.right").on({
        "mouseenter":function(){
            var dom=$(this).find(">img");
            dom.show();
            dom.addClass("active");
        },
        "mouseout":function(){
            var dom=$(this).find(">img");
            dom.hide();
            dom.removeClass("active");
        }
    })
})

$(function () {
    new_page()
    get_hot_word()
    function new_page() {
        var url = $('#search_city_list').val();
        var search_word = $('#search_word').val();

        // common.ajax_jsonp(url,{search_word:search_word},function(rt){
        //     ot = common.str2json(rt);
        //     if(ot.code == '1'){
        //         data = ot.ret_data.html
        //         $('#city-list').html(data);
        //     }
        // },function(){})
    }

    function get_hot_word() {
        var url = $('#hot_word').val();
        // common.ajax_jsonp(url,{},function(rt){
        //     ot = common.str2json(rt);
        //     if(ot.code == '1') {
        //         var data = ot.ret_data
        //         var words = '';
        //         for(var i=0;i<data.length;i++) {
        //             words += '<li class="hot_words">'+data[i].city+'</li>';
        //         }
        //         $('.hot1').after(words);
        //     }
        // })
    }

    $(document).on('click','.hot_words',function () {
        words = $(this).html();
        $('#search_word').val(words);
        new_page(1)
    })

    $(document).on('click','.search_btn',function () {
        new_page(1)
    })
    var timeoutflag = null;
    $(document).on('click','#export',function () {
        if(timeoutflag != null){
            clearTimeout(timeoutflag);
        }

        timeoutflag=setTimeout(function(){
            export_list();//此处是一个会请求远程的ajax 异步操作;
        },500);
    })

    function export_list() {
        var url = $('#export_city_list').val();
        var search_word = $('#search_word').val();

        var turnForm = document.createElement("form");
        //一定要加入到body中！！
        document.body.appendChild(turnForm);
        turnForm.method = 'post';
        turnForm.action = url;
        // turnForm.target = '_blank';
        //创建隐藏表单
        var newElement = document.createElement("input");
        newElement.setAttribute("name",'search_word');
        newElement.setAttribute("value",search_word);
        newElement.setAttribute("type",'hidden');

        turnForm.appendChild(newElement);
        // console.log(turnForm);
        turnForm.submit();
    }
});
//搜索框清空输入值
$(function () {
    $(".close_remove").click(function () {
        $("#search_word").val("")
        $(".close_remove").hide()
    })
    $("#search_word").focus(function () {
        $(".close_remove").show()
    })
})