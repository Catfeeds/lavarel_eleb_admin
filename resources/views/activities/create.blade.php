@extends('layouts.default')
@section('title','添加活动')
    @section('content')
        <form action="{{route('activities.store')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label>活动标题名:</label>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" name="title" class="form-control" placeholder="活动标题" value="{{old('title')}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>活动内容:</label>
                <script id="ue-container" name="detail"  type="text/plain">{!! old('detail') !!}</script>
            </div>

            <div class="form-group">
                <label>活动开始时间:</label>
                <div class="row">
                <div class="col-sm-2">
                    <input type="date" name="start" class="form-control" value="{{old('start')}}">
                </div>
            </div>

            <div class="form-group">
                <label>活动结束时间:</label>
                <div class="row">
                    <div class="col-sm-2">
                        <input type="date" name="end" class="form-control" value="{{old('end')}}">
                    </div>
            </div>
            <button type="submit" class="btn btn-default">确认添加</button>
        </form>
        @stop
@section('js')

    <!-- ueditor-mz 配置文件 -->
    <script type="text/javascript" src="{{asset('ueditor/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('ueditor/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('ue-container');
        ue.ready(function(){
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });
    </script>

    @stop