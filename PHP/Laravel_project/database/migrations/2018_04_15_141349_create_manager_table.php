<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表的操作
        Schema::create('manager',function (Blueprint $table){
//            创建id
            $table ->increments('id');
            $table ->string('username',20)->notNull()->unique();
            $table ->string('password',255)->notNull();
            $table ->enum('gender',['1','2','3'])->notNull()->default('1');
            $table ->char('mobile','11')->nullable();
            $table ->string('email',60)->nullable();
            $table ->tinyInteger('role_id')->nullable();
            $table ->timestamps();
            $table ->rememberToken();
            $table ->enum('status',['1','2'])->notNull()->default('2');
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
        Schema::dropIfExists('manager');
    }
}
