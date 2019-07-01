<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')VPN</title>

    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/common.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('index_src/css')}}/public.css" />


    <script type="text/javascript" src="{{asset('index_src/js')}}/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js')}}/public.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js')}}/common.js"></script>
    <script type="text/javascript" src="{{asset('plug')}}/layer/layer.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js')}}/public2.js"></script>
    <script type="text/javascript" src="{{asset('index_src/js')}}/index.js"></script>

</head>
<body>
@yield('nav')
@yield('main')
@yield('right')
@yield('foot')
@yield('alert')
</body>
</html>