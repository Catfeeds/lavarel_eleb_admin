<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{

    //创建活动 表单页
    public function create()
    {
        return view('activities.create');
    }

    //活动信息保存
    public function store(Request $request)
    {
//        dd($request);
        //验证信息
        $this->validate($request,
            [
                'title'=>'required',
                'detail'=>'required',
                'start'=>'required|after:today',
                'end'=>'required|after:start',
            ],
            [
                'title.required'=>'活动标题不能为空!',
                'detail.required'=>'活动内容不能为空!',
                'start.required'=>'活动开始时间不能为空!',
                'start.after'=>'活动开始时间必须从下一天开始',
                'end.required'=>'活动结束时间不能为空!',
                'end.after'=>'活动结束时间不能在开始时间之前!',
            ]);

        //保存活动信息
        Activity::create([
            'title'=>$request->title,
            'detail'=>$request->detail,
            'start'=>strtotime($request->start),
            'end'=>strtotime($request->end),
        ]
        );
        session()->flash('success', '添加成功~');
        return redirect()->route('activities.index');
    }

    //显示活动列表
    public function index()
    {
        $activities=Activity::paginate(3);
        return view('activities.index',compact('activities'));
    }

    //显示活动详情
    public function show(Activity $activity)
    {
        return view('activities.show',compact('activity'));
    }

    //修改活动 表单
    public function edit(Activity $activity)
    {
        return view('activities.edit',compact('activity'));
    }

    //修改活动 保存更新信息
    public function update(Request $request,Activity $activity)
    {
        //验证
        $this->validate($request,
            [
                'title'=>'required',
                'detail'=>'required',
                'start'=>'required|after:today',
                'end'=>'required|after:start',
            ],
            [
                'title.required'=>'活动标题不能为空!',
                'detail.required'=>'活动内容不能为空!',
                'start.required'=>'活动开始时间不能为空!',
                'start.after'=>'活动开始时间必须从下一天开始',
                'end.required'=>'活动结束时间不能为空!',
                'end.after'=>'活动结束时间不能在开始时间之前!',
            ]);

        //保存更新
        $activity->update(
            [
                'title'=>$request->title,
                'detail'=>$request->detail,
                'start'=>strtotime($request->start),
                'end'=>strtotime($request->end),
            ]
        );
        session()->flash('success','修改成功!');
        return redirect()->route('activities.index');
    }

    //删除活动
    public function destroy(Activity $activity){
        $activity->delete();
        echo 'success';
    }
}
