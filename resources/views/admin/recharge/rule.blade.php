@extends('admin.common.content')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>充值提现规则</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                    <strong>充值价格：</strong><input type="text" class="price" value="{{$rule->price}}"><br/><br/>
                    <strong>兑换价格：</strong><input type="text" class="exchange" value="{{$rule->exchange}}"><br/><br/>
                    <strong>条数：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><input type="text" class="num" value="{{$rule->num}}"><br/><br/>
                    <strong>操作者：&nbsp;&nbsp;&nbsp;</strong><span>{{$rule->admin_name}}</span><br/><br/>
                    <strong>更新时间：</strong><span>{{$rule->update_time}}</span><br/><br/>
                    <a target="_self" href="javascript:;" id="sub" class="btn btn-primary btn-sm">保存</a>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('/js/jquery.min.js-v=2.1.4.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/jquery.min.js?v=2.1.4"></script>
<script type="text/javascript">
$(function(){
    $('#sub').click(
        function(){
            var price = $('.price').val();
            var exchange = $('.exchange').val();
            var num = $('.num').val();
            if(!price){
                alert('充值价格不能为空！');
                return false;
            }
            if(!exchange){
                alert('兑换价格不能为空！');
                return false;
            }
            if(!num){
                alert('条数不能为空！');
                return false;
            }
            $.ajax({
                type:'post',
                url:"{{url('/admin/rule/save')}}",
                data:{
                    price:price,
                    exchange:exchange,
                    num:num,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success:function (data) {
                    if(data.state==200){
                        window.location.href="{{url('/admin/exchange')}}"
                    }else{
                        alert(data.msg);
                    }
                }
            });
            }
        );
  
})
</script>