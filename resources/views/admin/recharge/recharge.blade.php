@extends('admin.common.content')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>充值记录</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
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
                    </div>
                    <div class="table-responsive">
                        <form action="" id="moreDel">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>店铺名称</th>
                                    <th>充值条数</th>
                                    <th>充值金额</th>
                                    <th>充值时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($recharge as $rec)
                                <tr>
                                    <td align="left">{{$rec->store_name}}</td>
                                    <td align="left">{{$rec->recharge_num}}</td>
                                    <td align="left">{{$rec->recharge_amount}}</td>
                                    <td align="left">{{$rec->add_time}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div> 
                </div>
                <div class="pull-right">
                {!! $recharge->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection