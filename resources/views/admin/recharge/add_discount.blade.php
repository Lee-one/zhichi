@extends('admin.common.content')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加优惠赠送</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                    <strong>充值金额：</strong><input type="text" class="money" value=""><br/><br/>
                    <strong>赠送条数：</strong><input type="text" class="discount_num" value=""><br/><br/>
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
            var money = $('.money').val();
            var discount_num = $('.discount_num').val();
            if(!money){
                alert('充值金额不能为空！');
                return false;
            }
            if(!discount_num){
                alert('赠送条数不能为空！');
                return false;
            }
            $.ajax({
                type:'post',
                url:"{{url('/admin/discount/add')}}",
                data:{
                    money:money,
                    discount_num:discount_num,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success:function (data) {
                    if(data.state==200){
                        window.location.href="{{url('/admin/discount')}}"
                    }else{
                        alert(data.message);
                    }
                }
            });
            }
        );
  
})
</script>