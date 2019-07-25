//公共方法
function ajaxDo(url,type,data,callback,loading){

    loading && layer.load(1, {
      shade: [0.4,'#000'] //0.1透明度的白色背景
    });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:url,
        data:data,
        dataType:'json',
        type:type,
        success:function (data) {
            loading && layer.closeAll('loading');
            eval(callback(data));
        },
        error:function(){
            alert('通信失败');
            layer.closeAll('loading');
        }
    })
}