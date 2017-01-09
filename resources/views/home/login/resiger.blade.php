<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta content="IE=11.0000" http-equiv="X-UA-Compatible">
<meta name="renderer" content="webkit">
<meta name="renderer" content="moz">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="screen-orientation"content="portrait">
<meta name="x5-orientation"content="portrait">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<title>无标题文档</title>
<link type="text/css" rel="stylesheet" href="{{asset('css/css.css')}}" madia="all">
<script src="{{ asset('/js/jquery.min.js-v=2.1.4.js') }}" ></script>
<script src="{{ asset('/layer/layer.min.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/plugins/layer/layer.min.js"></script>
</head>

<body>
<div class="index">
	<div class="resiger">
    	<p>注册须知</p>
        注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知注册须知
    </div>
    <div class="sing_box">
    	<input name="" type="checkbox" value="" id="xz">&nbsp;我以仔细阅读同意
    </div>
    <input type="button" value="下一步" class="sing_button" onclick="sub()">
</div>
</body>
<script type="text/javascript">
	function sub(){
		if(!$('#xz').is(':checked')) {
		    layer.msg('请先阅读注册须知，并确认！',{time:1200});
		}else{
			location.href = "{{url('/register')}}";
		}

	}

</script>
</html>
