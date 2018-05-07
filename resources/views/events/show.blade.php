@extends('layouts.default')
@section('title', $event->title)

@section('content')
    <h1>{{ $event->title }}</h1>
    <h3>抽奖活动报名时间:{{ date('Y年m月d日',$event->signup_start) }}----{{ date('Y年m月d日',$event->signup_end) }}</h3>
    <h3>开奖时间:{{ date('Y年m月d日',$event->prize_date) }}</h3>
    <h4>抽奖限制人数:{{ $event->signup_num }}</h4>
    {!! $event->detail !!}
    <table class="table">
        <tr>
            <th>奖品编号</th>
            <th>奖品名称</th>
        </tr>
        @foreach($prizes as $prize)
            <tr>
                <td>{{$prize->id}}</td>
                <td>{{$prize->prize_name}}</td>
            </tr>
        @endforeach
    </table>
    @if($event->is_prize==0)
        <a href="{{route('events.give',['event'=>$event])}}" class="btn btn-primary">开始抽奖</a>
    @else 已开奖 <a href="{{route('events.result',['event'=>$event])}}" class="btn btn-success">查看中奖情况</a>
    @endif
@stop