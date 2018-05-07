<?php

namespace App\Http\Controllers;

use App\Event;
use App\Member;
use Illuminate\Http\Request;

class Event_membersController extends Controller
{
    //查看报名情况列表
    public function index()
    {
        $events=Event::all();
        $members=Member::all();
        return view('event_members.index',compact('events','members'));
    }
    

}
