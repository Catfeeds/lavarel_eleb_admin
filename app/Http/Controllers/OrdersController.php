<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    //
    public function count(Request $request)
    {
        if (!Auth::user()->can('orders.count')){
            return 403;
        }
        $time_day=date('Y-m-d',time());
//        dd($time);
        $where=[
            ['order_birth_time','>',$time_day],
            ['order_birth_time','<',$time_day+3600*24],
        ];
        $count_day=DB::table('orders')->where($where)->count();
//        dd($count_day);

        $time_month=date('Y-m',time());
        $where_month=[
            ['order_birth_time','>',$time_month],
            ['order_birth_time','<',$time_month+'1 month'],
        ];
        $count_month=DB::table('orders')->where($where_month)->count();
//        dd($count_month);

        $count_total=DB::table('orders')->count();

        //查询的日期
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        //没有查询日期
        if ($start_time===null || $end_time===null){
            $count = 0;
        }

        //有日期
        if ($start_time&&$end_time){
            $wheres=[
                ['order_birth_time', '>', date('Y-m-d', strtotime($start_time))],
                ['order_birth_time', '<', date('Y-m-d', strtotime($end_time)+3600*24)],
            ];

            //计数
            $count = DB::table('orders')
                ->where($wheres)
                ->count();
        }
        return view('orders.count',compact('count','count_day','count_month','count_total'));
    }
}
