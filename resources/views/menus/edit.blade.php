@extends('layouts.default')
@section('title','修改菜单')
    @section('content')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form action="{{route('menus.update',['menu'=>$menu])}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group">
                <label>菜单名称:</label>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" name="name" class="form-control" value="{{$menu->name}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>上级菜单:</label>
                <div class="row">
                    <div class="col-sm-3">
                <select class="form-control" name="parent_id">
                    <option value="0">--顶级分类--</option>
                    @foreach($menuss as $menus)
                        <option value="{{ $menus->id }}" {{$menu->parent_id==$menus->id?'selected':''}} {{$menu->id==$menus->id?'disabled':''}}>{{ $menus->name }}</option>
                    @endforeach
                </select>
            </div>
            </div>
            </div>

            <div class="form-group">
                <label>地址|路由:</label>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" name="route" class="form-control" value="{{$menu->route}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>序号:</label>
                <div class="row">
                    <div class="col-sm-2">
                        <input type="text" name="sort" class="form-control" value="{{$menu->sort}}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-default">确认修改</button>
        </form>
        @stop
@section('js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@stop