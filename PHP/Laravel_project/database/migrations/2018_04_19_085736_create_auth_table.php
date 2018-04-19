<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建表
        Schema::create('auth',function ($table){
            $table ->increments('id');
            $table ->string('auth_name',20)->notNull();//权限名称
            $table ->string('controller',40)->nullable();//控制器
            $table ->string('action',30)->nullable();//方法
            $table ->tinyInteger('pid')->default(0);//pid
            $table ->enum('is_nav',[1,2])->notNull()->default('1');
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
        Schema::dropIfExists('auth');
    }
}
