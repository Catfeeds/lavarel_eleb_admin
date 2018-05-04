@extends('layouts.default')
@section('title','添加权限')
    @section('content')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form action="{{route('permissions.store')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label>权限名:</label>
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" name="name" class="form-control" placeholder="权限名称" value="{{old('name')}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>权限显示名称:</label>
                    <input type="text" name="display_name" class="form-control" placeholder="权限显示名称" value="{{old('display_name')}}">
                </div>
            <div class="form-group">
                <label>权限描述:</label>
                <input type="text" name="description" class="form-control" placeholder="权限描述" value="{{old('description')}}">
            </div>
            <button type="submit" class="btn btn-default">确认添加</button>
        </form>
        @stop
