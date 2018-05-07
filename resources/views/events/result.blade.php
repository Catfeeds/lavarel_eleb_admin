@extends('layouts.default')
@section('title',$event->title.'中奖人名单')
    @section('content')
        <table class="table table-bordered table-responsive">
            <tr>
                <th colspan="2" style="text-align: center">{{$event->title}}</th>
            </tr>
            <tr>
                <th>中奖人(排名不分先后)</th>
                <th>中奖奖品</th>
            </tr>
            @foreach($results as $result)
                <tr>
                    <td>{{$result->name}}</td>
                    <td>{{$result->prize_name}}</td>
                </tr>
            @endforeach
        </table>
    @stop