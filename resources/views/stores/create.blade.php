@extends('layouts.default')
@section('title', '添加店铺')

@section('content')

    <form method="POST" action="{{ route('stores.store') }}" enctype="multipart/form-data">

        {{csrf_field()}}
        <div class="form-group">
            <label for="name">店铺名：</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="name">手机号：</label>
            <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
        </div>

        <div class="form-group">
            <label for="password">密码：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>

        <div class="form-group">
            <label for="password_confirmation">确认密码：</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
        </div>

        <div class="form-group">
            <label for="cat_id">商品类型：</label>
            <select class="form-control" name="cat_id">
                <option value="0" >====请选择====</option>
                @foreach($cats as $cat)
                    <option value="{{ $cat->id }}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>图片上传:</label>
            <input type="file" name="store_img">
        </div>

        <div class="form-group">
            <label>商品详情：</label>
            <textarea class="form-control" name="detail">{{ old('detail') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">确认添加</button>
    </form>

    @stop