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
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-inline">
                <input type="tel" name="order" lay-verify="required|number" autocomplete="off" class="layui-input" value="0">
            </div>
            <div class="layui-form-mid layui-word-aux">按从大到小排序</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">选择框</label>
            <div class="layui-input-inline">
                <select id="edit_parent_id" name="hc_id" lay-verify="required">
                    @foreach ($class_list as $key=>$vo)
                        <option value="{{$vo['hc_id']}}">{!! $vo['hc_name_format']!!}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">展示</label>
            <div class="layui-input-block">
                <input type="checkbox" name="on_show" lay-text="展示|不展示" value='1' lay-skin="switch">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">文本域</label>
            <div class="layui-input-block">
                <textarea name="content" id="textEditor" placeholder="请输入内容" class="layui-textarea"></textarea>
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
layui.use(['form','layedit','jquery'], function(){
  var form = layui.form;
  var layedit = layui.layedit;
  var $ = layui.jquery

  @if($id)
    //表单初始赋值
    form.val('edit', {
      "title": '{{$info['title']}}'
      ,"order":{{$info['order']}}
      ,"on_show": {{$info['on_show']}}
      ,"content": '{!!$info['content']!!}'
    })

    $("#edit_parent_id").val('{{$info['hc_id']}}');
    form.render('select');
  @endif

//TODO
  //上传
  layedit.set({
      uploadImage: {
        url: '/{{config('sys_conf.admin')}}/api/upload/help' //接口url
        ,type: 'post'
      }
    });

  var editor_index = layedit.build('textEditor'); //建立编辑器


  //监听提交
  form.on('submit(submitBtn)', function(data){
    data.field.content = layedit.getContent(editor_index);

    var url = '/{{config("sys_conf.admin")}}/';
    var type = '';
    if({{$id}}==0){
        url += 'HelpDetail';
        type = 'post';
    }
    else{
        url += 'HelpDetail/{{$id}}';
        type = 'put';
    }

    ajaxDo(url,type,data.field,function(data){
        if (data['code'] == '1'){
            window.location.href="/{{config('sys_conf.admin')}}/HelpDetail";
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