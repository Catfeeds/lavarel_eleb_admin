@extends('layouts.default')
@section('title','查看平台菜品销量')
@section('content')
    <table class="table table-responsive">
        <tr>
            <th style="text-align: center" colspan="2">菜品销量</th>
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
            <th>店铺</th>
            <th>菜品名</th>
            <th>销量</th>
        </tr>
        @if($meals)
        @foreach($meals as $meal)
            <tr>
                <td>{{$meal->shop_name}}</td>
                <td>{{$meal->goods_name}}</td>
                <td>{{$meal->count}}条</td>
            </tr>
        @endforeach
        @endif
        <tr>
            <td colspan="2">总销量</td>
            <td>{{$sum}}条</td>
        </tr>
    </table>
    <div class="row">
        <div class="col-sm-3">
            <table class="table table-bordered">
                <tr>
                    <th style="text-align: center" colspan="3">当月销量</th>
                </tr>
                <tr>
                    <td>店铺</td>
                    <td>菜品</td>
                    <td>销量</td>
                </tr>
                @foreach($goods as $good)
                    <tr>
                        <td>{{$good->shop_name}}</td>
                        <td>{{$good->goods_name}}</td>
                        <td>{{$good->count}}条</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">总销量</td>
                    <td>{{$sum_notime}}条</td>
                </tr>
            </table>
        </div>

    </div>

@stop