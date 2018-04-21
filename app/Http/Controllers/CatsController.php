<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;

class CatsController extends Controller
{
    //必须先登录
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]
        ]);
    }
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
                'captcha'=>'required|captcha',
                'logo'=>'image'
            ],
            [
                'name.required'=>'商品分类名不能为空!',
                'logo.image'=>'上传图片不合法!',
                'captcha.required'=>'验证码不能为空!',
                'captcha.captcha'=>'请填写正确的验证码!'
            ]);

        //保存上传logo
        $uploder= new ImageUploadHandler();
        $res=$uploder->save($request->logo,'Cats/logo',0);
        if($res){
            $fileName=$res['path'];
        }else{
            $fileName='';
        }

        //保存商铺分类
        Cat::create(
            [
                'name'=>$request->name,
                'logo'=>$fileName,
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
                'logo'=>'image',
            ],
            [
                'name.required'=>'商铺分类名不能为空!',
                'logo.image'=>'请上传合法的图片!'
            ]);

        //保存文件
        $uploder = new ImageUploadHandler();
        $res  = $uploder->save($request->logo,'Cats/logo',0);
        if($res){
            $fileName = $res['path'];
        }else{
            $fileName = '';
        }
        //保存用户
        $cat->update(
            [
                'name'=>$request->name,
                'logo'=>$fileName,
            ]
        );
        session()->flash('success', '修改成功~');
        return redirect()->route('cats.index',compact('cat'));
    }

    //删除用户
    public function destroy(Cat $cat)
    {
        $cat->delete();
        echo 'success';
    }
}
