@extends('layouts.default')
@section('title','管理员登录')
    @section('content')
        <form method="post" action="{{ route('login') }}">
            <div class="form-group">
                <label for="username">用户名</label>
                <input type="text" name="name" class="form-control" id="username" placeholder="用户名" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="密码">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="rememberMe" @if(old('rememberMe')) checked @endif> 记住我
                </label>
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-default">登录</button>
        </form>
        <button class="btn btn-default"><a href="{{route('admins.create')}}">若无管理员号,请先注册</a></button>
    @stop

