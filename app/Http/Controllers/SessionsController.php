<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    //平台管理员登陆
    public function create()
    {
        //如果管理员已登录,则跳转至首页
        if(Auth::user()){
            return redirect('members.index');
        }
        return view('sessions.create');
    }

    //验证保存登录信息
    public function store(Request $request)
    {
        //验证信息
        $this->validate($request,
            [
                'name'=>'required',
                'password'=>'required',
            ],
            [
                'name.required'=>'管理员名不能为空!',
                'password.required'=>'密码不能为空!',
            ]);

        if (Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('rememberMe'))){

            //登陆成功
            session()->flash('success','欢迎回来!');
            return redirect()->route('members.index');
        }else{
            //登录失败
            session()->flash('danger','登录失败,用户名或密码不正确');
            return redirect()->back()->withInput();
        }
    }

    //注销
    public function destroy()
    {
        Auth::logout();
        session()->flash('success','注销成功');
        return redirect()->route('login');
    }
}
