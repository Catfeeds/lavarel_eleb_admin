@extends('layouts.default')
@section('title',$store->store_info->store_name)
    @section('content')
        <p style="color:#c8c8cf;font-size: 24px">店铺详情</p>
        <dl class="dl-horizontal col-xs-7">
            <dt>店铺名称</dt>
            <dd>{{$store->store_info->store_name}}</dd>
            <dt>店铺图片</dt>
            <dd><img src="{{$store->store_info->store_img}}" alt="未上传" width="200"></dd>
            <dt>店铺所属分类</dt>

                <dd>{{$store->store_cat->name}}</dd>

            <dt>店铺是否为品牌</dt>
            <dd>{{$store->store_info->brand==1?'是':'否'}}</dd>
            <dt>店铺是否准时达</dt>
            <dd>{{$store->store_info->on_time==1?'是':'否'}}</dd>
            <dt>店铺是否蜂鸟配送</dt>
            <dd>{{$store->store_info->fengniao==1?'是':'否'}}</dd>
            <dt>店铺是否晚到必赔</dt>
            <dd>{{$store->store_info->promise==1?'是':'否'}}</dd>
            <dt>店铺是否开具发票</dt>
            <dd>{{$store->store_info->piao==1?'是':'否'}}</dd>
            <dt>起送价</dt>
            <dd>{{$store->store_info->start_send}}元</dd>
            <dt>配送费</dt>
            <dd>{{$store->store_info->send_cost}}元</dd>
            <dt>预约时间</dt>
            <dd>{{empty($store->store_info->estimate_time)?'未设置':$store->store_info->estimate_time}}</dd>
            <dt>店铺公告</dt>
            <dd>{{empty($store->store_info->notice)?'未设置':$store->store_info->notice}}</dd>
            <dt>店铺优惠</dt>
            <dd>{{empty($store->store_info->discount)?'未设置':$store->store_info->discount}}</dd>
            <dt>审核状态</dt>
            <dd>{{$store->status==0?'未通过':'通过'}}</dd>
            <dt></dt><dd></dd>
            <dt></dt>
            <dd>
                <a href="{{route('stores.edit',['store'=>$store])}}" class="btn btn-warning">修改店铺信息</a>
                @if($store->status==0)
                <a href="{{route('stores.change',['store'=>$store])}}" class="btn btn-warning">确定通过审核</a>
                @endif
            </dd>
        </dl>
    @stop