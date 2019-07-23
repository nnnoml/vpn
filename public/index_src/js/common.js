//右侧弹窗
$(function () {
    right_customer()
    //大客户客服

    $(".passageway").hover(function () {
        $(".modal-intros").show()
    },function () {
        $(".modal-intros").hide()
    })
})
function right_customer(){
    $(document).on("mouseenter",".right-customer",function () {
        $(this).find('.left-content').stop().fadeIn();
    });
    $(document).on("mouseleave",".right-customer",function () {
        $(this).find('.left-content').stop().fadeOut();
    });
    $(document).on("click",".right-customer .btn-close",function () {
        $(this).parent().fadeOut();
    })
}



