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
<title>领取酬劳</title>
<link type="text/css" rel="stylesheet" href="{{asset('css/css.css')}}" madia="all">
<script src="{{ asset('/js/jquery.min.js-v=2.1.4.js') }}" ></script>
<script src="{{ asset('/layer/layer.min.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/plugins/layer/layer.min.js"></script>

</head>

<body>
<div class="index">
	<input type="button" value="领取酬劳" class="index_button" style=" background:#999;border:1px solid #ccc;">
    <!-- <input type="text" class="sign signs" placeholder="填写编码：">
    <input type="text" class="sign signs" placeholder="填写编码">
    <input type="text" class="sign signs" placeholder="填写编码：">
    <input type="text" class="sign signs" placeholder="填写编码"> -->
    <input type="text" class="sign signs" placeholder="填写编码：" id="order">
    <input type="button" value="提　交" class="index_button signs" onclick="sub()">
    <a href="javascript:history.back(-1)"><input type="button" value="返回上级" class="sing_bu"></a>
</div>
</body>
<script type="text/javascript">
	function sub(){
		var order_sn = $('#order').val();
		$.ajax({
            type : 'post',
            dataType : "JSON",
            url : "{{url('/user/get/money')}}",
            data : {
            	order_sn:order_sn,
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
