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
            <a href="/{{config('sys_conf.admin')}}/Product/create"><button type="button" class="layui-btn"><i class="layui-icon layui-icon-add-1"></i> 添加产品</button></a>
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
                    <th>类型</th>
                    <th>按次类型</th>
                    <th>费用（元）</th>
                    <th>VPN 时长</th>
                    <th>描述</th>
                    <th>是否展示</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($list as $key=>$vo)
                <tr p_id="{{$vo['p_id']}}">
                    <td>{{$vo['p_id']}}</td>
                    <td>
                        @if($vo['type'] == 1) VPN
                        @else 按次
                        @endif
                    </td>
                    <td>
                        @if($vo['h_type'] == 1) 按次包次
                        @elseif($vo['h_type'] == 2) 按次包周
                        @elseif($vo['h_type'] == 3) 按次包月
                        @elseif($vo['h_type'] == 4) 按次长效可匿
                        @else
                        @endif
                    </td>
                    <td>{{$vo['money']/100}}
                        @if($vo['money_sub'])（ 充值满减 {{$vo['money_sub']/100}}）
                        @elseif($vo['money_add'])（ 充值赠送 {{$vo['money_add']/100}}）
                        @endif
                    </td>
                    <td>{{$vo['time_len_format']}}</td>
                    <td>{{$vo['desc']}}</td>
                    <td>
                        @if($vo['on_show'])展示
                        @else 不展示
                        @endif
                    </td>
                    <td>
                        {{--<button type="button" class="addson layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon layui-icon-add-1"></i>添加子分类</button>--}}
                        <a href="/{{config('sys_conf.admin')}}/Product/{{$vo['p_id']}}/edit"><button type="button" class="edit layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon layui-icon-edit"></i>编辑</button></a>
                        <button type="button" class="del layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon layui-icon-delete"></i>删除</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
  var p_id = 0;

  layui.use(['form','layer','jquery'], function(){
      var form = layui.form;
      var $ = layui.jquery;
      var layer = layui.layer;

        $(".del").click(function(){
            p_id = $(this).parent().parent().attr('p_id');
            
            layer.confirm('确认删除该产品？', {
              btn: ['确定','取消'] //按钮
            }, function(){
                var url = '/{{config('sys_conf.admin')}}/Product/'+p_id;
                ajaxDo(url,'delete','',function(data){
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