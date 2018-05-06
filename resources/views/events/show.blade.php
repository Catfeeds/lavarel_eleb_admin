@extends('layouts.default')
@section('title', $event->title)

@section('content')
    <h1>{{ $event->title }}</h1>
    <h3>抽奖活动报名时间:{{ date('Y年m月d日',$event->signup_start) }}----{{ date('Y年m月d日',$event->signup_end) }}</h3>
    <h3>开奖时间:{{ date('Y年m月d日',$event->prize_date) }}</h3>
    <h4>抽奖限制人数:{{ $event->signup_num }}</h4>
    {!! $event->detail !!}




@stop