<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H+ 后台主题UI框架 - 基础表格</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico" tppabs="http://www.zi-han.net/theme/hplus/favicon.ico">
    <link href="{{ asset('/css/bootstrap.min.css-v=3.3.5.css') }}" tppabs="http://www.zi-han.net/theme/hplus/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css-v=4.4.0.css') }}" tppabs="http://www.zi-han.net/theme/hplus/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="{{ asset('/css/plugins/iCheck/custom.css') }}" tppabs="http://www.zi-han.net/theme/hplus/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{ asset('/css/animate.min.css') }}" tppabs="http://www.zi-han.net/theme/hplus/css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('/css/style.min.css-v=4.0.0.css') }}" tppabs="http://www.zi-han.net/theme/hplus/css/style.min.css?v=4.0.0" rel="stylesheet">
    <base target="_blank">
    <script src="{{ asset('/js/jquery.min.js-v=2.1.4.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/jquery.min.js?v=2.1.4"></script>
    <script src="{{ asset('/js/bootstrap.min.js-v=3.3.5.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/bootstrap.min.js?v=3.3.5"></script>
    
    <style type="text/css">

        html body .page * {
            border: 0;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        html body .page {
            width: auto;
            margin: 20px auto;
            text-align: center;
        }

        html body .page ul {
            display: inline-block;
        }

        html body .page ul li {
            float: left;
            font-size: 15px;
        }

        html body .page ul li a,
        html body .page ul li span {
            display: block;
            padding: 8px 16px;
            border: 1px solid #dddddd;
            color: #2fa4e7;
            margin-left: -1px;
            font-size: 16px;
            font-family: "number";
        }

        html body .page ul li a.selected {
            color: #f00;
            background-color: #f1f1f1;
            font-weight: bold;
        }

        html body .page .first {
            color: #CCCCCC;
            border-color: #CCCCCC;
            cursor: default;
        }

        html body .page .num {
            cursor: default;
        }
    </style>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    @show
    @yield('content')
</div>
<script src="{{ asset('/js/bootstrap.min.js-v=3.3.5.js') }}"></script>
<script src="{{ asset('/js/content.min.js-v=1.0.0.js') }}"></script>
<script type="text/javascript">
    parent.layer.closeAll();
    window.CommonDel = function (id, url) {
        parent.layer.confirm('您确认要删除吗？该操作不可恢复', {
            btn: ['删除', '取消'], yes: function () {
                request('get', url, {id: id}, 'json', function (results) {
                    parent.layer.closeAll();
                    location.reload();
                });
            }, no: function () {
                parent.layer.closeAll();
            }
        });
    };


    window.moreDel = function (url) {
        parent.layer.confirm('您确认要删除吗？该操作不可恢复', {
            btn: ['删除', '取消'], yes: function () {
                var form = $('#moreDel').serializeArray();
                if (form.length > 0) {
                    for (var i = 0; i < form.length; i++) {
                        request('get', url, {id: form[i].value, category:$('#category').val()}, 'json', function (results) {
                            console.log(results);
                        });
                    }

                    location.reload();
                }
            }, no: function () {
                parent.layer.closeAll();
            }
        });
    };

    (function () {
        @php
            $error = \Session::get('error');
            if(!empty($error)){
                \Session::set('error', null);
                printf('parent.layer.alert(\'%s\')', str_replace('\'','"',$error));
            }
        @endphp
    })()
    $(function(){
        $(".pagination li a").attr("target","_self");
    })
</script>
</body>
</html>