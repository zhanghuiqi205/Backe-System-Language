<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表操作
        Schema::create('profession',function($table){
           $table -> increments('id');//id
           $table ->string('pro_name',20) ->notNull();//专业名称
           $table ->tinyInteger('protype_id') ->notNull();//专业分类id
           $table ->string('teachers_ids')->notNull();//老师集合
           $table ->string('description') ->nullable();//描述
           $table ->string('cover_img')->nullable();//封面地址
           $table ->integer('view_count')->notNull()->default('500');//点击量
           $table ->timestamps();
           $table ->tinyInteger('sort')->notNull()->default('0');//排序
           $table ->tinyInteger('duration')->nullable();//课时
           $table ->decimal('price',7,2)->nullable();//价格
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删表操作
        Schema::dropIfExists('profession');
    }
}
