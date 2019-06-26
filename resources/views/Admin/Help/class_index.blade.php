@extends('Admin.app')
@section('title',$title)

@extends('Admin.Common.head')
@extends('Admin.Common.left')
@extends('Admin.Common.foot')
@section('body')
    <style>
        .layui-form-select dl{
            max-height:150px;
        }
    </style>
<div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
        <blockquote class="layui-elem-quote">
            <button id="add" type="button" class="layui-btn"><i class="layui-icon layui-icon-add-1"></i> 添加根分类</button>
        </blockquote>

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <div class="layui-form">
            <table class="layui-table">
                <colgroup>
                    <col width="150">
                    <col width="150">
                    <col width="200">
                </colgroup>
                <thead>
                <tr>
                    <th>id</th>
                    <th>分类名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($list as $key=>$vo)
                <tr hc_id="{{$vo['hc_id']}}" hc_name="{{$vo['hc_name']}}" parent_id="{{$vo['parent_id']}}">
                    <td>{{$vo['hc_id']}}</td>
                    <td>{!! $vo['hc_name_format'] !!}</td>
                    <td>
                        {{--<button type="button" class="addson layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon layui-icon-add-1"></i>添加子分类</button>--}}
                        <button type="button" class="edit layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon layui-icon-edit"></i>编辑</button>
                        <button type="button" class="del layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon layui-icon-delete"></i>删除</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="alert" style="display:none;padding:20px;">
    <form class="layui-form" action="">
        <div class="layui-form-item" id="parent_input">
            <label class="layui-form-label">父级分类</label>
            <div class="layui-input-inline">
                <input type="text" name="parent_name" required="" readonly class="layui-input">
            </div>
        </div>

        <div class="layui-form-item" id="parent_input_edit">
            <label class="layui-form-label">父级分类</label>
            <div class="layui-input-block">
                <select id="edit_parent_id" name="parent_id" lay-verify="required">
                    <option value="0">根分类</option>
                    @foreach ($list as $key=>$vo)
                        <option value="{{$vo['hc_id']}}">{!! $vo['hc_name_format']!!}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">分类名称</label>
            <div class="layui-input-inline">
                <input type="text" name="class_name" required="" lay-verify="required" placeholder="请输入分类" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">*</div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="help">提交</button>
            </div>
        </div>
    </form>
</div>

<script>
  var post_data={
    'parent_id':0,
    'name':''};

  var type='post';
  var hc_id = 0;

  layui.use(['form','layer','jquery'], function(){
      var form = layui.form;
      var $ = layui.jquery;
      var layer = layui.layer;

        //增加总分类
        $("#add").click(function(){
            cleanAlert();
            type='post';
            layer.open({
              type:1
              ,title: false
              ,area: ['450px', '160px']
              ,shadeClose: true
              ,content: $('#alert')
            });
        })

        //增加子分类
        $(".addson").click(function(){
            cleanAlert();
            type='post';
            post_data['parent_id'] = $(this).parent().parent().attr('hc_id');
            $("#parent_input").show();
            $("#parent_input input").val($(this).parent().parent().attr('hc_name'));
            layer.open({
              type:1
              ,title: false
              ,area: ['450px', '220px']
              ,shadeClose: true
              ,content: $('#alert')
            });
        })
        //清表
        function cleanAlert(){
            hc_id = 0;
            type = '';
            post_data['parent_id'] = 0;
            post_data['name'] = '';
            $("input[name='parent_name']").val('');
            $("input[name='class_name']").val('');
            $("#parent_input").hide();
            $("#parent_input_edit").hide();
        }

        //编辑分类
        $(".edit").click(function(){
            cleanAlert();
            type='put';
            hc_id = $(this).parent().parent().attr('hc_id');
            post_data['parent_id'] = $(this).parent().parent().attr('parent_id');
            $("input[name='class_name']").val($(this).parent().parent().attr('hc_name'));
            
            $("#parent_input_edit").show();    

            layer.open({
              type:1
              ,title: false
              ,area: ['450px', '260px']
              ,shadeClose: true
              ,content: $('#alert')
              ,success: function (layero, index) {
                    $("#edit_parent_id").val(post_data['parent_id']);
                    form.render('select'); //刷新select选择框渲染
              }
            });
        })

        $(".del").click(function(){
            cleanAlert();
            type='delete';
            hc_id = $(this).parent().parent().attr('hc_id');
            
            layer.confirm('确认删除该组？ 旗下的分组也会同步删除', {
              btn: ['确定','取消'] //按钮
            }, function(){
                var url = '/{{config('sys_conf.admin')}}/HelpClass/'+hc_id;
                ajaxDo(url,type,post_data,function(data){
                    if (data['code'] == '1'){
                        window.location.reload();
                    }else{
                        layer.msg(data['msg']);
                    }
                });
            });
        })

        form.on('submit(help)',function () {
            post_data['name'] = $("input[name='class_name']").val();

            if(type=='put'){
                var url = '/{{config('sys_conf.admin')}}/HelpClass/'+hc_id;
            }
            else{
                var url = '/{{config('sys_conf.admin')}}/HelpClass';
            }

            ajaxDo(url,type,post_data,function(data){
                if (data['code'] == '1'){
                    window.location.reload();
                }else{
                    layer.msg(data['msg']);
                }
            });
            return false;
        })

    })
</script>
@endsection