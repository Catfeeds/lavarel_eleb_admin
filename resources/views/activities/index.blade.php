@extends('layouts.default')
@section('title','活动列表')
    @section('content')
        <table class="table table-bordered table-responsive" id="activities">
            <tr>
                <th>ID</th>
                <th>活动标题</th>
                <th>活动开始时间</th>
                <th>活动结束时间</th>
                <th>操作</th>
            </tr>
            @foreach($activities as $activity)
                <tr data-id="{{ $activity->id }}">
                    <td>{{$activity->id}}</td>
                    <td>{{$activity->title}}</td>
                    <td>{{date('Y-m-d',$activity->start)}}</td>
                    <td>{{date('Y-m-d',$activity->end)}}</td>
                    <td>
                        <a href="{{ route('activities.show',['activity'=>$activity]) }}" class="btn btn-primary btn-sm" >查看</a>
                        @auth
                        <a href="{{ route('activities.edit',['activity'=>$activity]) }}" class="btn btn-warning btn-sm">编辑</a>
                        <button class="btn btn-danger btn-sm">删除</button>
                        @endauth
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $activities->links() }}
    @stop
@section('js')
    <script>
        $("#activities .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'activities/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>

@stop