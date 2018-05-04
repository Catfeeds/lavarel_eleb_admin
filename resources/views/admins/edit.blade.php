@extends('layouts.default')
@section('title','修改管理员')
    @section('content')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form action="{{route('admins.update',['admin'=>$admin])}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group">
                <label>管理员名:</label>
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" name="name" class="form-control" value="{{$admin->name}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>管理员邮箱:</label>
                    <input type="text" name="email" class="form-control" value="{{$admin->email}}">
                </div>

            <div class="form-group">
                <label>所属角色:</label>
                @foreach($roles as $role)
                <label class="checkbox-inline">
                    <input type="checkbox" name="role_id[]" value="{{$role->id}}" {{$admin->hasRole($role->name)?'checked':''}}>{{$role->display_name}}
                </label>
                @endforeach
            </div>
            <button type="submit" class="btn btn-default">确认修改</button>
        </form>
        @stop
