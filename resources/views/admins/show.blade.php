@extends('layouts.default')
@section('title', $admin->name)

@section('content')
    <p style="color:#c8c8cf;font-size: 24px">管理员详情</p>
    <dl class="dl-horizontal col-xs-7">
        <dt>管理员名称:</dt>
        <dd>{{$admin->name}}</dd>
        <dt>管理员邮箱:</dt>
        <dd>{{$admin->email}}</dd>
        <dt>所属角色</dt>
        @foreach($roles as $role)
            <dd>{{$role->display_name}}</dd>
        @endforeach
    </dl>

@stop