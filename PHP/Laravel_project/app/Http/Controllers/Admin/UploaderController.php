<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Storage;
class UploaderController extends Controller
{
    public function webuploader(Request $request){
        // 上传操作
        if($request ->file('file')->isValid() && $request ->hasFile('file')){
            // 对文件重新命名
            $new =sha1(time().rand(1000,9999)). '.' .$request->file('file')->getClientOriginalExtension();
            // 保存文件
            $dd =Storage::disk('public') ->put($new,file_get_contents($request ->file('file') ->path()));
            // 组装返回值
            if($dd){
                // 成功
                $response =[
                    'code' => 0,
                    'msg'  =>'文件上传成功',
                    'url'  =>'/storage/'.$new
                ];

            }else{
               //失败
               $response =[
                    'code' => 1,
                    'msg'  =>$request -> file('file') ->getErrorMessage()
                ]; 
            }
            // json返回
            return response() ->json($response);
        }
    }
}
