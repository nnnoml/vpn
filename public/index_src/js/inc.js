/**
 * Created by liuchao on 17/3/28.
 */
$(function () {
    $(document).on('click','.down-inc',function () {
        var obj=$(this);
        var url=obj.data('url');
        common.ajax_jsonp(url)
    })
})