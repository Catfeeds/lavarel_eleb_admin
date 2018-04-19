@extends('layouts.default')
@section('title','添加商铺分类')
    @section('content')
        <form action="{{route('cats.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label>商铺分类名:</label>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" name="name" class="form-control" placeholder="商铺分类名称">
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label for="exampleInputFile">logo 上传:</label>
                <input type="file" id="exampleInputFile" name="logo">
            </div>

            <div class="form-group">
                <label for="name">验证码：</label>
                <div class="row">
                    <div class="col-sm-2">
                        <input id="captcha" class="form-control" name="captcha" >
                    </div>
                    <div class="col-sm-4">
                        <img class="thumbnail captcha" src="{{ captcha_src('inverse') }}" onclick="this.src='/captcha/inverse?'+Math.random()" title="点击图片重新获取验证码">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-default">确认添加</button>
        </form>



        @stop