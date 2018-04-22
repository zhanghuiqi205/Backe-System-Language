<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Lesson;
use Input;
class LessonController extends Controller
{
    //播放表列表
    public function index()
    {
       $data = Lesson::get();
       return view('admin.lesson.index',compact('data'));
    }
    public function play()
    {
        // 获取播放视频的id
        $id = Input::get('id');
        // 通过当前id去查询所需要数据
        $data = Lesson::find($id);
        //播放视频
        return "<video src='{$data -> video_addr}' width='100%' controls='controls'>您的浏览器不支持video标签</video>";
    }
}
