@extends('layouts.default')
@section('title', $event_prize->prize_name)

@section('content')
    <h1 style="color: #00b7ee">奖品详情</h1>
    <h2>{{ $event_prize->prize_name }}</h2>

    <h3>奖品描述:{{ $event_prize->description }}</h3>
    <br>
    <br>
    <h4>所属活动:{{ $event_prize->event->title }}</h4>

@stop