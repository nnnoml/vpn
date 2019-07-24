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
            <form class="layui-form" action="" lay-filter="formTest" >
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">本地IP</label>
                        <div class="layui-input-inline">
                            <input type="text" name="sip" autocomplete="off" class="layui-input">
                        </div>
                        <label class="layui-form-label" style="width:auto;padding:9px 5px;">:</label>
                        <div class="layui-input-inline">
                            <input style="width:60px;" type="text" name="spt" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">远程IP</label>
                        <div class="layui-input-inline">
                            <input type="text" name="dip" autocomplete="off" class="layui-input">
                        </div>
                        <label class="layui-form-label" style="width:auto;padding:9px 5px;">:</label>
                        <div class="layui-input-inline">
                            <input style="width:60px;" type="text" name="dpt" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">服务器IP</label>
                        <div class="layui-input-inline">
                            <input type="text" name="mip" autocomplete="off" class="layui-input">
                        </div>
                        <label class="layui-form-label" style="width:auto;padding:9px 5px;">:</label>
                        <div class="layui-input-inline">
                            <input style="width:60px;" type="text" name="mpt" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="uname" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-block">
                        <label class="layui-form-label" style="color:red;">*日期范围</label>
                        <div class="layui-input-block">
                            <input type="text" name="date" class="layui-input" lay-verify="required" id="date_between" placeholder=" - ">
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

        <div class="layui-tab layui-tab-card" >
            <ul class="layui-tab-title">
                @foreach($date_list as $key=>$vo)
                <li @if($loop->index==0) class="layui-this" @endif >{{$vo}}</li>
                @endforeach
            </ul>
            <div class="layui-tab-content" >
                @foreach($res as $key=>$vo)
                <div class="layui-tab-item @if($loop->index==0)layui-show @endif">
                    <div class="layui-form">
                        <table class="layui-table">
                            <colgroup>
                                <col width="150">
                                <col width="150">
                                <col width="200">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>用户</th>
                                <th>客户端ip 端口</th>
                                <th>远程ip 端口</th>
                                <th>服务器ip 端口</th>
                                <th>插入时间</th>
                            </tr>
                            </thead>
                            <tbody id="tbody{{$key}}">
                            @if(isset($vo['list']))
                                @foreach ($vo['list'] as $k2=>$v2)
                                    <tr>
                                        <td>{{$v2['name']}}</td>
                                        <td>{{$v2['clientIp']}} （{{$v2['clientPort']}}）</td>
                                        <td>{{$v2['remoteIp']}} （{{$v2['remotePort']}}）</td>
                                        <td>{{$v2['svrIp']}} （{{$v2['svrPort']}}）</td>
                                        <td>{{$v2['insertTime']}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div id="page{{$key}}"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


<script>
var pn = 1;
var pc = 20;
layui.use(['form','laydate','laypage'], function(){
   var form = layui.form
        ,laydate = layui.laydate
        ,laypage = layui.laypage;
    //日期时间范围
    laydate.render({
        elem: '#date_between'
        ,type: 'datetime'
        ,range: true
    });

    form.val("formTest", {
        "sip": '{{$data['sip']}}'
        ,"spt": '{{$data['spt']}}'
        ,"dip": '{{$data['dip']}}'
        ,"dpt": '{{$data['dpt']}}'
        ,"mip": '{{$data['mip']}}'
        ,"mpt": '{{$data['mpt']}}'
        ,"date": '{{$date}}'
    })

    form.on('submit(demo1)', function(data){
        window.location.href='?sip='+data.field.sip
        +'&spt='+data.field.spt
        +'&dip='+data.field.dip
        +'&dpt='+data.field.dpt
        +'&mip='+data.field.mip
        +'&mpt='+data.field.mpt
        +'&uname='+data.field.uname
        +'&date='+data.field.date
        +'&pn='+pn
        +'&pc='+pc;

        return false;
    });

@foreach($res as $key=>$vo)
      laypage.render({
        elem: 'page{{$key}}'
        ,count: {{$res[$key]['count']}}
        ,curr: {{$pn+1}}
        ,limit:20
        ,jump: function(obj, first){
            if(!first){
            var postData = {};
            postData.sip = $("input[name='sip']").val();
            postData.spt = $("input[name='spt']").val();
            postData.dip = $("input[name='dip']").val();
            postData.dpt = $("input[name='dpt']").val();
            postData.mip = $("input[name='mip']").val();
            postData.mpt = $("input[name='mpt']").val();
            postData.uname = $("input[name='uname']").val();
            postData.date = $("input[name='date']").val();
            postData.pn = obj.curr;
            postData.pc = obj.limit;

            ajaxDo('/{{config('sys_conf.admin')}}/LogCenter/isPage','post',postData,function(data){
                if(data.code==1){
                    var html = '';
                    data.info.list.forEach(function(v){
                        html += '<tr>\
                            <td>'+v.name+'</td>\
                            <td>'+v.clientIp+' （'+v.clientPort+'）</td>\
                            <td>'+v.remoteIp+' （'+v.remotePort+'）</td>\
                            <td>'+v.svrIp+' （'+v.svrPort+'）</td>\
                            <td>'+v.insertTime+'</td>\
                        </tr>';
                    })

                    $("#tbody{{$key}}").html(html);
                }
                else{
                    layer.msg(data.msg);
                }
            })
            }
        }
      });
@endforeach

});
</script>
@endsection