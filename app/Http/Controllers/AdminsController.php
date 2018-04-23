<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    //先登录
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['create','store']
        ]);
    }

    //添加超级管理员

    public function create()
    {

        return view('admins.create');
    }

    //保存超级管理员
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:2|max:30',
                'password' => 'required|min:6|confirmed',
                'captcha' => 'required|captcha',
                'email'=>'required|email',
            ],
            [
                'name.required' => '用户名不能为空!',
                'password.required' => '密码不能为空!',
                'name.min' => '用户名不能低于2位!',
                'password.min' => '密码不能低于6位!',
                'password.confirmed' => '前后两次密码输入不一致!',
                'email.required'=>'邮箱不能为空!',
                'email.email'=>'请填写合法的邮箱!',
                'captcha.required' => '验证码不能为空',
                'captcha.captcha' => '请输入正确的验证码',

            ]);
        Admin::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]
        );
        session()->flash('success', '添加成功');
        return redirect()->route('login');
    }


    //修改密码
    public function edit(Admin $admin)
    {
//        dump(session()->all());exit;
//        dump($admin);exit;
        return view('admins.edit', compact('admin'));
    }

    //保存修改的密码
    public function update(Request $request, Admin $admin)
    {
        //验证
//        dump($request);exit;
        if (!empty($request->old_password)) {
            if (Hash::check($request->old_password, $admin->password)) {
                $this->validate($request,
                    [
                        'old_password' => 'required',
                        'password' => 'required|min:6|confirmed',
                    ],
                    [
                        'old_password.required' => '旧密码不能为空!',
                        'password.required' => '新密码不能为空!',
                        'password.min' => '新密码不能低于6位!',
                        'password.confirmed' => '前后两次密码输入不一致!',
                    ]);
                $admin->update(
                    [
                        'password' => bcrypt($request->password),
                    ]
                );
                Auth::logout();
                session()->flash('success', '修改密码成功,请重新登录!');
                return redirect()->route('login', compact('admin'));
            }
        }
        session()->flash('warning', '修改失败,返回首页');
        return redirect()->route('home');
    }

}
