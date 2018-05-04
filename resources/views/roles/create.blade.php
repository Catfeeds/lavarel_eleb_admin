@extends('layouts.default')
@section('title','添加角色')
    @section('content')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form action="{{route('roles.store')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label>角色名:</label>
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" name="name" class="form-control" placeholder="角色名称" value="{{old('name')}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>角色显示名称:</label>
                    <input type="text" name="display_name" class="form-control" placeholder="角色显示名称" value="{{old('display_name')}}">
                </div>
            <div class="form-group">
                <label>角色描述:</label>
                <input type="text" name="description" class="form-control" placeholder="角色描述" value="{{old('description')}}">
            </div>

            <div class="form-group">
                <label>拥有权限:</label>
                @foreach($permissions as $permission)
                <label class="checkbox-inline">
                    <input type="checkbox" name="permission_id[]" value="{{$permission->id}}">{{$permission->display_name}}
                </label>
                @endforeach
            </div>
            <button type="submit" class="btn btn-default">确认添加</button>
        </form>
        @stop
