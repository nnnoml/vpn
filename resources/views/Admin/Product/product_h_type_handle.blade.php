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
        <legend>{{$title}}</legend>
    </fieldset>

    <form class="layui-form" action="" lay-filter="edit">
        <input type="hidden" name="id" value='{{$id}}'>
        <div class="layui-form-item">
            <label class="layui-form-label">开始时间</label>
            <div class="layui-input-inline">
                <input type="text" name="start_second" required  lay-verify="required|number" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">单位 秒</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">结束时间</label>
            <div class="layui-input-inline">
                <input type="text" name="end_second" required  lay-verify="required|number" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">单位 秒</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">单价</label>
            <div class="layui-input-inline">
                <input type="text" name="price" required  lay-verify="required|number" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">单位 元</div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="submitBtn">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

    <script>
//Demo
layui.use(['form'], function(){
  var form = layui.form;

  @if($id)
    //表单初始赋值
    form.val('edit', {
      "start_second": '{{$info['start_second']}}'
      ,"end_second":{{$info['end_second']}}
      ,"price": {{$info['price']}}
    })
  @endif

  //监听提交
  form.on('submit(submitBtn)', function(data){

    var url = '/{{config("sys_conf.admin")}}/';
    var type = '';
    if({{$id}}==0){
        url += 'ProductHType';
        type = 'post';
    }
    else{
        url += 'ProductHType/{{$id}}';
        type = 'put';
    }

    ajaxDo(url,type,data.field,function(data){
        if (data['code'] == '1'){
            window.location.href="/{{config('sys_conf.admin')}}/ProductHType";
        }else{
            layer.msg(data['msg']);
        }
    });
    return false;
  });

});
</script>
        </div>
    </div>


@endsection