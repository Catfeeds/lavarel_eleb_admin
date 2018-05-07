@extends('layouts.default')
@section('title','添加奖品')
    @section('content')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form action="{{route('event_prizes.update',['event_prize'=>$event_prize])}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group">
                <label>奖品名:</label>
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" name="prize_name" class="form-control" value="{{$event_prize->prize_name}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>奖品描述:</label>
                <input type="text" name="description" class="form-control" value="{{$event_prize->description}}">
            </div>

            <div class="form-group">
                <label>所属活动</label>
                <select class="form-control" name="events_id">
                    <option value="">--选择活动--</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}" {{$event->id==$event_prize->events_id?'selected':''}}>{{ $event->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-default">确认添加</button>
        </form>
        @stop
