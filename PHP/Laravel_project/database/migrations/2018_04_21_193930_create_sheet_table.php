<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建立数据表
        Schema::create('sheet',function($table){
           $table  -> increments('id');
           $table  -> tinyInteger('paper_id')->notNull();//试卷id
           $table  -> tinyInteger('question_id')->notNull();//题目id
           $table  -> tinyInteger('member_id')->notNull();//用户id
           $table  -> enum('is_correct',[1,2])->notNull()->default('2');//是否正确
           $table  -> tinyInteger('score')->notNull()->default(0);//得分
           $table  -> string('answer',1) -> nullable();//用户答案
           $table  -> timestamps();//时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除数据表
        Schema::dropIfExists('sheet');
    }
}
