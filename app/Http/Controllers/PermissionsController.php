<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    //添加权限
    public function create()
    {
        return view('permissions.create');
    }

    //添加保存
    public function store(Request $request)
    {
        //验证信息
        $this->validate($request,
            [
                'name'=>'required|unique:permissions',
                'display_name'=>'required',
                'description'=>'required',
            ],
            [
                'name.required'=>'权限名不能为空!',
                'name.unique'=>'权限名不能重复!',
                'display_name.required'=>'权限显示名称不能为空!',
                'description.required'=>'权限描述不能为空!',
            ]);
        //保存权限信息
        Permission::create(
            [
                'name'=>$request->name,
                'display_name'=>$request->display_name,
                'description'=>$request->description,
            ]
        );
        session()->flash('success','添加权限成功');
        return redirect()->route('permissions.index');
    }

    //显示权限列表
    public function index()
    {
        $permissions=Permission::paginate(5);
        return view('permissions.index',compact('permissions'));
    }

    //修改权限表单
    public function edit(Permission $permission)
    {
        return view('permissions.edit',compact('permission'));
    }

    //修改保存
    public function update(Request $request,Permission $permission)
    {

        //验证
        $this->validate($request,
            [
                'name'=>'required|unique:permissions',
                'display_name'=>'required',
                'description'=>'required',
            ],
            [
                'name.required'=>'权限名不能为空!',
                'name.unique'=>'权限名不能重复!',
                'display_name.required'=>'权限显示名称不能为空!',
                'description.required'=>'权限描述不能为空!',
            ]);

//        dd($request);
        //保存更新信息
        $permission->update(
            [
                'name'=>$request->name,
                'display_name'=>$request->display_name,
                'description'=>$request->description,
            ]
        );
        session()->flash('success', '修改成功~');
        return redirect()->route('permissions.index',compact('permission'));
    }

    //权限详情
    public function show(Permission $permission)
    {
        return view('permissions.show',compact('permission'));
    }

    //删除权限
    public function destroy(Permission $permission)
    {
        $permission->delete();
        echo 'success';

        $roles=Role::all();
//        dd($roles);
        //把角色里有这个权限的移除掉
        $roles->detachPermissions($permission);


    }
}
