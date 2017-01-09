@extends('admin.common.content')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>提现列表 - 已处理</h5>
                </div>
                <div class="ibox-content">
                    <!-- <div class="row">
                        <div class="col-sm-3">
                         <form target="_self" class="form-inline" action="{{url('/admin/price')}}" method="get" role="form">
                            <div class="input-group">
                                <input type="text" placeholder="请输入店铺名称" class="input-sm form-control" name="keyword">
                                <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                                </span>
                            </div>
                        </form>
                        </div>
                    </div> -->
                    <div class="table-responsive">
                        <form action="" id="moreDel">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>提现者名称</th>
                                    <th>提现者手机号</th>
                                    <th>提现账号</th>
                                    <th>账号名称</th>
                                    <th>提现金额</th>
                                    <th>提现申请时间</th>
                                    <th>操作管理员</th>
                                    <th>操作时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ref_list as $ref)
                                <tr>
                                    <td align="left">{{$ref->name}}</td>
                                    <td align="left">{{$ref->phone}}</td>
                                    <td align="left">{{$ref->refeact_account}}</td>
                                    <td align="left">{{$ref->account_name}}</td>
                                    <td align="left">{{$ref->reflect_momey}}</td>
                                    <td align="left">{{$ref->reflect_time}}</td>
                                    <td align="left">{{$ref->admin_name}}</td>
                                    <td align="left">{{$ref->deal_time}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div> 
                </div>
                <div class="pull-right">
                {!! $ref_list->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection