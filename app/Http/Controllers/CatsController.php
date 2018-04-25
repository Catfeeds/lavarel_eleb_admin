<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
        return view('cats.create');
    }

    //添加分类保存
    public function store(Request $request)
    {
        //验证信息
        $this->validate($request,
            [
               'name'=>'required',
                'logo'=>'required'
            ],
            [
                'name.required'=>'商品分类名不能为空!',
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
                'name'=>$request->name,
                'logo'=>$request->logo,
            ]
        );
        session()->flash('success','添加商铺分类成功');
        return redirect()->route('cats.index');
    }

    //显示商铺分类首页
    public function index(){
        $cats=Cat::all();
        return view('cats.index',compact('cats'));
    }

    //显示管理员详情页
    public function show(Cat $cat)
    {
        return view('cats.show',compact('cat'));
    }

    //修改商铺分类
    public function edit(Cat $cat)
    {
//        dump($cat);exit;
        return view('cats.edit',compact('cat'));
    }
    
    //修改更新保存
    public function update(Request $request,Cat $cat)
    {
        //验证
        $this->validate($request,
            [
                'name'=>'required',
            ],
            [
                'name.required'=>'商铺分类名不能为空!',
            ]);

        //保存店铺分类
        if ($request->logo){
            $cat->update(
                [
                    'name'=>$request->name,
                    'logo'=>$request->logo,
                ]
            );
        }else{
            $cat->update(
                [
                    'name'=>$request->name,
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
