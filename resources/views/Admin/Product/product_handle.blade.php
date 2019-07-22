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
            <label class="layui-form-label">金额</label>
            <div class="layui-input-inline">
                <input type="text" name="money" lay-verify="required|number" autocomplete="off" class="layui-input" value="0">
            </div>
            <div class="layui-form-mid layui-word-aux">单位 元</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">充值满减</label>
            <div class="layui-input-inline">
                <input type="text" name="money_sub" lay-verify="number" autocomplete="off" class="layui-input" value="0">
            </div>
            <div class="layui-form-mid layui-word-aux">单位 元</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">充值赠送</label>
            <div class="layui-input-inline">
                <input type="text" name="money_add" lay-verify="number" autocomplete="off" class="layui-input" value="0">
            </div>
            <div class="layui-form-mid layui-word-aux">单位 元</div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">时长</label>
            <div class="layui-input-inline">
                <input type="text" name="time_length" lay-verify="number" autocomplete="off" class="layui-input" value="0">
            </div>
            <div class="layui-form-mid layui-word-aux">单位 秒</div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">产品类型</label>
            <div class="layui-input-block" >
                <input type="radio" name="type" value="1" lay-filter="h_type" title="VPN" checked="">
                <input type="radio" name="type" value="2" lay-filter="h_type" title="按次">
            </div>
        </div>

        <div class="layui-form-item" id="h_type" @if($info['type']==1)style="display:none;" @endif>
            <label class="layui-form-label">按次产品类型</label>
            <div class="layui-input-block">
                <input type="radio" name="h_type" value="1" title="按次扣次" checked="">
                <input type="radio" name="h_type" value="2" title="按次包周">
                <input type="radio" name="h_type" value="3" title="按次包月">
                <input type="radio" name="h_type" value="4" title="按次长效可匿">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">展示</label>
            <div class="layui-input-block">
                <input type="checkbox" name="on_show" lay-text="展示|不展示" value='1' lay-skin="switch">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">描述(产品名称)</label>
            <div class="layui-input-block">
                <textarea name="desc" id="textEditor" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
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
      "money": '{{$info['money']}}'
      ,"money_sub": '{{$info['money_sub']}}'
      ,"money_add": '{{$info['money_add']}}'
      ,"time_length": '{{$info['time_length']}}'
      ,"type": '{{$info['type']}}'
      ,"h_type": '{{$info['h_type']}}'
      ,"on_show": '{{$info['on_show']}}'
      ,"desc": '{{$info['desc']}}'
    })
  @endif

    form.on('radio(h_type)', function(data){
        if(data.value==1){
            $("#h_type").hide();
        }
        else{
            $("#h_type").show();
        }
    });

  //监听提交
  form.on('submit(submitBtn)', function(data){
    var url = '/{{config("sys_conf.admin")}}/';
    var type = '';
    if({{$id}}==0){
        url += 'Product';
        type = 'post';
    }
    else{
        url += 'Product/{{$id}}';
        type = 'put';
    }
    ajaxDo(url,type,data.field,function(data){
        if (data['code'] == '1'){
            window.location.href="/{{config('sys_conf.admin')}}/Product";
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