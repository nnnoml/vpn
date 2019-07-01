@extends('Index.app')
@section('title',$title)
@extends('Index.Common.nav_index')
@extends('Index.Common.right_index')
@extends('Index.Common.foot_index')
@extends('Index.Common.alert_index')

@section('main')
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/index2.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/iframe_consult.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/getip.css" >

    <link rel="stylesheet" href="{{asset('plug/layui/css')}}/layui.css"  media="all">
    <script src="{{asset('plug/layui')}}/layui.js" charset="utf-8"></script>

    <section style="margin-top:120px;">
        <div class="dial_left fadeInLeft">
            <h1>提取IP/生成IP</h1>

            <div class="region">
                <div class="region_list">
                    <h1 class="left">请选择提取类型</h1>
                    <div class="right">

                        <form class="layui-form" action="">

                            <div class="layui-form-item">
                                <label class="layui-form-label">选择框</label>
                                <div class="layui-input-inline">
                                    <select name="city" lay-verify="required">
                                        <option value=""></option>
                                        <option value="0">北京</option>
                                        <option value="1">上海</option>
                                        <option value="2">广州</option>
                                        <option value="3">深圳</option>
                                        <option value="4">杭州</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">复选框</label>
                                <div class="layui-input-block">
                                    <input type="checkbox" name="like[write]" title="写作">
                                    <input type="checkbox" name="like[read]" title="阅读" checked>
                                    <input type="checkbox" name="like[dai]" title="发呆">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">开关</label>
                                <div class="layui-input-block">
                                    <input type="checkbox" name="switch" lay-skin="switch">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">单选框</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="sex" value="男" title="男">
                                    <input type="radio" name="sex" value="女" title="女" checked>
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">文本域</label>
                                <div class="layui-input-block">
                                    <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection