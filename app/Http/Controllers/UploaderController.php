<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use OSS\Core\OssException;

class UploaderController extends Controller
{
    //上传
    public function upload(Request $request)
    {
//        dd($request->file('file'));
        //保存上传logo
        $uploder= new ImageUploadHandler();
        $res=$uploder->save($request->file,$request->dir,0);
        if($res){
            $fileName=$res['path'];
        }else{
            $fileName='';
        }
//        dd($fileName);
        $client = App::make('aliyun-oss');
        try{
            $client->uploadFile('wei-eleb-shop','public'.$fileName,public_path($fileName));
        }catch (OssException $e){
            printf($e->getMessage() . "\n");
//            return;
        }
        $url='https://wei-eleb-shop.oss-cn-beijing.aliyuncs.com/public';
        return ['url'=>$url.$fileName];
    }
}
