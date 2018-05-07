@extends('layouts.default')
@section('title','添加奖品')
    @section('content')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form action="{{route('event_prizes.store')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label>奖品名:</label>
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" name="prize_name" class="form-control" placeholder="奖品名称" value="{{old('prize_name')}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>奖品描述:</label>
                <input type="text" name="description" class="form-control" placeholder="奖品描述" value="{{old('description')}}">
            </div>

            <div class="form-group">
                <label>所属活动</label>
                <select class="form-control" name="events_id">
                    <option value="">--选择活动--</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-default">确认添加</button>
        </form>
        @stop
