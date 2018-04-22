<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表的函数
        Schema::create('live',function($table){
              $table ->increments('id');
              $table ->string('live_name',50)->notNull()->unique();
              $table ->integer('profession_id')->notNull();
              $table ->integer('stream_id')->notNull();
              $table ->string('cover_img')->notNull();
              $table ->integer('sort')->notNull()->default(0);
              $table ->string('description')->nullable();
              $table ->integer('begin_at')->notNull();
              $table ->integer('end_at')->notNull();
              $table ->string('video_addr')->nullable();
              $table ->timestamps();
              $table ->enum('status',[1,2])->notNull()->default('1');
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
        Schema::dropIfExists('live');
    }
}
