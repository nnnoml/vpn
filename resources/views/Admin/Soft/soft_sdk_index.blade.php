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
            <button id="add" type="button" class="layui-btn"><i class="layui-icon layui-icon-add-1"></i> 添加SDK</button>
        </blockquote>

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <div class="layui-form">
            <table class="layui-table">
                <colgroup>
                    <col width="80">
                    <col width="300">
                    <col width="100">
                    <col width="100">
                </colgroup>
                <thead>
                <tr>
                    <th>SDK id</th>
                    <th>SDK 名称</th>
                    <th>下载次数</th>
                    <th>描述</th>
                    <th>是否上线</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($list as $key=>$vo)
                <tr>
                    <td sdk_download_url="{{$vo['sdk_download_url']}}">{{$vo['sdk_id']}}</td>
                    <td>{{$vo['sdk_name']}}</td>
                    <td>{{$vo['download_count']}}</td>
                    <td>{{$vo['desc']}}</td>
                    <td data="{{$vo['on_show']}}">@if($vo['on_show'])上线@else下线@endif</td>
                    <td>
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
    <form class="layui-form" action="" lay-filter="alert_form">

        <div class="layui-form-item">
            <label class="layui-form-label">SDK名称</label>
            <div class="layui-input-inline">
                <input type="text" name="sdk_name" required="" lay-verify="required" placeholder="请输入SDK名称" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">下载次数</label>
            <div class="layui-input-inline">
                <input type="tel" name="download_count" required="" lay-verify="required|number" placeholder="请输入下载次数" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block">
                <input type="text" name="desc" required="" lay-verify="required" placeholder="请输入SDK描述" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">下载地址</label>
            <div class="layui-input-block">
                <input type="text" name="sdk_download_url" required="" lay-verify="required" placeholder="请输入SDK地址" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">是否展示</label>
            <div class="layui-input-inline">
                <input type="checkbox" name="on_show" checked="" value="1"  lay-skin="switch" lay-text="展示|不展示">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="article">提交</button>
            </div>
        </div>
    </form>
</div>

<script>
  var type='post';
  var sdk_id = 0;

  layui.use(['form','layer','jquery'], function(){
      var form = layui.form;
      var $ = layui.jquery;
      var layer = layui.layer;

        //增加
        $("#add").click(function(){
            cleanAlert();
            type='post';
            layer.open({
              type:1
              ,title: false
              ,area: ['430px', '380px']
              ,shadeClose: true
              ,content: $('#alert')
            });
        })
        //清表
        function cleanAlert(){
            type = '';
            sdk_id = 0;
            form.val("alert_form", {
              "sdk_name": ''
              ,"download_count": 0
              ,"desc": ''
              ,"sdk_download_url":''
              ,"on_show": false
            })
        }

        //编辑分类
        $(".edit").click(function(){
            cleanAlert();
            sdk_id = $(this).parent().parent().find('td').eq(0).html();
            type='put';
            var sdk_name = $(this).parent().parent().find('td').eq(1).html();
            var download_count = $(this).parent().parent().find('td').eq(2).html();
            var desc = $(this).parent().parent().find('td').eq(3).html();
            var on_show = $(this).parent().parent().find('td').eq(4).attr('data') ==1 ? true:false;
            var sdk_download_url = $(this).parent().parent().find('td').eq(0).attr('sdk_download_url')

            layer.open({
              type:1
              ,title: false
              ,area: ['430px', '380px']
              ,shadeClose: true
              ,content: $('#alert')
              ,success: function (layero, index) {
                  form.val("alert_form", {
                      "sdk_name": sdk_name
                      ,"download_count": download_count
                      ,"desc": desc
                      ,"sdk_download_url": sdk_download_url
                      ,"on_show": on_show
                  })
              }
            });
        })

        $(".del").click(function(){
            cleanAlert();
            type='delete';
            sdk_id = $(this).parent().parent().find('td').eq(0).html();

            layer.confirm('确认删除该SDK？ ', {
              btn: ['确定','取消'] //按钮
            }, function(){
                var url = '/{{config('sys_conf.admin')}}/SoftSDK/'+sdk_id;
                ajaxDo(url,type,{},function(data){
                    if (data['code'] == '1'){
                        window.location.reload();
                    }else{
                        layer.msg(data['msg']);
                    }
                });
            });
        })

        form.on('submit(article)',function (data) {

            if(type=='put'){
                var url = '/{{config('sys_conf.admin')}}/SoftSDK/'+sdk_id;
            }
            else{
                var url = '/{{config('sys_conf.admin')}}/SoftSDK';
            }

            ajaxDo(url,type,data.field,function(data){
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