<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    //添加角色表单页面
    public function create()
    {
        if (!Auth::user()->can('roles.create')){
            return 403;
        }
        $permissions=Permission::all();
        return view('roles.create',compact('permissions'));
    }

    //添加保存
    public function store(Request $request)
    {
        if (!Auth::user()->can('roles.store')){
            return 403;
        }
//        dd($request);
        //验证信息
        $this->validate($request,
            [
                'name'=>'required|unique:roles',
                'display_name'=>'required',
                'description'=>'required',
            ],
            [
                'name.required'=>'角色名不能为空!',
                'name.unique'=>'角色名不能重复!',
                'display_name.required'=>'角色显示名称不能为空!',
                'description.required'=>'角色描述不能为空!',
            ]);

        //保存角色信息
        $admin=new Role();
        $admin->name         = $request->name;
        $admin->display_name = $request->display_name;
        $admin->description  = $request->description;
        $admin->save();

        //给角色分配权限
        $admin->permissions()->sync($request->permission_id);

        //跳转页面
        session()->flash('success','添加角色成功!');
        return redirect()->route('roles.index');

    }

    //角色列表
    public function index()
    {
        if (!Auth::user()->can('roles.index')){
            return 403;
        }
        $roles=Role::paginate(3);
        return view('roles.index',compact('roles'));
    }

    //修改角色表单
    public function edit(Role $role)
    {
        if (!Auth::user()->can('roles.edit')){
            return 403;
        }
        //获取中间关系数据
        $role_permissions=$role->permissions()->get();
//        dd($role_permissions);

//        dd($arr);
        $permissions=Permission::all();
        return view('roles.edit',compact('arr','permissions','role'));
    }

    //更新信息
    public function update(Request $request,Role $role)
    {
        if (!Auth::user()->can('roles.update')){
            return 403;
        }
        //验证信息
        $this->validate($request,
            [
                'name'=>'required',
                'display_name'=>'required',
                'description'=>'required',
            ],
            [
                'name.required'=>'角色名不能为空!',
                'name.unique'=>'角色名不能重复!',
                'display_name.required'=>'角色显示名称不能为空!',
                'description.required'=>'角色描述不能为空!',
            ]);

//        dd($request);
        //修改更新角色

        $role->update(
            [
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description'  => $request->description,
            ]
        );

//        保存更新信息
        $role->syncPermissions($request->permission_id);

//        跳转页面
        session()->flash('success','修改角色成功!');
        return redirect()->route('roles.index',compact('role'));
    }

    //删除角色
    public function destroy(Role $role)
    {
        $role->delete();
        echo 'success';

        $admins=Admin::all();

        //把管理员里有这个角色的移除掉

        $admins->detachRole($role);


    }
}
