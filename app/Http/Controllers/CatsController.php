<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use OSS\Core\OssException;

class CatsController extends Controller
{
    //必须先登录
//    public function __construct()
//    {
//        $this->middleware('auth',[
//            'except'=>[]
//        ]);
//    }
    //添加分类页面
    public function create()
    {
        if (!Auth::user()->can('cats.create')){
            return 403;
        }
        return view('cats.create');
    }

    //添加分类保存
    public function store(Request $request)
    {
        if (!Auth::user()->can('cats.store')){
            return 403;
        }
        //验证信息
        $this->validate($request,
            [
               'cat_name'=>'required',
                'logo'=>'required'
            ],
            [
                'cat_name.required'=>'商品分类名不能为空!',
                'logo.required'=>'上传图片不能为空!',
            ]);

        //保存上传logo
//        $uploder= new ImageUploadHandler();
//        $res=$uploder->save($request->logo,'Cats/logo',0);
//        if($res){
//            $fileName=$res['path'];
//        }else{
//            $fileName='';
//        }
//        $client = App::make('aliyun-oss');
//        try{
//            $client->uploadFile('wei-eleb-shop','public'.$fileName,public_path($fileName));
//        }catch (OssException $e){
//            printf($e->getMessage() . "\n");
////            return;
//        }
//        $url='https://wei-eleb-shop.oss-cn-beijing.aliyuncs.com/public';
        //保存商铺分类
        Cat::create(
            [
                'cat_name'=>$request->cat_name,
                'logo'=>$request->logo,
            ]
        );
        session()->flash('success','添加商铺分类成功');
        return redirect()->route('cats.index');
    }

    //显示商铺分类首页
    public function index(){
        if (!Auth::user()->can('cats.index')){
            return 403;
        }
        $cats=Cat::all();
        return view('cats.index',compact('cats'));
    }

    //显示管理员详情页
    public function show(Cat $cat)
    {
        if (!Auth::user()->can('cats.show')){
            return 403;
        }
        return view('cats.show',compact('cat'));
    }

    //修改商铺分类
    public function edit(Cat $cat)
    {
        if (!Auth::user()->can('cats.edit')){
            return 403;
        }
//        dump($cat);exit;
        return view('cats.edit',compact('cat'));
    }
    
    //修改更新保存
    public function update(Request $request,Cat $cat)
    {
        if (!Auth::user()->can('cats.update')){
            return 403;
        }
        //验证
        $this->validate($request,
            [
                'cat_name'=>'required',
            ],
            [
                'cat_name.required'=>'商铺分类名不能为空!',
            ]);

        //保存店铺分类
        if ($request->logo){
            $cat->update(
                [
                    'cat_name'=>$request->cat_name,
                    'logo'=>$request->logo,
                ]
            );
        }else{
            $cat->update(
                [
                    'cat_name'=>$request->cat_name,
                    'logo'=>$cat->logo,
                ]
            );
        }
        session()->flash('success', '修改成功~');
        return redirect()->route('cats.index',compact('cat'));
    }

    //删除店铺分类
    public function destroy(Cat $cat)
    {
        $cat->delete();
        echo 'success';
    }
}
