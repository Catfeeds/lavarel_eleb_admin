<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    //查看菜品销量统计
    public function count(Request $request)
    {

        //获取当月起始时间
        $first_day=date('Y-m-01',time());
//  $oneday=strtotime($first_day);
//获取当月月末
        $last_day=date('Y-m-d',strtotime("$first_day +1 month -1 day"));

//  $endday=strtotime($last_day);
        $goods=DB::select("select  sum(og.count) as `count`,og.goods_name,o.shop_name from orders as o JOIN order_goods as og on og.order_id = o.id  where o.order_birth_time >= ? AND o.order_birth_time <= ?    GROUP  BY o.shop_name,og.goods_name ORDER BY `count` DESC ",[$first_day,$last_day]);
        $sum_notime=0;
        $sum=0;
        foreach ($goods as $good){
            $sum_notime +=$good->count;
        }
//        return view("sales.count");
        //查询的日期
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        //没有查询日期
        if ($start_time===null || $end_time===null){

            $meals =null;

            return view('sales.count',compact('meals','sum_notime','goods','sum'));

        }
        //有查询日期
        if ($start_time&&$end_time){
            //获取当月起始时间
            $first_day=date('Y-m-01',time());
//  $oneday=strtotime($first_day);
//获取当月月末
            $last_day=date('Y-m-d',strtotime("$first_day +1 month -1 day"));

//  $endday=strtotime($last_day);
            $goods=DB::select("select  sum(og.count) as `count`,og.goods_name,o.shop_name from orders as o JOIN order_goods as og on og.order_id = o.id  where o.order_birth_time >= ? AND o.order_birth_time <= ?    GROUP  BY o.shop_name,og.goods_name ORDER BY `count` DESC ",[$first_day,$last_day]);
            $sum_notime=0;
            $sum=0;
            foreach ($goods as $good){
                $sum_notime +=$good->count;
            }
            //查询菜品
            $meals = DB::table('order_goods')
                ->join('orders','order_goods.order_id','=','orders.id')
                ->join('shops','orders.shop_id','=','shops.id')
                ->select('shops.shop_name','order_goods.goods_name',DB::raw('sum(order_goods.count) as count'))
                ->groupBy('order_goods.goods_name','shops.shop_name')
                ->orderBy('count','desc')
                ->where([
                    ['order_birth_time', '>', date('Y-m-d', strtotime($start_time))],
                    ['order_birth_time', '<', date('Y-m-d', strtotime($end_time)+3600*24)],
                ])
                ->get();
        }

//        dd($meals);
        foreach ($meals as $meal){
            $sum +=$meal->count;
        }
//        dd($meal);
        return view('sales.count',compact('meals','sum','goods','sum_notime'));
    }
}
