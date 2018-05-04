@extends('layouts.default')
@section('title','管理员列表')
    @section('content')
        {{--<form class="navbar-form navbar-left" method="get">--}}
            {{--<div class="form-group">--}}
                {{--<input type="text" name="keywords" class="form-control" placeholder="搜索...">--}}
            {{--</div>--}}
            {{--<button type="submit" class="btn btn-default">查询</button>--}}
        {{--</form>--}}
        <table class="table table-bordered table-responsive" id="admins">
            <tr>
                <th>管理员ID</th>
                <th>管理员名</th>
                <th>邮箱</th>
                <th>操作</th>
            </tr>
            @foreach($admins as $admin)
                <tr data-id="{{ $admin->id }}">
                    <td>{{$admin->id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>
{{--                        <a href="{{ route('admins.show',['admin'=>$admin->id]) }}" class="btn btn-primary btn-sm" >查看详细信息</a>--}}
                        <a href="{{ route('admins.edit',['admin'=>$admin->id]) }}" class="btn btn-warning btn-sm" >编辑</a>
                        <button class="btn btn-danger btn-sm">删除</button>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $admins->links() }}
    @stop
@section('js')
    <script>
        $("#admins .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'admins/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>

@stop