//公共方法
function ajaxDo(url,type,data,callback){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:url,
        data:data,
        dataType:'json',
        type:type,
        success:function (data) {
            eval(callback(data));
        }
    })
}
