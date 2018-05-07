@extends('layouts.default')
@section('title','抽奖奖品列表')
    @section('content')
        <table class="table table-bordered table-responsive" id="event_prizes">
            <tr>
                <th>ID</th>
                <th>抽奖奖品名</th>
                <th>所属活动</th>
                <th>操作</th>
            </tr>
            @foreach($event_prizes as $event_prize)
                <tr data-id="{{ $event_prize->id }}">
                    <td>{{$event_prize->id}}</td>
                    <td>{{$event_prize->prize_name}}</td>
                    <td>{{$event_prize->event->title}}</td>
                    <td>
                        <a href="{{ route('event_prizes.show',['event_prize'=>$event_prize]) }}" class="btn btn-primary btn-sm" >查看</a>
                        @auth
                        <a href="{{ route('event_prizes.edit',['event_prize'=>$event_prize]) }}" class="btn btn-warning btn-sm">编辑</a>
                        <button class="btn btn-danger btn-sm">删除</button>
                        @endauth
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $event_prizes->links() }}
    @stop
@section('js')
    <script>
        $("#event_prizes .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'event_prizes/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>

@stop