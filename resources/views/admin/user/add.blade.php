@extends('admin.common.content')
@section('content')
<form action="" method="post">
    <table width="500" align="center" cellpadding="10" cellspacing="20" border="0">
        {{ csrf_field() }}
        <tr>
            <td align="right">登录名：</td>
            <td>
                <input class="form-control" type="text" value="{{ !empty($detail->name) ? $detail->name : '' }}" name="username" id="username">
            </td>
        </tr>
        <tr>
            <td align="right">手机号：</td>
            <td>
                <input class="form-control" type="text" value="{{ !empty($detail->phone) ? $detail->phone : '' }}" name="phone" id="phone">
            </td>
        </tr>
        <tr>
            <td align="right">用户密码：</td>
            <td><input class="form-control" type="password" name="password" id="password"></td>
        </tr>
        <tr>
            <td align="right">确认密码：</td>
            <td><input class="form-control" type="password" name="rePassword" id="rePassword"></td>
        </tr>
        <!-- <tr>
            <td align="right">用户角色：</td>
            <td>
                <select name="level" class="form-control" id="level">
                    <option value="1" {{ !empty($detail->level) && $detail->level == 1 ? 'selected="selected"' : '' }}>
                        普通管理员
                    </option>
                    <option value="2" {{ !empty($detail->level) && $detail->level == 2 ? 'selected="selected"' : '' }}>
                        超级管理员
                    </option>
                </select>
            </td>
        </tr> -->
        <!-- <tr>
            <td align="right">用户状态：</td>
            <td>
                <select name="state" class="form-control" id="state">
                    <option value="0" {{ isset($detail->state) && $detail->state == 0 ? 'selected="selected"' : '' }}>
                        正常
                    </option>
                    <option value="1" {{ !empty($detail->state) && $detail->state == 1 ? 'selected="selected"' : '' }}>
                        异常
                    </option>
                </select>
            </td>
        </tr> -->
        <tr>
            <td colspan="2" align="center">
                <input type="button" class="button button-success" id='sub' value="保存">
                <input type="button" class="button" value="取消" onclick="">
            </td>
        </tr>
    </table>
</form>
@endsection
<script src="{{ asset('/js/jquery.min.js-v=2.1.4.js') }}" tppabs="http://www.zi-han.net/theme/hplus/js/jquery.min.js?v=2.1.4"></script>
<script type="text/javascript">
$(function(){
    $('#sub').click(
        function(){
            var username = $('#username').val();
            var phone = $('#phone').val();
            var password = $('#password').val();
            var rePassword = $('#rePassword').val();
            if(rePassword != password){
                alert('两次密码不一样！');
                return false;
            }
            $.ajax({
                type:'post',
                url:"{{url('/admin/user/add')}}",
                data:{
                    name:username,
                    password:password,
                    phone:phone,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success:function (data) {
                    if(data.state==200){
                        window.location.href="{{url('/admin/user/list')}}"
                    }else{
                        alert(data.msg);
                    }
                }
            });
            }
        );
  
})
</script>