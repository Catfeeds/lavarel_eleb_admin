@extends('layouts.default')
@section('title', $permission->display_name)

@section('content')
    <p style="color:#c8c8cf;font-size: 24px">权限详情</p>
    <dl class="dl-horizontal col-xs-7">
        <dt>权限名称:</dt>
        <dd>{{$permission->name}}</dd>
        <dt>权限显示名称:</dt>
        <dd>{{$permission->display_name}}</dd>
        <dt>权限描述:</dt>
        <dd>{{$permission->description}}</dd>
    </dl>

@stop