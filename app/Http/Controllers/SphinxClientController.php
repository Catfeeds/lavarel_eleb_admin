<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Member;
use App\SphinxClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SphinxClientController extends Controller
{
    //查询功能
    public function search(Request $request,Member $member)
    {
//        dd($request->keywords);
        $cl = new SphinxClient();
        $cl->SetServer ( '127.0.0.1', 9312);
//$cl->SetServer ( '10.6.0.6', 9312);
//$cl->SetServer ( '10.6.0.22', 9312);
//$cl->SetServer ( '10.8.8.2', 9312);
        $cl->SetConnectTimeout ( 10 );
        $cl->SetArrayResult ( true );
// $cl->SetMatchMode ( SPH_MATCH_ANY);
        $cl->SetMatchMode ( SPH_MATCH_EXTENDED2);
        $cl->SetLimits(0, 1000);
        $info = $request->keywords;
        $res = $cl->Query($info, 'shops');//shopstore_search
//print_r($cl);
//    print_r($res);die;
        if ($res['total']){
            //获取店铺id的数据
            $ids=collect($res['matches'])->pluck('id')->toArray();
            $members=DB::table('shops')
                ->join('members','shops.id','=','members.shop_id')
                ->join('cats','members.cat_id','=','cats.id')
                ->whereIn('shops.id',$ids)
                ->paginate(3);
            $cats=Cat::all();
//            dd($members);
            return view('members.index',compact('members','keywords','cats','member'));
        }else{
            //没有数据
            session()->flash('warning','没有找到与'.$request->keywords.'相关的商品'.',请重新搜索!');
            $cats=Cat::all();
            $members=DB::table('shops')
                ->join('members','shops.id','=','members.shop_id')
                ->join('cats','members.cat_id','=','cats.id')
                ->paginate(3);
//            dd($members);
            return redirect()->route('members.index',compact('members','cats','member'));
        }
    }

}
