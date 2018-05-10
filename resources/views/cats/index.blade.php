@extends('layouts.default')
@section('title','商铺分类列表')
    @section('content')
        <table class="table table-bordered table-responsive" id="cats">
            <tr>
                <th>ID</th>
                <th>商铺分类名</th>
                <th>分类logo</th>
                <th>操作</th>
            </tr>
            @foreach($cats as $cat)
                <tr data-id="{{ $cat->id }}">
                    <td>{{$cat->id}}</td>
                    <td>{{$cat->cat_name}}</td>
                    <td><img src="@if($cat->logo){{ $cat->logo }}@endif" class="img-circle img-circle" style="width: 50px"></td>
                    <td>
                        <a href="{{ route('cats.edit',['cat'=>$cat]) }}" class="btn btn-warning btn-sm">编辑</a>
                        <a href="{{ route('cats.show',['cat'=>$cat]) }}" class="btn btn-primary btn-sm" >查看</a>
                        <button class="btn btn-danger btn-sm">删除</button>
                    </td>
                </tr>
            @endforeach
        </table>
        {{--{{ $users->appends(['name'=>$name])->links() }}--}}
    @stop
@section('js')
    <script>
        $("#cats .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'cats/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>

@stop