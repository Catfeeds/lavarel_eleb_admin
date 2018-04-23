@extends('layouts.default')
@section('title','超级管理员注册')
@section('content')
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="container col-lg-9" style="background-color: #eceeee">
            <br/>
            <form  method="post" action="{{ route('admins.store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label>超级管理员名称</label>
                    <input type="text" class="form-control" placeholder="超级管理员登录名" name="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label>邮箱</label>
                    <input type="email" class="form-control" placeholder="邮箱" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label>密码</label>
                    <input type="password" class="form-control" name="password" placeholder="密码">
                </div>
                <div class="form-group">
                    <label>确认密码</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="确认密码">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">验证码</label>
                    <input id="captcha" class="form-control" name="captcha" >
                    <img class="thumbnail captcha" src="{{ captcha_src('inverse') }}" onclick="this.src='/captcha/inverse?'+Math.random()" title="点击图片重新获取验证码">
                </div>
                <button type="submit" class="btn btn-primary btn-success"> 确认添加</button>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@stop