<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use App\Cat;
use App\Shop;
use Illuminate\Support\Facades\DB;
use App\Handlers\ImageUploadHandler;

class TestController extends Controller
{
//    //必须先登录
//    public function __construct()
//    {
//        $this->middleware('auth',[
//            'except'=>[]
//        ]);
//    }
    //添加店铺
    public function create(){
        $cats=Cat::all();
        return view('members.create',compact('cats'));
    }

    //店铺保存
    public function store(Request $request, Member $member){
        //验证店铺
        $this->validate($request,
            [
                'name'=>'required',
                'email'=>'required|email',
                'password'=>'required|min:6|confirmed',
                'cat_id'=>'required',
                'shop_img'=>'required'

            ],
            [
                'name.required'=>'店铺名不能为空!',
                'email.required'=>'邮箱不能为空!',
                'email.email'=>'请填写合法的邮箱!',
                'password.required'=>'密码不能为空!',
                'password.min'=>'密码不能低于6位!',
                'password.confirmed'=>'前后两次密码输入不一致!',
                'cat_id.required'=>'分类不能为空!',
               'shop_img.required'=>'店铺图片不能为空!'
            ]);

        //保存商品店主信息
        DB::transaction(function () use ($request) {
                        $shops=Shop::create(
                [
                    'shop_name'=>$request->shop_name,
                    'shop_img'=>$request->shop_img,
                    'brand'=>$request->brand,
                    'on_time'=>$request->on_time,
                    'fengniao'=>$request->fengniao,
                    'bao'=>$request->bao,
                    'piao'=>$request->piao,
                    'zhun'=>$request->zhun,
                    'start_send'=>$request->start_send,
                    'shop_rating'=>$request->shop_rating,
                    'send_cost'=>$request->send_cost,
                    'notice'=>$request->notice,
                    'discount'=>$request->discount,
                    'distance'=>$request->distance,
                    'estimate_time'=>$request->estimate_time,

                ]
            );

            Member::create(
                [
                    'name'=>$request->name,
                    'cat_id'=>$request->cat_id,
                    'password'=>bcrypt($request->password),
                    'status'=>'0',
                    'email'=>$request->email,
                    'detail'=>$request->detail,
                    //最后插入的id
                    'shop_id'=>$shops->id
                ]
            );
        });
        session()->flash('success','添加商铺成功,待审核');
        return redirect()->route('members.index');
    }

    //显示商铺列表
    public function index(Request $request, Member $member)
    {
        $cats=Cat::all();
        //检查是否有keywords参数,有,需要搜索,没有 不需要搜索
        $keywords = $request->keywords;
        if($keywords){
            $members = Member::where("name",'like',"%{$keywords}%")->paginate(3);
        }else{
            $members = Member::paginate(3);
        }
        return view('members.index',compact('members','keywords','cats','member'));

    }

    //显示修改表单
    public function edit(Member $member)
    {
        $cats=Cat::all();
        return view('members.edit',compact('member','cats'));
    }

    //修改信息保存
    public function update(Request $request,Member $member){
//        dump($member);exit;
//        dump($request);exit;
        $this->validate($request,
            [
                'name'=>'required',
                'email'=>'required|email',
                'cat_id'=>'required',
            ],
            [
                'name.required'=>'店铺名不能为空!',
                'email.required'=>'邮箱不能为空!',
                'email.email'=>'请填写合法的邮箱!',
                'cat_id.required'=>'分类不能为空!',
            ]);

        //保存商品店主信息
        DB::transaction(function () use ($request,$member) {
            if ($request->shop_img){
                //echo 1;exit;
                DB::table('shops')->where('id',$member->shop_id)->update(
                    [
                        'shop_name'=>$request->shop_name,
                        'shop_img'=>$request->shop_img,
                        'brand'=>$request->brand,
                        'on_time'=>$request->on_time,
                        'fengniao'=>$request->fengniao,
                        'shop_rating'=>$request->shop_rating,
                        'bao'=>$request->bao,
                        'piao'=>$request->piao,
                        'zhun'=>$request->zhun,
                        'start_send'=>$request->start_send,
                        'send_cost'=>$request->send_cost,
                        'notice'=>$request->notice,
                        'discount'=>$request->discount,
                        'distance'=>$request->distance,
                        'estimate_time'=>$request->estimate_time,
                    ]
                );
                $member->update(
                    [
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'status'=>$request->status,
                        'cat_id'=>$request->cat_id,
                        'detail'=>$request->detail,
                    ]
                );
            }else{
                DB::table('shops')->where('id',$member->shop_id)->update(
                    [
                        'shop_name'=>$request->shop_name,
                        'brand'=>$request->brand,
                        'on_time'=>$request->on_time,
                        'fengniao'=>$request->fengniao,
                        'shop_rating'=>$request->shop_rating,
                        'bao'=>$request->bao,
                        'piao'=>$request->piao,
                        'zhun'=>$request->zhun,
                        'start_send'=>$request->start_send,
                        'send_cost'=>$request->send_cost,
                        'notice'=>$request->notice,
                        'discount'=>$request->discount,
                        'distance'=>$request->distance,
                        'estimate_time'=>$request->estimate_time,
                    ]
                );
                $member->update(
                    [
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'status'=>$request->status,
                        'cat_id'=>$request->cat_id,
                        'detail'=>$request->detail,
                    ]
                );
            }
        });
        session()->flash('success', '修改成功~');
        return redirect()->route('members.index');
    }

    //显示该商铺详情
    public function show(Member $member){
        $cats=Cat::all();
        return view("members.show",compact('member','cats'));
    }

    //修改该审核状态
    public function change(Member $member)
    {
//        dump($member);exit;
        $member->update(
            [
                'status'=>1,
            ]
        );
        session()->flash('success','审核通过!');
        return redirect()->route('members.index');
    }

    //删除店铺
    public function destroy(Member $member)
    {
        $member->delete();
        echo 'success';
    }
}
