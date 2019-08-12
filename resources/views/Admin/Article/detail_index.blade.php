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
            <a href="/{{config('sys_conf.admin')}}/ArticleDetail/create"><button type="button" class="layui-btn"><i class="layui-icon layui-icon-add-1"></i> 添加文章</button></a>
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
                    <th>标题</th>
                    <th>分类</th>
                    <th>发布时间</th>
                    <th>浏览量</th>
                    <th>排序</th>
                    <th>是否展示</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($res['list'] as $key=>$vo)
                <tr a_id="{{$vo['id']}}">
                    <td>{{$vo['id']}}</td>
                    <td>{{$vo['title']}}</td>
                    <td>{{$vo['ac_name']}}</td>
                    <td>{{$vo['created_at']}}</td>
                    <td>{{$vo['view_count']}}</td>
                    <td>{{$vo['order']}}</td>
                    <td>@if($vo['on_show'])展示 @else 不展示 @endif</td>
                    <td>
                        <a href="/{{config('sys_conf.admin')}}/ArticleDetail/{{$vo['id']}}/edit"><button type="button" class="edit layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon layui-icon-edit"></i>编辑</button></a>
                        <button type="button" class="del layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon layui-icon-delete"></i>删除</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div id="page"></div>

    </div>
</div>

<script>
  layui.use(['form','layer','jquery','laypage'], function(){
      var form = layui.form;
      var $ = layui.jquery;
      var layer = layui.layer;
      var laypage = layui.laypage;

        $(".del").click(function(){
            ac_id = $(this).parent().parent().attr('a_id');
            
            layer.confirm('确认删除？', {
              btn: ['确定','取消'] //按钮
            }, function(){
                var url = '/{{config('sys_conf.admin')}}/ArticleDetail/'+ac_id;
                ajaxDo(url,'delete',{},function(data){
                    if (data['code'] == '1'){
                        window.location.reload();
                    }else{
                        layer.msg(data['msg']);
                    }
                });
            });
        })

        //执行一个laypage实例
          laypage.render({
            elem: 'page' 
            ,count: {{$res['count']}}
            ,curr: {{$page}}
            ,limit:20
            ,jump: function(obj, first){
                if(!first){
                    window.location.href='?page='+obj.curr+'&limit='+obj.limit;
                }
            }
          });

    })
</script>
@endsection