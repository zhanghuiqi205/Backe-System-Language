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
//            用户名：varchar(20) not null unique
            $table ->string('username',20)->notNull()->unique();
//            密码 varchar（255） notnull
            $table ->string('password',255)->notNull();
//            性别 not null 默认值为1
            $table ->enum('gender',['1','2','3'])->notNull()->default('1');
//            手机号 char（11） null
            $table ->char('mobile','11')->nullable();
//            邮箱  varchar（60） null
            $table ->string('email',60)->nullable();
//            角色id tinyint类型 null
            $table ->tinyInteger('role_id')->nullable();
//            created_at/updated_at datetime null
            $table ->timestamps();
//            remeber_token varchar(255) null
            $table ->rememberToken();
//            状态 enum(1,2) not null default 2
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
