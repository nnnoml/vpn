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
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">本地IP</label>
                        <div class="layui-input-inline">
                            <input type="text" name="local_ip"  autocomplete="off" class="layui-input">
                        </div>
                        <label class="layui-form-label" style="width:auto;padding:9px 5px;">:</label>
                        <div class="layui-input-inline">
                            <input style="width:60px;" type="text" name="local_port" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">远程IP</label>
                        <div class="layui-input-inline">
                            <input type="text" name="remote_ip" autocomplete="off" class="layui-input">
                        </div>
                        <label class="layui-form-label" style="width:auto;padding:9px 5px;">:</label>
                        <div class="layui-input-inline">
                            <input style="width:60px;" type="text" name="remote_port" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="username" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-block">
                        <label class="layui-form-label" style="color:red;">*日期范围</label>
                        <div class="layui-input-block">
                            <input type="text" name="data" class="layui-input" lay-verify="required" id="data_between" placeholder=" - ">
                        </div>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>

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
                    <th>ip</th>
                    <th>行为</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($list as $key=>$vo)
                    <tr>
                        <td>{{$vo['ip']}}</td>
                        <td>{{$vo['action']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
layui.use(['form','laydate'], function(){
   var form = layui.form
        ,laydate = layui.laydate;
    //日期时间范围
    laydate.render({
        elem: '#data_between'
        ,type: 'datetime'
        ,range: true
    });

    form.on('submit(demo1)', function(data){
    console.log(data);
        layer.alert(JSON.stringify(data.field), {
          title: '最终的提交信息'
        })
        return false;
    });
});
</script>
@endsection