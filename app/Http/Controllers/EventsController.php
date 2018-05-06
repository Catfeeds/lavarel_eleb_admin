<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    //添加抽奖活动
    public function create()
    {
        return view('events.create');
    }

    //添加抽奖活动保存
    public function store(Request $request)
    {
//        dd($request);
        //验证
        $this->validate($request,
            [
                'title'=>'required',
                'detail'=>'required',
                'signup_start'=>'required|after:today',
                'signup_end'=>'required|after:signup_start',
                'prize_date'=>'required|after:signup_end',
                'signup_num'=>'required',
            ],
            [
                'title.required'=>'活动标题不能为空!',
                'detail.required'=>'活动内容不能为空!',
                'signup_start.required'=>'抽奖报名开始时间不能为空!',
                'signup_start.after'=>'抽奖报名开始时间必须从下一天开始',
                'signup_end.required'=>'抽奖报名结束时间不能为空!',
                'signup_end.after'=>'抽奖报名结束时间不能在抽奖报名开始时间之前!',
                'prize_date.after'=>'开奖时间时间不能在抽奖报名结束时间之前!',
                'signup_num.required'=>'抽奖限制人数不能为空!',
            ]);

        //保存抽奖活动信息
        Event::create([
                'title'=>$request->title,
                'detail'=>$request->detail,
                'signup_start'=>strtotime($request->signup_start),
                'signup_end'=>strtotime($request->signup_end),
                'prize_date'=>strtotime($request->prize_date),
                'signup_num'=>$request->signup_num,
            ]
        );
        session()->flash('success', '添加成功~');
        return redirect()->route('events.index');
    }

    //显示抽奖活动列表
    public function index()
    {
        $events=Event::paginate(3);
        return view('events.index',compact('events'));
    }

    //显示抽奖活动详情
    public function show(Event $event)
    {
        return view('events.show',compact('event'));
    }

    //修改抽奖活动表单
    public function edit(Event $event)
    {
        return view('events.edit',compact('event'));
    }

    //修改信息更新保存
    public function update(Request $request,Event $event)
    {
        //验证
        $this->validate($request,
            [
                'title'=>'required',
                'detail'=>'required',
                'signup_start'=>'required|after:today',
                'signup_end'=>'required|after:signup_start',
                'prize_date'=>'required|after:signup_end',
                'signup_num'=>'required',
            ],
            [
                'title.required'=>'活动标题不能为空!',
                'detail.required'=>'活动内容不能为空!',
                'signup_start.required'=>'抽奖报名开始时间不能为空!',
                'signup_start.after'=>'抽奖报名开始时间必须从下一天开始',
                'signup_end.required'=>'抽奖报名结束时间不能为空!',
                'signup_end.after'=>'抽奖报名结束时间不能在抽奖报名开始时间之前!',
                'prize_date.after'=>'开奖时间时间不能在抽奖报名结束时间之前!',
                'signup_num.required'=>'抽奖限制人数不能为空!',
            ]);

        //修改保存
        $event->update(
            [
                'title'=>$request->title,
                'detail'=>$request->detail,
                'signup_start'=>strtotime($request->signup_start),
                'signup_end'=>strtotime($request->signup_end),
                'prize_date'=>strtotime($request->prize_date),
                'signup_num'=>$request->signup_num,
            ]);
        session()->flash('success','修改成功!');
        return redirect()->route('events.index');
    }

    //删除抽奖活动
    public function destroy(Event $event)
    {
        $event->delete();
        echo 'success';
    }
    
    //抽奖开奖
    public function give()
    {
        
    }
}
