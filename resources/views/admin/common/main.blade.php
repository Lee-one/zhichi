<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title>咫尺 - 后台管理中心</title>

    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico" tppabs="http://www.zi-han.net/theme/hplus/favicon.ico">
    <link href="{{ asset('/css/bootstrap.min.css-v=3.3.5.css') }}" tppabs="http://www.zi-han.net/theme/hplus/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css-v=4.4.0.css') }}" tppabs="http://www.zi-han.net/theme/hplus/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="{{ asset('/css/animate.min.css') }}" tppabs="http://www.zi-han.net/theme/hplus/css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('/css/style.min.css-v=4.0.0.css') }}" tppabs="http://www.zi-han.net/theme/hplus/css/style.min.css?v=4.0.0" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span><img alt="image" class="img-circle" src="img/profile_small.jpg" tppabs="http://www.zi-han.net/theme/hplus/img/profile_small.jpg"/></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"></strong></span>
                                <span class="text-muted text-xs block">{{\Session::get('admin')->name}}<b class="caret"></b></span>
                                </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="/admin/logout" tppabs="http://www.zi-han.net/theme/hplus/login.html">安全退出</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">H+
                    </div>
                </li>

                <li>
                    <a class="J_menuItem">
                        <i class="fa fa-columns"></i>
                        <span class="nav-label">账号管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="admin/user/list" tppabs="">管理员账号列表</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="admin/user/add" tppabs="">添加管理员</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="J_menuItem">
                        <i class="fa fa-columns"></i>
                        <span class="nav-label">商家管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="admin/store/list" tppabs="">商家列表</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="J_menuItem">
                        <i class="fa fa-columns"></i>
                        <span class="nav-label">充值管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{url('/admin/price')}}" tppabs="">充值记录</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{url('/admin/exchange')}}" tppabs="">充值提现规则</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{url('/admin/discount')}}" tppabs="">优惠赠送</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="J_menuItem">
                        <i class="fa fa-columns"></i>
                        <span class="nav-label">提现管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{url('/admin/deal')}}" tppabs="">待处理</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{url('/admin/over/deal')}}" tppabs="">已处理</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="J_menuItem">
                        <i class="fa fa-columns"></i>
                        <span class="nav-label">送餐管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{url('/admin/sc/user')}}" tppabs="">送餐用户</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="" tppabs="http://www.zi-han.net/theme/hplus/login.html" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i>
                退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="{{url('/admin/user/list')}}" frameborder="0" data-id="" seamless></iframe>
        </div>
    </div>
</div>
<script src="{{ asset('/js/jquery.min.js-v=2.1.4.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/jquery.min.js?v=2.1.4"></script>
<script src="{{ asset('/js/bootstrap.min.js-v=3.3.5.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/bootstrap.min.js?v=3.3.5"></script>
<script src="{{ asset('/js/plugins/metisMenu/jquery.metisMenu.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('/js/plugins/slimscroll/jquery.slimscroll.min.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{ asset('/js/plugins/layer/layer.min.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/plugins/layer/layer.min.js"></script>
<script src="{{ asset('/js/hplus.min.js-v=4.0.0.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/hplus.min.js?v=4.0.0"></script>
<script src="{{ asset('/js/contabs.min.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/contabs.min.js"></script>
<script src="{{ asset('/js/plugins/pace/pace.min.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/plugins/pace/pace.min.js"></script>
<script type="text/javascript">
    (function () {
        @php
            $error = \Session::get('error');
            if(!empty($error)){
                \Session::set('error', null);
                printf('parent.layer.alert(\'%s\')', str_replace('\'','"',$error));
            }
        @endphp
    })();
</script>
</body>

</html>