<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //角色表
        Schema::create('role',function ($table){
            $table ->increments('id');//主键id
            $table ->string('role_name',20)->notNull();//角色名称
            $table ->text('auth_ids')->nullable();//权限id集合
            $table ->text('auth_ac')->nullable();//权限集合
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
        Schema::dropIfExists('role');
    }
}
