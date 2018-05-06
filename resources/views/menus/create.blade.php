@extends('layouts.default')
@section('title','添加菜单')
    @section('content')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form action="{{route('menus.store')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label>菜单名称:</label>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" name="name" class="form-control" placeholder="菜单名称" value="{{old('name')}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>上级菜单:</label>
                <div class="row">
                    <div class="col-sm-3">
                <select class="form-control" name="parent_id">
                    <option value="">--选择上级分类--</option>
                    <option value="0">--顶级分类--</option>
                    @foreach($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach
                </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>地址|路由:</label>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" name="route" class="form-control" placeholder="请填写地址或路由..." value="{{old('route')}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>序号:</label>
                <div class="row">
                    <div class="col-sm-2">
                        <input type="text" name="sort" class="form-control" placeholder="请填写序号" value="{{old('sort')}}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-default">确认添加</button>
        </form>
        @stop
@section('js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@stop