<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表的函数
        Schema::create('paper',function($table){
             
            $table ->increments('id'); //id字段
            $table ->string('paper_name',50)->notNull();//试卷名称
            $table ->tinyInteger('course_id')->notNull();//试卷所属的课程
            $table ->tinyInteger('score')->notNull()->default(100);//满分
            $table ->timestamps();//时间字段

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除表的函数
        Schema::dropIfExists('paper');
    }
}
