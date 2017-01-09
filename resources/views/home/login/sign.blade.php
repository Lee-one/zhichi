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
	<input type="text" class="sign" placeholder="账号：" id="phone">
    <input type="password" class="sign signs" placeholder="密码：" id="password"> 
   <!--  <div class="sing_box">
    	<input name="" type="checkbox" value="">&nbsp;记住账号和密码
    </div> -->
    <input type="button" value="登陆" class="sing_button" onclick="sub()">
    <span style="font-size: 16px;float: right;"><a href="{{url('/text')}}">立即注册 >></a></span>
</div>
</body>
<script type="text/javascript">
    function sub(){
        var phone = $('#phone').val();
        var password = $('#password').val();
        $.ajax({
            type : 'post',
            dataType : "JSON",
            url : "{{url('/login')}}",
            data : {
                phone:phone,
                password:password,
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            success : function(res){
                if(res.status > 0){
                    layer.msg(res.message,{time:1200},function(){
                        location.href = "{{url('/store')}}";
                    });
                }else if(res.status == 0){
                    layer.msg(res.message,{time:1200});
                }
            }
        });
    }
</script>
</html>
