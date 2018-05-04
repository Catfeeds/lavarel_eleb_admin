@extends('layouts.default')
@section('title','角色列表')
    @section('content')
        <table class="table table-bordered table-responsive" id="roles">
            <tr>
                <th>ID</th>
                <th>角色名</th>
                <th>角色显示名称</th>
                <th>操作</th>
            </tr>
            @foreach($roles as $role)
                <tr data-id="{{ $role->id }}">
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->display_name}}</td>
                    <td>
                        <a href="{{ route('roles.edit',['role'=>$role]) }}" class="btn btn-warning btn-sm">编辑</a>
                        {{--<a href="{{ route('roles.show',['role'=>$role]) }}" class="btn btn-primary btn-sm" >查看</a>--}}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $roles->links() }}
    @stop
@section('js')
    <script>
        $("#roles .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'roles/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>

@stop