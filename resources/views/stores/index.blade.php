@extends('layouts.default')
@section('title','商铺列表')
    @section('content')
        <form class="navbar-form navbar-left" method="get">
            <div class="form-group">
                <input type="text" name="keywords" class="form-control" placeholder="搜索...">
            </div>
            <button type="submit" class="btn btn-default">查询</button>
        </form>
        <table class="table table-bordered table-responsive" id="stores">
            <tr>
                <th>商铺ID</th>
                <th>商铺名</th>
                <th>帐号名</th>
                <th>手机号码</th>
                <th>店铺分类</th>
                <th>店铺状态</th>
                <th>店铺描述</th>
                <th>操作</th>
            </tr>
            @foreach($stores as $store)
                <tr data-id="{{ $store->id }}">
                    <td>{{$store->id}}</td>
                    <td>{{$store->store_info->store_name}}</td>
                    <td>{{$store->name}}</td>
                    <td>{{$store->telephone}}</td>
                    <td>{{$store->store_cat->name}}</td>
                    <td>{{$store->status==1?'审核通过':'未审核'}}</td>
                    <td>{{$store->detail}}</td>
                    <td>
                        <a href="{{ route('stores.show',['store'=>$store->id]) }}" class="btn btn-primary btn-sm" >查看详细信息</a>
                        <button class="btn btn-danger btn-sm">删除</button>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $stores->appends(compact('keywords'))->links() }}
    @stop
@section('js')
    <script>
        $("#stores .btn-danger").click(function () {
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