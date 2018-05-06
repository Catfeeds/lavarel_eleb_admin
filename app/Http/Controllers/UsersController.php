<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //查询会员列表
    public function index()
    {
        if (!Auth::user()->can('users.index')){
            return 403;
        }
        $users=User::paginate(5);
        return view('users.index',compact('users'));
    }

    //查询会员详情
    public function show(User $user)
    {
        if (!Auth::user()->can('users.show')){
            return 403;
        }
        return view('users.show',compact('user'));
    }

    //禁用会员
    public function disable(User $user)
    {
        if (!Auth::user()->can('users.disable')){
            return 403;
        }
//        dd($user);
        DB::table('users')->where('id',$user->id)->update(
           [
               'status'=>-1,
           ]
        );
//        dd($user);
        session()->flash('danger','成功禁用!');
        return redirect()->route('users.index');
    }

    //恢复会员
    public function enable(User $user)
    {
        if (!Auth::user()->can('users.enable')){
            return 403;
        }
        DB::table('users')->where('id',$user->id)->update(
            [
                'status'=>0,
            ]
        );
        session()->flash('success','成功恢复!');
        return redirect()->route('users.index');
    }
}
