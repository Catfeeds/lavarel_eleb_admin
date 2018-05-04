@extends('layouts.default')
@section('title','修改角色')
    @section('content')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form action="{{route('roles.update',['role'=>$role])}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group">
                <label>角色名:</label>
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" name="name" class="form-control" value="{{$role->name}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>角色显示名称:</label>
                    <input type="text" name="display_name" class="form-control" value="{{$role->display_name}}">
                </div>
            <div class="form-group">
                <label>角色描述:</label>
                <input type="text" name="description" class="form-control" value="{{$role->description}}">
            </div>

            <div class="form-group">
                <label>拥有权限:</label>
                @foreach($permissions as $permission)
                <label class="checkbox-inline">
                    <input type="checkbox" name="permission_id[]" value="{{$permission->id}}" {{$role->hasPermission($permission->name)?'checked':''}}>{{$permission->display_name}}
                </label>
                @endforeach
            </div>
            <button type="submit" class="btn btn-default">确认修改</button>
        </form>
        @stop
