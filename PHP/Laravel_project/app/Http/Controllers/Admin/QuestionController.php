<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Question;
use Excel;
use Input;
use App\Admin\Paper;
class QuestionController extends Controller
{
    public function index()
    {
        //获取数据
        $data = Question::get();
        return view('admin.question.index',compact('data'));
    }



    // 导出操作的函数
    public function export()
    {
        // 获取数据
        $data = Question::get();
        // 定义Excel数据表头
        $cellData[]=['序号','题干','选项','答案','分值','添加时间'];
        foreach ($data as $key => $value) {
            // value是对象
            $cellData[]=[              
                $value ->id,
                $value ->question,
                $value ->options,
                $value ->answer,
                $value ->score,
                $value ->created_at,
            ];
        }
        //导出文件(下载)
        Excel::create(sha1(time() . rand(1000,9999)),function($excel) use ($cellData){
            $excel->sheet('题库', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
       })->store('xls')->export('xls');

    }

    // 导入操作的函数
    public function import()
    {
       if(Input::method()=='POST'){
            
            $excelpath = '.'.Input::get('excelpath');
            $paper_id =Input::get('paper_id');
            // 上传文件处理
            Excel::load($excelpath,function($reader) use ($paper_id){
                  $data = $reader ->getSheet(0)->toArray();

                  $tmp = [];
                  foreach ($data as $key => $value) {
                      if($key == '0'){
                          continue;
                      }else{
                         $tmp[]= [
                            
                            'question' => $value[0],
                            'paper_id' => $paper_id,
                            'score'    => $value[3],
                            'options'  => $value[1],
                            'answer'   => $value[2],
                            'created_at' => date('Y-m-d H:i:s')
                         ];
                      }
                  }
                //写入数据
                $result = Question::insert($tmp);
                // 判断
                $response =$result?'0':'1';
                echo $response;
            });
       }else{

            //获取试卷列表
            $list = Paper::get();
            return view('admin.question.import',compact('list'));
       }
    }


}
