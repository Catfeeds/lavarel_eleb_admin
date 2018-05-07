<?php

namespace App\Http\Controllers;

use App\Event_prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Event_prizesController extends Controller
{
    //抽奖奖品添加表单
    public function create()
    {
        $events=DB::table('events')->get();
//        dd($events);
        return view('event_prizes.create',compact('events'));
    }

    //抽奖奖品添加保存
    public function store(Request $request)
    {
//        dd($request);
        //验证
        $this->validate($request,
            [
                'prize_name'=>'required',
                'description'=>'required',
                'events_id'=>'required',
            ],
            [
                'prize_name.required'=>'奖品名不能为空!',
                'description.required'=>'奖品描述不能为空!',
                'events_id.required'=>'所属活动不能为空!'
            ]);

        //保存奖品
        Event_prize::create(
            [
                'prize_name'=>$request->prize_name,
                'description'=>$request->description,
                'events_id'=>$request->events_id,
                'member_id'=>0,
            ]
        );
        session()->flash('success', '添加成功~');
        return redirect()->route('event_prizes.index');
    }

    //查看奖品列表
    public function index()
    {
        $event_prizes=Event_prize::paginate(3);
        return view('event_prizes.index',compact('event_prizes'));
    }

    //查看奖品详情
    public function show(Event_prize $event_prize)
    {
//        dd($event_prize);
        return view('event_prizes.show',compact('event_prize'));
    }

    //修改奖品表单
    public function edit(Event_prize $event_prize)
    {
        $events=DB::table('events')->get();
        return view('event_prizes.edit',compact('event_prize','events'));
    }

    //修改奖品保存
    public function update(Request $request,Event_prize $event_prize)
    {

        //验证
        $this->validate($request,
            [
                'prize_name'=>'required',
                'description'=>'required',
                'events_id'=>'required',
            ],
            [
                'prize_name.required'=>'奖品名不能为空!',
                'description.required'=>'奖品描述不能为空!',
                'events_id.required'=>'所属活动不能为空!'
            ]);
//                dd($request);
        //保存更新信息
        $event_prize->update(
            [
                'prize_name'=>$request->name,
                'description'=>$request->description,
                'events_id'=>$request->events_id,
            ]
        );
        session()->flash('success', '修改成功~');
        return redirect()->route('event_prizes.index');
    }

    //删除奖品
    public function destroy(Event_prize $event_prize)
    {
        $event_prize->delete();
        echo 'success';
    }
}
