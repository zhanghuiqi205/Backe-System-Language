<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表的函数
        Schema::create('stream',function($table){
            $table -> increments('id');
            $table ->string('stream_name',200)->notNull();
            $table ->enum('status',[1,2,3])->notNull()->default('1');
            $table ->integer('permited_at')->notNull()->default(0);
            $table ->integer('sort')->notNull() ->default(0);
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
        Schema::dropIfExists('stream');
    }
}
