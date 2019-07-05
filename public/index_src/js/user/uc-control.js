/**
 * Created by deloo on 2016/9/1.
 */
var model=(function(){
    //noinspection JSValidateTypes
    var modules={},/*模块*/
        actions={},/*通用操作*/
        cmd={},/*指令组*/
        call_list={},/*外部介入调用方法列表*/
        control={},/*内部控制方法*/
        page_str=["info","recharge","log","record","invite","change","open"],/*页面名称列表*/
        page_temp="",/*当前页面标志*/
        lock=false;/*页面打开标志*/

    /*构造方法*/
    function init_uc(fun){
        call_list=fun;
        init_actions();
        init_modules();
        init_control();
        init_command();
        return{
            init: init_page,
            actions:function(){
                return  actions;
            },
            modules:function(){
                return modules;
            },
            control:function(){
                return control;
            },
            lock:function(is_lock){
                lock=is_lock;
            }
        }
    }

    /*初始化command*/
    function init_command(){
        cmd={
            "info":
                function(){
                    control.open("info");
                },
            "recharge":
                function(){
                    control.open("recharge");
                },
            "log":
                function(){
                    control.open("log");
                },
            "invite":function(){
                control.open("invite");
            },
            "record":
                function(){
                    control.open("record");
                },
            "change":
                function(){
                    control.open("change");
                },
            "open":
                function(){
                    control.open("open");
                },
            "logout":
                function(){
                    actions["logout"]();
                }
        };
    }

    /*初始化modules*/
    function init_modules(){
        if(call_list["modules"]){
            $.each(call_list["modules"],function(){
                modules[this.name]=module_create(this);
            });
        }
        function module_create(obj){
            var dom=$(obj.selector);
            if(dom.length<=0){
                return null;
            }
            /*打开*/
            function open(from){
                var flag=true;
                if(typeof(obj.on_open)=="function"){
                    flag=obj.on_open(obj.name,from);
                }
                return flag!=false;
            }
            /*关闭*/
            function close(to){
                var flag=true;
                if(typeof(obj.on_close)=="function"){
                    flag=obj.on_close(obj.name,to);
                }
                return flag!=false;
            }
            return {
                name:name,
                dom:dom,
                open:open,
                close:close
            }
        }
    }

    /*初始化actions*/
    function init_actions(){
        /*基础tabs*/
        function base_tabs(selector){
            var dom=$(selector);
            /*show*/
            function show() {
                dom.show();
                setTimeout(function(){dom.addClass("active")},50);
            }
            function close(){
                dom.removeClass("active");
                setTimeout(function(){dom.hide()},50);
            }
            return {
                show:show,
                hide:close
            }
        }
        actions={
            logout:function(){
                modal({
                    title:"",
                    message:"您确定要退出吗?",
                    type:"power",/*success,power,error,info,confirm*/
                    btn:[
                        {
                            text:"确定",
                            class:"",/*danger,success,cancel*/
                            callback:function(){
                                if(call_list&&typeof(call_list["logout"])=="function"){
                                    return call_list["logout"]();
                                }
                            }
                        },
                        {
                            text:"取消",
                            class:"cancel",/*danger,success,cancel*/
                            callback:function(){
                                return true;/*是否关闭*/
                            }
                        }
                    ]
                })
            },
            confirm:function(mes,callback){
                modal({
                    title:"",
                    message:mes,
                    type:"confirm",/*success,power,error,info,confirm*/
                    btn:[
                        {
                            text:"确定",
                            class:"",/*danger,success,cancel*/
                            callback:function(dom,btn){
                                callback(true,dom);
                                return true;
                            }
                        },
                        {
                            text:"取消",
                            class:"cancel",/*danger,success,cancel*/
                            callback:function(dom,btn){
                                callback(false,dom);
                                return true;
                            }
                        }
                    ]
                })
            },
            success:function(mes,fun){
                modal({
                    title:"",
                    message:mes,
                    type:"success",/*success,power,error,info,confirm*/
                    btn:[
                        {
                            text:"确定",
                            class:"success",/*danger,success,cancel*/
                            callback:function(){
                                if(typeof(fun)=="function"){
                                    fun();
                                }
                                return true;
                            }
                        }
                    ]
                });
            },
            tips:function(mes,fun){
                modal({
                    title:"",
                    message:mes,
                    type:"info",/*success,power,error,info,confirm*/
                    btn:[
                        {
                            text:"我知道了",
                            class:"",/*danger,success,cancel*/
                            callback:function(){
                                if(typeof(fun)=="function"){
                                    fun();
                                }
                                return true;
                            }
                        }
                    ]
                });
            },
            warning:function(mes,fun){
                modal({
                    title:"",
                    message:mes,
                    type:"error",/*success,power,error,info,confirm*/
                    btn:[
                        {
                            text:"我知道了",
                            class:"",/*danger,success,cancel*/
                            callback:function(){
                                if(typeof(fun)=="function"){
                                    fun();
                                }
                                return true;
                            }
                        }
                    ]
                })
            },
            loading:base_tabs("#mt-loading"),
            error:base_tabs("#mt-error"),
            welcome:base_tabs("#mt-welcome")
        }
    }

    /*初始化control*/
    function init_control(){
        /*tabs 打开&&回调调用&&锚点设置*/
        function open(name,is_skip_on){
            if(lock){
                return;
            }
            if(page_temp==name){
                return;
            }
            if(page_str.indexOf(page_temp)>=0){
                if(!close(page_temp,name)){
                    return;
                }
            }
            var flag=is_skip_on?true:modules[name].open(page_temp);
            if(flag){
                if(page_temp){
                    hide(page_temp,true);
                }
                show(name);
            }
        }
        function close(name,to,is_skip_on){
            if(lock){
                return;
            }
            var flag;
            flag=is_skip_on?true:modules[name].close(to);
            if(flag&&!to){
                hide(name);
            }
            return flag;
        }
        function show(name){
            var temp=modules[name].dom;
            temp.show();
            setTimeout(function(){
                temp.addClass("active");
            },50);
            location.hash=name;
            page_temp=name;
            $(".cmd-item[data-cmd='"+name+"']").addClass("active");
        }
        function hide(name,lazy){
            var temp=modules[name].dom;
            if(lazy){
                temp.addClass("to-close");
                setTimeout(function(){
                    temp.removeClass("active").hide().removeClass("to-close");
                },400);
            }
            else{
                temp.removeClass("active").hide();
            }
            location.hash="";
            page_temp="";
            $(".cmd-item[data-cmd='"+name+"']").removeClass("active");
        }
        control= {
            open:open,
            close:close
        }
    }

    /*初始化页面*/
    function init_page(){
        /*设置内容块高度*/
        function set_content_height(){
            var bh=$("body").height(),
                wh=$(window).height(),
                main=$(".uc-main"),
                mh=main.outerHeight();
            if(wh>bh){
                main.height(mh+wh-bh);
            }
        }
        /*页面滚动事件触发*/
        function bind_resize_fun(){
            set_content_height();
        }
        /*绑定cmd按钮点击事件*/
        function bind_cmd(dom,e){
            var obj=dom,
                cmd_name=obj.data("cmd");
            if(cmd[cmd_name]&&typeof(cmd[cmd_name])=="function"){
                /*command 执行*/
                cmd[cmd_name]();
            }
        }
        /*默认打开 welcome&&锚点调用页面*/
        function hash_init_cmd(){
            var sh=location.hash;
            /*默认打开info*/
            sh=sh.length>0?sh.substring(1):"info";
            sh=page_str.indexOf(sh)>=0?sh:"info";
            if(sh.length>0){
                cmd[sh]();
            }
        }
        /*执行初始化*/
        !function init(){
            set_content_height();
            $(window).on("resize.uc",function(){
                bind_resize_fun();
            });
            $(document).on("click.cmd",".cmd-item",function(e){
                bind_cmd($(this),e);
            });
            hash_init_cmd();
            if(typeof(call_list.init)=="function"){
                call_list.init();
            }
        }();
    }

    return init_uc;
})();