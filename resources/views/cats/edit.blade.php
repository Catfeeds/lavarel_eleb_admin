@extends('layouts.default')
@section('title','修改商铺分类')
    @section('content')
        <form action="{{route('cats.update',['cat'=>$cat])}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group">
                <label>商铺分类名:</label>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" name="name" class="form-control" placeholder="商铺分类名称" value="{{$cat->name}}">
                    </div>
                </div>

            </div>

            <div class="form-group">
                <label for="email">原logo图片：</label>
                <img src="@if($cat->logo){{ $cat->logo }}@endif" class="img-circle img-circle" style="width: 50px">
            </div>

            <div class="form-group">
                <label for="exampleInputFile">logo 上传:</label>
                <input type="file" id="exampleInputFile" name="logo">
            </div>

            <button type="submit" class="btn btn-default">确认修改</button>
        </form>
        @stop