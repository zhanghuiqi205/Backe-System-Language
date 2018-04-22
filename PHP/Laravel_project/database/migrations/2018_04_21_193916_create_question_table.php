<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表的函数
        Schema::create('quesstion',function($table){
             $table ->increments('id');//主键id
             $table ->string('question')->notNull();//题干
             $table ->tinyInteger('paper_id')->notNull();//所属的试卷id
             $table ->tinyInteger('score')->notNull()->default(2);//得分
             $table ->string('options')->notNull();//选项
             $table ->char('answer',1)->notNull();//答案
             $table ->string('remark')->nullable();//题目的备注说明
             $table ->timestamps();//时间    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除数据表的函数
        Schema::dropIfExists('quesstion');
    }
}
