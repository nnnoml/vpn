<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title')</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('plug/layui/css')}}/layui.css"  media="all">

    <script src="{{asset('admin_src/js')}}/jquery.min.js" type="text/javascript"></script>
    <script src="{{asset('plug/layui')}}/layui.js" charset="utf-8"></script>
    <script src="{{asset('admin_src/js')}}/admin.js" charset="utf-8"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
@yield('head')
@yield('left')
@yield('body')
@yield('foot')
</div>
</body>
</html>
