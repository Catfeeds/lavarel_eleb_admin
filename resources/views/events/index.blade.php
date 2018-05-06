@extends('layouts.default')
@section('title','抽奖活动列表')
    @section('content')
        <table class="table table-bordered table-responsive" id="events">
            <tr>
                <th>ID</th>
                <th>抽奖活动标题</th>
                <th>抽奖报名开始时间</th>
                <th>抽奖报名结束时间</th>
                <th>开奖时间</th>
                <th>抽奖限制人数</th>
                <th>操作</th>
            </tr>
            @foreach($events as $event)
                <tr data-id="{{ $event->id }}">
                    <td>{{$event->id}}</td>
                    <td>{{$event->title}}</td>
                    <td>{{date('Y-m-d',$event->signup_start)}}</td>
                    <td>{{date('Y-m-d',$event->signup_end)}}</td>
                    <td>{{date('Y-m-d',$event->prize_date)}}</td>
                    <td>{{$event->signup_num}}</td>
                    <td>
                        <a href="{{ route('events.show',['event'=>$event]) }}" class="btn btn-primary btn-sm" >查看</a>
                        @auth
                        <a href="{{ route('events.edit',['event'=>$event]) }}" class="btn btn-warning btn-sm">编辑</a>
                        <button class="btn btn-danger btn-sm">删除</button>
                        @endauth
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $events->links() }}
    @stop
@section('js')
    <script>
        $("#events .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'events/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>

@stop