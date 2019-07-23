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
            <button id="add" type="button" class="layui-btn"><i class="layui-icon layui-icon-add-1"></i> 添加节点</button>
        </blockquote>

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <div class="layui-form">
            <table class="layui-table">
                <colgroup>
                    <col width="10">
                    <col width="100">
                    <col width="100">
                    <col width="80">
                    <col width="130">
                    <col width="60">
                </colgroup>
                <thead>
                <tr>
                    <th>id</th>
                    <th>省份</th>
                    <th>城市</th>
                    <th>运营商</th>
                    <th>协议</th>
                    <th>状态</th>
                    <th>线路域名</th>
                    <th>上下线</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($list as $key=>$vo)
                <tr>
                    <td>{{$vo['vpn_id']}}</td>
                    <td code="{{$vo['vpn_province']}}">{{$vo['vpn_province_format']}}</td>
                    <td code="{{$vo['vpn_city']}}">{{$vo['vpn_city_format']}}</td>
                    <td>{{$vo['vpn_operator']}}</td>
                    <td>{{$vo['vpn_protocol']}}</td>
                    <td data="{{$vo['vpn_status']}}">@if($vo['vpn_status']) 可用@else不可用@endif</td>
                    <td>{{$vo['vpn_domain']}}</td>
                    <td data="{{$vo['online']}}">@if($vo['online']) 上线@else下线@endif</td>
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
            <label class="layui-form-label">省份</label>
            <div class="layui-input-inline">
                <select name="vpn_province" lay-filter="vpn_province" lay-verify="required">
                    <option value="">请选择省份</option>
                    @foreach($province as $key=>$vo)
                    <option value="{{$vo['code']}}">{{$vo['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">城市</label>
            <div class="layui-input-inline">
                <select name="vpn_city" lay-verify="required">
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">运营商</label>
            <div class="layui-input-inline">
                <select name="vpn_operator" lay-verify="required">
                    <option value="">请选择运营商</option>
                    <option value="电信">电信</option>
                    <option value="联通">联通</option>
                    <option value="移动">移动</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">协议</label>
            <div class="layui-input-inline">
                <select name="vpn_protocol" lay-verify="required">
                    <option value="">请选择协议</option>
                    <option value="L2TP">L2TP</option>
                    <option value="PPTP">PPTP</option>
                    <option value="L2TP ｜ PPTP">L2TP ｜ PPTP</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-inline">
                <input type="checkbox" name="vpn_status" checked="" value="1"  lay-skin="switch" lay-text="在线|不在线">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">上下线</label>
            <div class="layui-input-inline">
                <input type="checkbox" name="online" value="1" lay-skin="switch" lay-text="下线|上线">
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">线路域名</label>
            <div class="layui-input-block">
                <input type="text" name="vpn_domain" required="" lay-verify="required" placeholder="请输入线路域名" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">*</div>
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
  var vpn_id = 0;

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
              ,area: ['430px', '505px']
              ,shadeClose: true
              ,content: $('#alert')
            });
        })
        //清表
        function cleanAlert(){
            type = '';
            vpn_id = 0;
            $("select[name='vpn_city']").html('');
            form.val("alert_form", {
              "vpn_province": ''
              ,"vpn_city": ''
              ,"vpn_operator": ''
              ,"vpn_protocol": ''
              ,"vpn_status": false
              ,"online": false
              ,"vpn_domain": ""
            })
        }

        //编辑分类
        $(".edit").click(function(){
            cleanAlert();
            vpn_id = $(this).parent().parent().find('td').eq(0).html();
            type='put';
            var province_code = $(this).parent().parent().find('td').eq(1).attr('code');
            var city_code = $(this).parent().parent().find('td').eq(2).attr('code');
            var vpn_operator = $(this).parent().parent().find('td').eq(3).html();
            var vpn_protocol = $(this).parent().parent().find('td').eq(4).html();
            var vpn_status = $(this).parent().parent().find('td').eq(5).attr('data') ==1 ? true:false;
            var online = $(this).parent().parent().find('td').eq(7).attr('data') ==1 ? true:false;
            var vpn_domain = $(this).parent().parent().find('td').eq(6).html();

            layer.open({
              type:1
              ,title: false
              ,area: ['430px', '505px']
              ,shadeClose: true
              ,content: $('#alert')
              ,success: function (layero, index) {
                    ajaxDo('/{{config('sys_conf.admin')}}/VpnConf/getCity/'+province_code,'get',{},function(data){
                        var html = '<option value="">请选择市</option>';
                            data.forEach(function(v){
                                html += '<option value="'+v.code+'">'+v.name+'</option>'
                            })
                            $("select[name='vpn_city']").html(html);
                            $('select[name="vpn_city"]').val(city_code);
                            form.render('select');
                    });

                    form.val("alert_form", {
                      "vpn_province": province_code
                      ,"vpn_operator": vpn_operator
                      ,"vpn_protocol": vpn_protocol
                      ,"vpn_status": vpn_status
                      ,"online": online
                      ,"vpn_domain": vpn_domain
                    })
              }
            });
        })

        $(".del").click(function(){
            cleanAlert();
            type='delete';
            vpn_id = $(this).parent().parent().find('td').eq(0).html();

            layer.confirm('确认删除该配置？ ', {
              btn: ['确定','取消'] //按钮
            }, function(){
                var url = '/{{config('sys_conf.admin')}}/VpnConf/'+vpn_id;
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
                var url = '/{{config('sys_conf.admin')}}/VpnConf/'+vpn_id;
            }
            else{
                var url = '/{{config('sys_conf.admin')}}/VpnConf';
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

//城市联动
        form.on('select(vpn_province)', function(data){
           if(data.value == '' || data.value == undefined) return;
           $("select[name='vpn_city']").html('');
           form.render();
           ajaxDo('/{{config('sys_conf.admin')}}/VpnConf/getCity/'+data.value,'get',{},function(data){
                var html = '<option value="">请选择市</option>';
                    data.forEach(function(v){
                        html += '<option value="'+v.code+'">'+v.name+'</option>'
                    })
                    $("select[name='vpn_city']").html(html);
                    form.render();
            });
          data.value
        });


    })
</script>
@endsection