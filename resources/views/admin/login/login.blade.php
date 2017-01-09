<?php use Illuminate\Support\Facades\Input; ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ Config::get('cloudsystem.site_name') }}</title>
    <meta name="keywords" content="{{ Config::get('cloudsystem.site_name') }}">
    <meta name="description" content="{{ Config::get('cloudsystem.site_name') }}">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{ asset('css/bootstrap.min.css-v=3.3.5.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css-v=4.4.0.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.min.css-v=4.0.0.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg login-page">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 style="font-size:60px;" class="logo-name">咫尺平台</h1>

            </div>

            <form class="m-t" role="form" method="post" action="{{ url('/admin/check_login') }}">
                {{ csrf_field() }}
                <div class="flash-message">
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" value="{{Input::old('username')}}" required="">
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <div class="form-group">
                    <input type="password" class="form-control" name="password" value="{{Input::old('password')}}" placeholder="Password" required="">
                </div>
                @if ($errors->has('code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
                <div class="form-group imagecode-parent">
                    <span class="imagecode"><img onclick="spot()" src="{{ url('imagecode') }}" id="oee" /></span><input value="{{Input::old('code')}}" type="text" class="form-control" name="code" placeholder="Code" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js-v=2.1.4.js') }}" ></script>
    <script src="{{ asset('js/bootstrap.min.js-v=3.3.5.js') }}" ></script>
    <script type="text/javascript">
        function spot(){
            document.getElementById('oee').src="{{URL::to('imagecode')}}?"+ new Date().getTime();
        }
    </script>
</body>

</html>