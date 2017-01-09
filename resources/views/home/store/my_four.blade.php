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
</head>

<body>
<div class="index">
	<input type="button" value="我　的" class="index_button" style=" background:#999;border:1px solid #ccc;">
    <div class="my_two">
    @if(count($rec_list))
    @foreach($rec_list as $rec)
    	<p>{{$rec->add_time}} 充值：{{$rec->recharge_amount}}元 获取编码：{{$rec->recharge_num}}个</p>
    @endforeach
    @else
    <p>还没有充值记录！</p>
    @endif
    </div>
    <a href="javascript:history.back(-1)"><input type="button" value="返回上级" class="sing_bu"></a>
</div>
</body>
</html>
