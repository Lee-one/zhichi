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
	<input type="text" class="sign" placeholder="名称：" id="name">
    <input type="text" class="sign signs" placeholder="手机号：" id="phone">
    <div class="submit">
    	<input type="text" class="sign signs" placeholder="验证码：" id="msg">
    	<input type="button" class="submit_one" value="发送验证" onclick="send()">
    </div>
    <input type="password" class="sign signs" placeholder="登陆密码：" id="password">
    <input type="password" class="sign signs" placeholder="确认密码：" id="repassword">
    <!-- <div class="sing_box">
    	<input name="" type="checkbox" value="">&nbsp;记住账号和密码
    </div> -->
    <input type="button" value="提交" class="sing_button" onclick="sub()">
</div>
</body>
<script type="text/javascript">
    function sub(){
        var name = $('#name').val();
        var phone = $('#phone').val();
        var msg = $('#msg').val();
        var password = $('#password').val();
        var repassword = $('#repassword').val();
        $.ajax({
            type : 'post',
            dataType : "JSON",
            url : "{{url('/user/zc')}}",
            data : {
                name:name,
                phone:phone,
                msg:msg,
                password:password,
                repassword:repassword,
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            success : function(res){
                if(res.status > 0){
                    layer.msg(res.message,{time:1200},function(){
                        // location.href = res.url;
                    });
                }else if(res.status == 0){
                    layer.msg(res.message,{time:1200});
                }
            }
        });
    }
    function send(){
      var phone = $('#phone').val();
      $.ajax({
            type : 'post',
            dataType : "JSON",
            url : "{{url('/send')}}",
            data : {
                phone:phone,
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            success : function(res){
                if(res.status > 0){
                    layer.msg(res.message,{time:1200},function(){
                        // location.href = res.url;
                    });
                }else if(res.status == 0){
                    layer.msg(res.message,{time:1200});
                }
            }
        });  
    }

</script>
</html>
