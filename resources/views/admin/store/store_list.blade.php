@extends('admin.common.content')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>店铺列表</h5>
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
                                    <th>店铺名称</th>
                                    <th>店铺地址</th>
                                    <th>手机号</th>
                                    <th>编码剩余</th>
                                    <th>历史总和</th>
                                    <th>入驻时间</th>
                                    <th>是否审核</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($store_list as $store)
                                <tr>
                                    <td align="left">{{$store->store_name}}</td>
                                    <td align="left">{{$store->store_address}}</td>
                                    <td align="left">{{$store->store_phone}}</td>
                                    <td align="left">{{$store->order_num}}</td>
                                    <td align="left">{{$store->history_num}}</td>
                                    <td align="left">{{$store->add_time}}</td>
                                    <td align="left">@if($store->is_check == 1)通过 @elseif($store->is_check == 2) 未通过 @else 未审核 @endif</td>
                                    <td align="left">
                                        <a target="_self" href="{{ url('/admin/store/info')}}?id={{$store->id}}" class="btn btn-info btn-sm">审核</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div> 
                </div>
                <div class="pull-right">
                {!! $store_list->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection