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
                <legend>修改密码</legend>
            </fieldset>
            <form class="layui-form" action="" lay-filter="example">
                <div class="layui-form-item">
                    <label class="layui-form-label">旧密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="o_pwd" lay-verify="required" autocomplete="off" placeholder="请输入旧密码" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">新密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="n_pwd" lay-verify="required" autocomplete="off" placeholder="请输入新密码" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">再次新密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="re_pwd" lay-verify="required" autocomplete="off" placeholder="再次输入新密码" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
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

      //监听提交
      form.on('submit(demo1)', function(data){

        ajaxDo('/{{config('sys_conf.admin')}}/api/changePWD','post',data.field,function(data){
            if(data.code == 1){
                window.location.reload()
            }
            else{
                layer.msg(data.msg);
            }
        })

        return false;
      });

    });
  </script>
@endsection