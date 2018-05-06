@extends('layouts.default')
@section('title','菜单列表')
    @section('content')
        <table class="table table-bordered table-responsive" id="menus">
            <tr>
                <th>ID</th>
                <th>菜单名</th>
                <th>路由|地址</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            @foreach($menus as $menu)
                <tr data-id="{{ $menu->id }}">
                    <td>{{$menu->id}}</td>
                    <td>{{$menu->name}}</td>
                    <td>{{$menu->route}}</td>
                    <td>{{$menu->sort}}</td>
                    <td>
                        <a href="{{ route('menus.edit',['menu'=>$menu->id]) }}" class="btn btn-warning btn-sm">编辑</a>
                        {{--<a href="{{ route('menus.show',['menu'=>$menu]) }}" class="btn btn-primary btn-sm" >查看</a>--}}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </td>
                </tr>
            @endforeach
        </table>
    @stop
@section('js')
    <script>
        $("#menus .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'menus/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>

@stop