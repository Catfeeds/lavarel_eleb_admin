@extends('layouts.default')
@section('title',$member->shop->shop_name)
    @section('content')
        <p style="color:#c8c8cf;font-size: 24px">店铺详情</p>
        <dl class="dl-horizontal col-xs-7">
            <dt>店铺名称</dt>
            <dd>{{$member->shop->shop_name}}</dd>
            <dt>店铺图片</dt>
            <dd><img src="{{$member->shop->shop_img}}" alt="未上传" width="200"></dd>
            <dt>店铺所属分类</dt>

                <dd>{{$member->shop_cat->name}}</dd>

            <dt>店铺是否为品牌</dt>
            <dd>{{$member->shop->brand==1?'是':'否'}}</dd>
            <dt>店铺是否准时达</dt>
            <dd>{{$member->shop->on_time==1?'是':'否'}}</dd>
            <dt>店铺是否蜂鸟配送</dt>
            <dd>{{$member->shop->fengniao==1?'是':'否'}}</dd>
            <dt>店铺是否晚到必赔</dt>
            <dd>{{$member->shop->promise==1?'是':'否'}}</dd>
            <dt>店铺是否开具发票</dt>
            <dd>{{$member->shop->piao==1?'是':'否'}}</dd>
            <dt>起送价</dt>
            <dd>{{$member->shop->start_send}}元</dd>
            <dt>配送费</dt>
            <dd>{{$member->shop->send_cost}}元</dd>
            <dt>预约时间</dt>
            <dd>{{empty($member->shop->estimate_time)?'未设置':$member->shop->estimate_time}}</dd>
            <dt>店铺公告</dt>
            <dd>{{empty($member->shop->notice)?'未设置':$member->shop->notice}}</dd>
            <dt>店铺优惠</dt>
            <dd>{{empty($member->shop->discount)?'未设置':$member->shop->discount}}</dd>
            <dt>审核状态</dt>
            <dd>{{$member->status==0?'未通过':'通过'}}</dd>
            <dt></dt><dd></dd>
            <dt></dt>
            <dd>
                <a href="{{route('members.edit',['member'=>$member])}}" class="btn btn-warning">修改店铺信息</a>
                @if($member->status==0)
                <a href="{{route('members.change',['member'=>$member])}}" class="btn btn-warning">确定通过审核</a>
                @endif
            </dd>
        </dl>
    @stop