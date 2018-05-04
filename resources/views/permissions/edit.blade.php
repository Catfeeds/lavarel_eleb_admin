@extends('layouts.default')
@section('title','修改权限')
    @section('content')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form action="{{route('permissions.update',['permission'=>$permission])}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group">
                <label>权限名:</label>
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" name="name" class="form-control" value="{{$permission->name}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>权限显示名称:</label>
                    <input type="text" name="display_name" class="form-control" value="{{$permission->display_name}}">
                </div>
            <div class="form-group">
                <label>权限描述:</label>
                <input type="text" name="description" class="form-control" value="{{$permission->description}}">
            </div>
            <button type="submit" class="btn btn-default">确认修改</button>
        </form>
        @stop
