@extends('admin.common.content')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>账号管理</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-3">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <form action="" id="moreDel">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>充值金额</th>
                                    <th>赠送条数</th>
                                    <th>添加时间</th>
                                    <th>修改时间</th>
                                    <th>操作者</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($discount as $dis)
                                <tr>
                                    <td align="left">{{$dis->money}}</td>
                                    <td align="left">{{$dis->discount_num}}</td>
                                    <td align="left">{{$dis->add_time}}</td>
                                    <td align="left">{{$dis->update_time}}</td>
                                    <td align="left">{{$dis->admin_name}}</td>
                                    <td align="left">
                                        <a target="_self" href="{{url('/admin/discount/save')}}?id={{$dis->id}}" class="btn btn-info btn-sm">修改</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                                <a target="_self" href="{{url('/admin/discount/add')}}" class="btn btn-info btn-sm">添加</a>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>

@endsection