<?php

namespace App\Http\Controllers;

use App\Email;
use App\Member;
use Illuminate\Http\Request;
use App\Cat;
use App\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\Mail;

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
        if (!Auth::user()->can('members.create')){
            return 403;
        }
        $cats=Cat::all();
        return view('members.create',compact('cats'));
    }

    //店铺保存
    public function store(Request $request, Member $member){
        if (!Auth::user()->can('members.store')){
            return 403;
        }
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
    public function index(Request $request,Member $member)
    {
        if (!Auth::user()->can('members.index')){
            return 403;
        }
        $cats=Cat::all();
//        $members=DB::table('shops')
//            ->join('members','shops.id','=','members.shop_id')
//            ->join('cats','members.cat_id','=','cats.id')
//            ->paginate(3);
//        dd($members);
        $keywords = $request->keywords;
        $wheres=[];
        if($keywords){
            $wheres[]=["name",'like',"%{$keywords}%"];
        }
        $members = Member::where($wheres)->paginate(3);
//        dd($members);
        return view('members.index',compact('members','cats','keywords','member'));

    }

    //显示修改表单
    public function edit(Member $member)
    {
        if (!Auth::user()->can('members.edit')){
            return 403;
        }
        $cats=Cat::all();
        return view('members.edit',compact('member','cats'));
    }

    //修改信息保存
    public function update(Request $request,Member $member){
        if (!Auth::user()->can('members.update')){
            return 403;
        }
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
        if (!Auth::user()->can('members.show')){
            return 403;
        }
        $cats=Cat::all();
        return view("members.show",compact('member','cats'));
    }

    //修改该审核状态
    public function change(Member $member)
    {
        if (!Auth::user()->can('members.change')){
            return 403;
        }
//        dump($member);exit;

        $member->update(
            [
                'status'=>1,
            ]
        );
        $email= $member->email;
        $name=$member->name;

        Email::email($email,$name);

        session()->flash('success','审核通过!');
        return redirect()->route('members.index');
    }

    //删除店铺
    public function destroy(Member $member)
    {
        if (!Auth::user()->can('members.destroy')){
            return 403;
        }
        $member->delete();
        echo 'success';
    }
}
