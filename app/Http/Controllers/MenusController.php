<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenusController extends Controller
{
    //添加菜单页面
    public function create()
    {
        if (!Auth::user()->can('menus.create')){
            return 403;
        }
        $menus=Menu::where('parent_id',0)->get();
        return view('menus.create',compact('menus'));
    }

    //保存菜单信息
    public function store(Request $request)
    {
        if (!Auth::user()->can('menus.store')){
            return 403;
        }
//        dd($request);
        $this->validate($request,
            [
                'name'=>'required',
                'parent_id'=>'required',
                'route'=>'required',
            ],
            [
                'name.required'=>'菜单名不能为空!',
                'parent_id.required'=>'请选择上级菜单!',
                'route.required'=>'路由或地址不能为空!',
            ]);

        //保存信息
        Menu::create(
            [
                'name'=>$request->name,
                'parent_id'=>$request->parent_id,
                'sort'=>$request->sort,
                'route'=>$request->route,
            ]
        );
        session()->flash('success', '添加成功!');
        return redirect()->route('menus.index');
    }

    //菜单列表
    public function index()
    {
        if (!Auth::user()->can('menus.index')){
            return 403;
        }
        $menus=DB::table('menus')
//            ->orderBy('name','asc')
//            ->orderBy('sort','asc')
            ->get();
//        dd($menus);
        return view('menus.index',compact('menus'));
    }

    //显示修改菜单表单
    public function edit(Menu $menu)
    {
        if (!Auth::user()->can('menus.edit')){
            return 403;
        }
        $menuss=Menu::where('parent_id',0)->get();
        return view('menus.edit',compact('menu','menuss'));
    }

    //修改菜单保存
    public function update(Request $request,Menu $menu)
    {
        if (!Auth::user()->can('menus.update')){
            return 403;
        }
        $this->validate($request,
            [
                'name'=>'required',
                'parent_id'=>'required',
                'route'=>'required',
            ],
            [
                'name.required'=>'菜单名不能为空!',
                'parent_id.required'=>'请选择上级菜单!',
                'route.required'=>'路由或地址不能为空!',
            ]);
        //更新保存
        $menu->update(
            [
                'name'=>$request->name,
                'parent_id'=>$request->parent_id,
                'sort'=>$request->sort,
                'route'=>$request->route,
            ]
        );
        //跳转
        session()->flash('success', '修改成功!');
        return redirect()->route('menus.index',compact('menu'));
    }

    //删除菜单
    public function destroy(Menu $menu)
    {
        $menu->delete();
        echo 'success';
    }
}
