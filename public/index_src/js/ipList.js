$(function() {
//    $(window).scroll(function () {
//        var a = $(window).scrollTop();
//        if (a > 25) {
//            $(".header").addClass("active");
//        } else {
//            $(".header").removeClass("active");
//        };
//    });

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
    function new_page() {
        var search_word = $('#search_word').val();
        window.location.href='/ipList?key='+encodeURI(search_word);
    }

    $(document).on('click','.search_btn',function () {
        new_page()
    })
    $(document).on('click','#export',function () {
        var search_word = $('#search_word').val();
        window.open('/ipList?key='+search_word+'&export=1')
    })
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