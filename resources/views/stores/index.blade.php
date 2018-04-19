@extends('layouts.default')
@section('title','商铺分类列表')
    @section('content')
        <form class="navbar-form navbar-left" method="get">
            <div class="form-group">
                <input type="text" name="keywords" class="form-control" placeholder="搜索...">
            </div>
            <button type="submit" class="btn btn-default">查询</button>
        </form>
        <table class="table table-bordered table-responsive" id="store_infos">
            <tr>
                <th>商铺ID</th>
                <th>商铺名</th>
                <th>店铺图</th>
                <th>店铺类型</th>
                <th>店铺状态</th>
                <th>操作</th>
            </tr>
            @foreach($store_infos as $store_info)
                <tr data-id="{{ $store_info->store_id }}">
                    <td>{{$store_info->store_id}}</td>
                    <td>{{$store_info->store->name}}</td>
                    <td><img src="@if($store_info->store_img){{ $store_info->store_img }}@endif" class="img-circle img-circle" style="width: 50px"></td>
                    <td>{{$store_info->store->cat_id}}</td>
                    <td>{{$store_info->store->type==1?'审核通过':'未审核'}}</td>
                    <td>
                        <a href="{{ route('stores.edit',['store_info'=>$store_info->store->id]) }}" class="btn btn-warning btn-sm">编辑</a>
                        {{--<a href="{{ route('cats.show',['cat'=>$cat]) }}" class="btn btn-primary btn-sm" >查看</a>--}}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $store_infos->appends(compact('keywords'))->links() }}
    @stop
@section('js')
    <script>
        $("#store_infos .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'stores/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>

@stop