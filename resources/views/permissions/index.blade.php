@extends('layouts.default')
@section('title','权限列表')
    @section('content')
        <table class="table table-bordered table-responsive" id="permissions">
            <tr>
                <th>ID</th>
                <th>权限名</th>
                <th>权限显示名称</th>
                <th>操作</th>
            </tr>
            @foreach($permissions as $permission)
                <tr data-id="{{ $permission->id }}">
                    <td>{{$permission->id}}</td>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->display_name}}</td>
                    <td>
                        <a href="{{ route('permissions.edit',['permission'=>$permission]) }}" class="btn btn-warning btn-sm">编辑</a>
                        <a href="{{ route('permissions.show',['permission'=>$permission]) }}" class="btn btn-primary btn-sm" >查看</a>
                        <button class="btn btn-danger btn-sm">删除</button>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $permissions->links() }}
    @stop
@section('js')
    <script>
        $("#permissions .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'permissions/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>

@stop