@extends('layouts.default')
@section('title', $user->name.'详情')

@section('content')
    <p style="color:#c8c8cf;font-size: 24px">会员详情</p>
    <dl class="dl-horizontal col-xs-7">
        <dt>会员名称</dt>
        <dd>{{$user->name}}</dd>
        <dt>会员电话</dt>
        <dd>{{$user->tel}}</dd>
        <dt>状态</dt>
        <dd>{{$user->status==-1?'违规,已禁用':'正常'}}</dd>
        <dt>操作</dt>
        @if($user->status!=-1)
        <dd><a href="{{route('users.disable',['user'=>$user])}}" class="btn btn-danger btn-sm">禁用该用户</a></dd>
        @else
        <dd><a href="{{route('users.enable',['user'=>$user])}}" class="btn btn-primary btn-sm">恢复该用户</a></dd>
        @endif
    </dl>

@stop