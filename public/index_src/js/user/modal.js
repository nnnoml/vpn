/**
 * Created by deloo on 2016/8/31.
 */
/*通用modal*/
var modal=(function(){
   var modal_index=0,
    modal_dom=$('<div  class="modal "><div class="modal-main "><h4 class="title"></h4>' +
            '<span class="icon"><i class="iconfont failed">&#xe622;</i><i class="iconfont info">&#xe611;</i><i class="iconfont error">&#xe613;</i>' +
            '<i class="iconfont confirm">&#xe610;</i><i class="iconfont power">&#xe606;</i>' +
            '<i class="iconfont success">&#xe612;</i></span><p class="message"></p>' +
            '<div class="btn"></div></div></div>'),
        btn=$('<a class=""></a>'),
        z_index=1000;
    /*设置modal*/
    function set_modal(config){
        if(!config){
            config={
                title:"",
                message:"操作完成",
                type:"success",/*success,power,error,info,confirm,failed*/
                btn:[
                    {
                        text:"确定",
                        class:"",/*danger,success,cancel*/
                        callback:function(dom){
                            return true;/*是否关闭*/
                        }
                    }
                ],
                callback:function(){}
            }
        }
        var title=config.title,
            mes=config.message?config.message:"",
            type=config.type?config.type:"success",
            btns=config.btn.length>0?config.btn:[{
                text:"确定",
                class:"",
                callback:function(){
                    return true;
                }
            }],
            callback=typeof(config.callback)=="function"?config.callback:function(){};
        var dom=modal_dom.clone();
        dom.find(".title").html(title);
        dom.find(".message").html(mes);
        dom.addClass(type).css({"z-index": z_index + modal_index });
        modal_index++;
        $.each(btns,function(){
            var btn_temp=btn.clone(),
                obj_temp=this;
            btn_temp.addClass(obj_temp.class).text(obj_temp.text);
            if(typeof(obj_temp.callback)=="function"){
                btn_temp.on("click",function(){
                    var flag=obj_temp.callback(dom,this);
                    if(flag){
                        close(dom);
                    }
                });
            }
            dom.find(".btn").append(btn_temp);
        });
        $("body").append(dom);
        callback();
        return dom;
    }
    /*打开*/
    function open(dom){
        dom.show();
        setTimeout(function(){dom.addClass("active")},50);
        return dom;
    }
    /*移除*/
    function close(dom){
        dom.removeClass("active");
        setTimeout(function(){dom.remove()},300);
    }
    /*返回对象*/
    return function(config){
        open(set_modal(config));
    };
})();