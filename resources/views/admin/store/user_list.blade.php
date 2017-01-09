@extends('admin.common.content')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>送餐用户管理</h5>
                </div>
                <div class="ibox-content">
                    <!-- <div class="row">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" placeholder="请输入店铺名称" class="input-sm form-control">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> 搜索</button>
                                </span>
                            </div>
                        </div>
                    </div> -->
                    <div class="table-responsive">
                        <form action="" id="moreDel">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>手机号码</th>
                                    <th>用户余额</th>
                                    <th>历史金额</th>
                                    <th>历史订单数</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user_list as $user)
                                <tr>
                                    <td align="left">{{$user->name}}</td>
                                    <td align="left">{{$user->phone}}</td>
                                    <td align="left">{{$user->user_momey}}</td>
                                    <td align="left">{{$user->order_momey}}</td>
                                    <td align="left">{{$user->order_num}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div> 
                </div>
                <div class="pull-right">
                {!! $user_list->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection