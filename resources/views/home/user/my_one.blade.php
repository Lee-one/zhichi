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
<title>我  的</title>
<link type="text/css" rel="stylesheet" href="{{asset('css/css.css')}}" madia="all">
</head>

<body>
<div class="index">
	<input type="button" value="我　的" class="index_button" style=" background:#999;border:1px solid #ccc;">
    <div class="resiger">
    	<p>本周您以累计领取：255个</p>
        <p>累计金额：187元</p>
    </div>
    <a href="{{url('/user/reflect')}}">
    <div class="sing_box"><input type="button" value="提　现" class="fadan fadans"></div>
    </a>
    <div class="resiger">
    	<p>您历史累计领取：{{$user_info->order_num}}个</p>
        <p>累计金额：{{$user_info->order_momey}}元</p>
    </div>
    <a href="{{url('/user/history')}}">
    <div class="sing_box fadans"><input type="button" value="查看历史纪录" class="fadan fadans"></div>
    </a>
    <a href="javascript:history.back(-1)"><input type="button" value="返回上级" class="sing_bu signs"></a>
</div>
</body>
</html>
