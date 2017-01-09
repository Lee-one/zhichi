@extends('admin.common.content')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>店铺详情</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                    </div>
                    <div class="table-responsive">
                        <strong>店铺名称：</strong>{{$store_info->store_name}}<br/>
                        <strong>店铺地址：</strong>{{$store_info->store_address}}<br/>
                    </div>
                    <br/>
                    
                    @if($store_info->is_check == 0)
                    <strong>审核：</strong>
                    <a target="_self" href="{{url('/admin/store/check')}}?id={{$store_info->id}}&type=1" class="btn btn-success btn-sm">通过</a>
                    <a target="_self" href="{{url('/admin/store/check')}}?id={{$store_info->id}}&type=2" class="btn btn-danger btn-sm">拒绝</a>
                    @endif
                    @if($store_info->is_check == 2)
                    <strong>操作：</strong>
                    <a target="_self" href="{{url('/admin/store/check')}}?id={{$store_info->id}}&type=3" class="btn btn-danger btn-sm">删除</a>
                    <span>  ！删除后可重新申请入驻</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection