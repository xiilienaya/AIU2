<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>laravel - 后台</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{env('ADMIN_STATIC_URL')}}/layui/css/layui.css">
    <script src="{{env('ADMIN_STATIC_URL')}}/layui/layui.js"></script>
    <script src="{{env('ADMIN_STATIC_URL')}}/index/js/jquery-1.11.2.min.js"></script>
</head>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<body class="layui-layout-body">

<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">aiu - 后台</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        {{--<ul class="layui-nav layui-layout-left">--}}
            {{--<li class="layui-nav-item"><a href="">控制台</a></li>--}}
            {{--<li class="layui-nav-item"><a href="">商品管理</a></li>--}}
            {{--<li class="layui-nav-item"><a href="">用户</a></li>--}}
            {{--<li class="layui-nav-item">--}}
                {{--<a href="javascript:;">其它系统</a>--}}
                {{--<dl class="layui-nav-child">--}}
                    {{--<dd><a href="">邮件管理</a></dd>--}}
                    {{--<dd><a href="">消息管理</a></dd>--}}
                    {{--<dd><a href="">授权管理</a></dd>--}}
                {{--</dl>--}}
            {{--</li>--}}
        {{--</ul>--}}
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    {{--<img src="http://t.cn/RCzsdCq" class="layui-nav-img">--}}
                    {{--贤心--}}
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="">退出</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item"><a class="layui-icon layui-icon-home" href="{{url('/admin/admin')}}"> &ensp;&ensp;主页</a></li>

                <li class="layui-nav-item">
                    <a class="layui-icon layui-icon-picture-fine" href="javascript:;"> &ensp;&ensp;用户管理</a>
                    <dl class="layui-nav-child">
                        <dd><a class="layui-icon layui-icon-picture-fine" href="{{url('/admin/user')}}"> &ensp;&ensp;用户管理</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="layui-icon layui-icon-picture-fine" href="javascript:;"> &ensp;&ensp;游记管理</a>
                    <dl class="layui-nav-child">
                        <dd><a class="layui-icon layui-icon-picture-fine" > &ensp;&ensp;游记管理</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="layui-icon layui-icon-picture-fine" href="javascript:;"> &ensp;&ensp;景点管理</a>
                    <dl class="layui-nav-child">
                        <dd><a class="layui-icon layui-icon-picture-fine" > &ensp;&ensp;用户管理</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <div class="layui-body">