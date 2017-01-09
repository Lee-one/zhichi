@extends('admin.common.content')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>账号列表</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-3">
                            <!-- <div class="input-group">
                                <input type="text" placeholder="请输入关键词" class="input-sm form-control">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> 搜索</button>
                                </span>
                            </div> -->
                        </div>
                       <!--  <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-btn">
                                        <a class="btn btn-sm btn-primary" href="" target="_self"> 导出EXCEL</a>
                                </span>
                            </div>
                        </div> -->
                    </div>
                    <div class="table-responsive">
                        <form action="" id="moreDel">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>名称</th>
                                    <th>手机号</th>
                                    <th>添加时间</th>
                                    <th>最后登录时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user_list as $user)
                                <tr>
                                    <td align="left">{{$user->name}}</td>
                                    <td align="left">{{$user->phone}}</td>
                                    <td align="left">{{$user->add_time}}</td>
                                    <td align="left">{{$user->login_last_time}}</td>
                                    <td align="left">
                                        <a target="_self" href="{{ url('/admin/user/edit')}}?id={{$user->id}}" class="btn btn-primary btn-sm">编辑</a>
                                        <a target="_self" href="{{ url('/admin/user/del')}}?id={{$user->id}}" class="btn btn-danger btn-sm">删除</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <td colspan="100" ><a href="javascript:;" class="btn btn-danger btn-sm">批量删除</a></td>
                                        <td colspan="100" ><a href="javascript:;" class="btn btn-default btn-sm">批量删除</a></td>
                                        <td colspan="100" ><a href="javascript:;" class="btn btn-success btn-sm">批量删除</a></td>
                                        <td colspan="100" ><a href="javascript:;" class="btn btn-info btn-sm">批量删除</a></td>
                                        <td colspan="100" ><a href="javascript:;" class="btn btn-primary btn-sm">批量删除</a></td>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
