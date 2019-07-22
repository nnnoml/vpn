@extends('Admin.app')
@section('title',$title)

@extends('Admin.Common.head')
@extends('Admin.Common.left')
@extends('Admin.Common.foot')
@section('body')

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="padding: 15px;">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>系统配置</legend>
            </fieldset>
            <form class="layui-form" action="" lay-filter="example">
                <div class="layui-form-item">
                    <label class="layui-form-label">网站标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站关键字</label>
                    <div class="layui-input-block">
                        <input type="text" name="keywords" lay-verify="required" autocomplete="off" placeholder="请输入关键字" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站描述</label>
                    <div class="layui-input-block">
                        <input type="text" name="description" lay-verify="required" autocomplete="off" placeholder="请输入描述" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">客服QQ</label>
                        <div class="layui-input-inline">
                            <input type="tel" name="qq" lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">网站联系电话</label>
                        <div class="layui-input-inline">
                            <input type="tel" name="tel" lay-verify="required|number" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">网站ICP备案</label>
                        <div class="layui-input-inline">
                            <input type="text" name="icp" lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">公司全称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="comp_name" lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">公司地址</label>
                        <div class="layui-input-inline">
                            <input type="text" name="comp_address" lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>

                <div class="layui-upload" style="margin-left:100px;">
                    <button type="button" class="layui-btn" id="test1">微信二维码 180*180</button>
                    <div class="layui-upload-list">
                        <img style="width:180px;height:180px;" class="layui-upload-img" id="demo1" src="{{$sys_conf->wechat}}">
                        <input name="wechat" type="hidden" value="{{$sys_conf->wechat}}" />
                        <p id="demoText"></p>
                    </div>
                </div>
                <div class="layui-upload" style="margin-left:100px;">
                    <button type="button" class="layui-btn" id="test3">网站logo</button>
                    <div style="width:105px;height:88px" class="layui-upload-list">
                        <img class="layui-upload-img" id="demo3" src="{{$sys_conf->logo}}">
                        <input name="logo" type="hidden" value="{{$sys_conf->logo}}" />
                        <p id="demoText3"></p>
                    </div>
                </div>

                <div class="layui-upload" style="margin-left:100px;">
                    <button type="button" class="layui-btn" id="test4">网站透明log</button>
                    <div class="layui-upload-list" >
                        <img class="layui-upload-img" style="background:#afafaf" id="demo4" src="{{$sys_conf->logo2}}">
                        <input name="logo2" type="hidden" value="{{$sys_conf->logo2}}" />
                        <p id="demoText4"></p>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
layui.use(['form', 'layedit', 'laydate','upload'], function(){
  var form = layui.form
  ,layer = layui.layer
  ,layedit = layui.layedit
  ,laydate = layui.laydate
  ,$ = layui.jquery
  ,upload = layui.upload;

 //表单初始赋值
  form.val('example', {
    "title":'{{$sys_conf->title}}'
    ,"keywords":'{{$sys_conf->keywords}}'
    ,"description":'{{$sys_conf->description}}'
    ,"qq":'{{$sys_conf->qq}}'
    ,"tel":'{{$sys_conf->tel}}'
    ,"icp":'{{$sys_conf->icp}}'
    ,"comp_name":'{{$sys_conf->comp_name}}'
    ,"comp_address":'{{$sys_conf->comp_address}}'

  })

  //监听提交
  form.on('submit(demo1)', function(data){
    ajaxDo('/{{config('sys_conf.admin')}}/api/sysConf','post',data.field,function(data){
        if(data.code == 1){
            location.reload()
        }
        else{
            layer.msg(data.msg);
        }
    })

    return false;
  });

  var uploadWechat = upload.render({
    elem: '#test1'
    ,url: '/{{config('sys_conf.admin')}}/api/upload/conf'
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo1').attr('src', result); //图片链接（base64）
      });
    }
    ,done: function(res){
      //如果上传失败
      if(res.code == 1){
        return layer.msg(res.msg);
      }
      else{
        $('#demoText').html('');
        $('input[name="wechat"]').val(res.data.src)
      }
      //上传成功
    }
    ,error: function(){
      //演示失败状态，并实现重传
      var demoText = $('#demoText');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        uploadWechat.upload();
      });
    }
  });

//logo
  var logo = upload.render({
    elem: '#test3'
    ,url: '/{{config('sys_conf.admin')}}/api/upload/conf'
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo3').attr('src', result); //图片链接（base64）
      });
    }
    ,done: function(res){
      //如果上传失败
      if(res.code == 1){
        return layer.msg(res.msg);
      }
      else{
        $('#demoText3').html('');
        $('input[name="logo"]').val(res.data.src)
      }
      //上传成功
    }
    ,error: function(){
      //演示失败状态，并实现重传
      var demoText = $('#demoText3');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        logo.upload();
      });
    }
  });


//logo2
  var logo2 = upload.render({
    elem: '#test4'
    ,url: '/{{config('sys_conf.admin')}}/api/upload/conf'
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo4').attr('src', result); //图片链接（base64）
      });
    }
    ,done: function(res){
      //如果上传失败
      if(res.code == 1){
        return layer.msg(res.msg);
      }
      else{
        $('#demoText4').html('');
        $('input[name="logo2"]').val(res.data.src)
      }
      //上传成功
    }
    ,error: function(){
      //演示失败状态，并实现重传
      var demoText = $('#demoText4');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        logo2.upload();
      });
    }
  });


});
  </script>
@endsection