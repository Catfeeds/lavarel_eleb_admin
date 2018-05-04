@extends('layouts.default')
@section('title','修改商铺分类')
    @section('content')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form action="{{route('cats.update',['cat'=>$cat])}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group">
                <label>商铺分类名:</label>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" name="name" class="form-control" value="{{$cat->name}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email">原logo图片：</label><br/>
                <img src="@if($cat->logo){{ $cat->logo }}@endif" class="img-circle img-circle" style="width: 150px">
            </div>

            <div class="form-group">
                <label for="logo">图片:</label>
                <input type="hidden" name="logo" id="logo" class="form-control">
            </div>

            <div class="form-group">
                <!--dom结构部分-->
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
            </div>
            <div class="form-group">
                <img src="" id="img" style="width: 150px"/>
            </div>

            <button type="submit" class="btn btn-default">确认修改</button>
        </form>
        @stop
@section('js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf: '/webuploader/Uploader.swf',

            // 文件接收服务端。
            server: '/upload',
            formData:{'_token':"{{csrf_token()}}",'dir':'Cats/logo/edit'},

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file,response ) {
//            $( '#'+file.id ).addClass('upload-state-done');
            //回显图片
            var url=response.url;
            $("#img").attr('src',url);
            //回显url地址
            $("#logo").val(url);
        });

    </script>
@stop