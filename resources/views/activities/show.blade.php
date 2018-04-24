@extends('layouts.default')
@section('title', $activity->title)

@section('content')
    <h1>{{ $activity->title }}</h1>
    <h3>活动时间:{{ date('Y年m月d日',$activity->start) }}----{{ date('Y年m月d日',$activity->end) }}</h3>
    {!! $activity->detail !!}


@stop