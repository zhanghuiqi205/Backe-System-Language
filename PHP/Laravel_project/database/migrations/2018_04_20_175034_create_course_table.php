<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //课程表
        Schema::create('course',function($table){
             $table ->increments('id');                               //id
             $table ->string('course_name',30)->notNull();            //课程名称
             $table ->integer('profession_id')->notNull();            //专业id
             $table ->string('cover_img')->nullable();                //封面
             $table ->integer('sort')->notNull()->default(0);         //排序
             $table ->string('description')->nullable();              //描述
             $table ->timestamps();
             $table ->enum('status',[1,2])->notNull()->default('2');  //状态
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除课程表
        Schema::dropIfExists('course');
    }
}
