@extends('layouts.default')
@section('title','查看平台订单销量')
@section('content')
    <table class="table table-responsive">
        <tr>
            <th style="text-align: center" colspan="2">平台订单销量</th>
        </tr>
        <tr><td colspan="2">
            <form action="" method="get">
                <input type="date" name="start_time">
                <input type="date" name="end_time">
                <input type="submit" value="查询" class="btn btn-primary btn-sm">
            </form>
            </td>
        </tr>
        <tr>
            <td>订单量</td><td>{{$count}}条</td>
        </tr>
        <tr>
            <td colspan="2">
                当天订单量  {{$count_day}}条   当月订单量   {{$count_month}}条   总计   {{$count_total}}条
            </td>
        </tr>

    </table>

@stop