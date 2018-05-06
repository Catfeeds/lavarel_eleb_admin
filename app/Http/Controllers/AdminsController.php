<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
//    //先登录
//    public function __construct()
//    {
//        $this->middleware('auth', [
//            'except' => ['create','store']
//        ]);
//    }

    //添加超级管理员

    public function create()
    {

        $roles=Role::all();
        return view('admins.create',compact('roles'));
    }

    //保存超级管理员
    public function store(Request $request)
    {

//        dd($request);
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

        $admin=Admin::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]
        );
//        $admin->name=$request->name;
//        $admin->email=$request->email;
//        $admin->password=bcrypt($request->password);
//        $admin=new Admin();
        $admin->roles()->sync($request->role_id);

        session()->flash('success', '添加成功');
        return redirect()->route('login');
    }


    //管理员列表
    public function index()
    {
        if (!Auth::user()->can('admins.index')){
            return 403;
        }
        $admins=Admin::paginate(3);
        return view('admins.index',compact('admins'));
    }

    //管理员详情
//    public function show(Admin $admin)
//    {
//
//        return view('admins.show',compact('admin'));
//    }

    //修改管理员
    public function edit(Admin $admin)
    {
        if (!Auth::user()->can('admins.edit')){
            return 403;
        }
        $roles=Role::all();
        return view('admins.edit',compact('arr','roles','admin'));
    }

    //更新信息
    public function update(Request $request,Admin $admin)
    {
        if (!Auth::user()->can('admins.update')){
            return 403;
        }
        //验证信息
        $this->validate($request,
            [
                'name'=>'required',
                'email'=>'required',
            ],
            [
                'name.required'=>'角色名不能为空!',
                'email.required'=>'邮箱不能为空!',
            ]);

//        dd($request);
        //修改更新管理员

        $admin->update(
            [
                'name' => $request->name,
                'email' => $request->email,
            ]
        );

//        保存更新信息
        $admin->syncRoles($request->role_id);

//        跳转页面
        session()->flash('success','修改管理员成功!');
        return redirect()->route('admins.index',compact('admin'));
    }

    //修改密码
    public function pwd_edit(Admin $admin)
    {
//        dump(session()->all());exit;
//        dump($admin);exit;
        return view('admins.pwd_edit', compact('admin'));
    }

    //保存修改的密码
    public function pwd_edit_save(Request $request, Admin $admin)
    {
        //验证
//        dd($request);
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

    //删除管理员
    public function destroy(Admin $admin)
    {
        $admin->delete();
        echo 'success';
    }
}
