<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建表
        Schema::create('lesson',function($table){
           $table ->increments('id'); //主键id
           $table ->string('lesson_name')->notNull();//点播课程的名称
           $table ->integer('course_id')->notNull();//所属的课程id
           $table ->integer('video_time')->notNull();//视频的地址
           $table ->string('video_addr')->notNull();//视频的长度
           $table ->integer('sort')->notNull()->default(0);//排序
           $table ->string('description')->notNull();//描述
           $table ->timestamps();
           $table ->enum('status',[1,2])->notNull()->default('2');//状态
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除表
        Schema::dropIfExists('lesson');
    }
}
