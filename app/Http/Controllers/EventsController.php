<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $prizes=DB::table('event_prizes')->where('events_id',$event->id)->get();
        return view('events.show',compact('event','prizes'));
    }

    //查看抽奖结果
    public function result(Event $event)
    {
//        dd($event);
        $results=DB::table('event_prizes')
            ->join('members','event_prizes.member_id','=','members.id')
            ->where('events_id',$event->id)
            ->get();
//        dd($event);
        return view('events.result',compact('results','event'));
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
    public function give(Event $event)
    {
        //        dd($event);
        //查看是否有奖品
        $prize=DB::table('event_prizes')->where('events_id',$event->id)->first();
        //  dd($prize);
        if(!$prize){
            session()->flash('danger','该活动还未添加奖品');
            return redirect()->route('events.index');
        }


        //获取所有报名抽奖的人
        $member_ids=DB::table('event_members')
            ->where('events_id',$event->id)
            ->pluck('member_id');
//        dd($member_ids);
        //获取活动奖品
        $prize_ids=DB::table('event_prizes')
            ->where('events_id',$event->id)
            ->pluck('id');
//        dd($prize_ids);
        //打乱抽奖人数
        $members=$member_ids->shuffle();
        //打乱活动奖品
        $prizes=$prize_ids->shuffle();
        //配对
        $res=[];
        foreach($members as $member_id){
            $prize_id=$prizes->pop();
            //奖品抽完
            if ($prize_id == null)break;
            $res[$prize_id]=$member_id;
        }
        //开启事务
        DB::transaction(function () use ($res,$event) {
            //保存数据库
            foreach ($res as $prize_id=>$member_id){
                DB::table('event_prizes')
                    ->where('id',$prize_id)
                    ->update(['member_id'=>$member_id]);
            }
            //修改活动状态
            $event->is_prize=1;
            $event->save();
        });

        //抽奖完成
        session()->flash('success','抽奖成功!');
        return redirect()->route('events.index');
    }
}
