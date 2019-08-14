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
        {{-- 2019-8-14 暂时屏蔽新增 产品类型目前不可编辑--}}
        {{--<blockquote class="layui-elem-quote">--}}
            {{--<a href="/{{config('sys_conf.admin')}}/ProductHType/create"><button type="button" class="layui-btn"><i class="layui-icon layui-icon-add-1"></i> 添加产品类型</button></a>--}}
        {{--</blockquote>--}}

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
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th>单价（元）</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($list as $key=>$vo)
                <tr h_type_id="{{$vo['h_type_id']}}">
                    <td>{{$vo['h_type_id']}}</td>
                    <td>{{$vo['start_second_format']}}</td>
                    <td>{{$vo['end_second_format']}}</td>
                    <td>{{$vo['price']}}</td>
                    <td>
                        <a href="/{{config('sys_conf.admin')}}/ProductHType/{{$vo['h_type_id']}}/edit"><button type="button" class="edit layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon layui-icon-edit"></i>编辑</button></a>

                        {{-- 2019-8-14 暂时屏蔽删除 产品类型目前不可编辑--}}
                        {{--<button type="button" class="del layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon layui-icon-delete"></i>删除</button>--}}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
  layui.use(['form','layer','jquery'], function(){
      var form = layui.form;
      var $ = layui.jquery;
      var layer = layui.layer;

        $(".del").click(function(){
            var h_type_id = $(this).parent().parent().attr('h_type_id');
            
            layer.confirm('确认删除？', {
              btn: ['确定','取消'] //按钮
            }, function(){
                var url = '/{{config('sys_conf.admin')}}/ProductHType/'+h_type_id;
                ajaxDo(url,'delete',{},function(data){
                    if (data['code'] == '1'){
                        window.location.reload();
                    }else{
                        layer.msg(data['msg']);
                    }
                });
            });
        })


    })
</script>
@endsection