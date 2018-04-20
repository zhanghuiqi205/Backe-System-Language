<?php

use Illuminate\Database\Seeder;

class ProtypeAndProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //先往专业分类表中填写基本的数据
        DB::table('protype') -> insert([
        	[
        		'protype_name'	=>		'前端',
        		'sort'			=>		'10',
        		'created_at'	=>		date('Y-m-d H:i:s'),
        		'status'		=>		2,
        	],
        	[
        		'protype_name'	=>		'后端',
        		'sort'			=>		'5',
        		'created_at'	=>		date('Y-m-d H:i:s'),
        		'status'		=>		2,
        	],
        	[
        		'protype_name'	=>		'运维',
        		'sort'			=>		'50',
        		'created_at'	=>		date('Y-m-d H:i:s'),
        		'status'		=>		2,
        	],
        ]);
        //专业表的基本数据
        DB::table('profession') -> insert([
        	[
        		'pro_name'			=>	'UI设计',
        		'protype_id'		=>	1,
        		'teachers_ids'		=>	'3,4,5,7',
        		'description'		=>	'UI设计学科',
        		'cover_img'			=>	'/statics/demo.jpg',
        		'created_at'		=>	date('Y-m-d H:i:s'),
        		'sort'				=>	rand(1,99),
        		'duration'			=>	rand(80,100),
        		'price'				=>	'100.00'
        	],
        	[
        		'pro_name'			=>	'PHP',
        		'protype_id'		=>	2,
        		'teachers_ids'		=>	'3,4,5,7',
        		'description'		=>	'PHP学科',
        		'cover_img'			=>	'/statics/demo.jpg',
        		'created_at'		=>	date('Y-m-d H:i:s'),
        		'sort'				=>	rand(1,99),
        		'duration'			=>	rand(80,100),
        		'price'				=>	'500.00'
        	],
        	[
        		'pro_name'			=>	'Linux运维',
        		'protype_id'		=>	3,
        		'teachers_ids'		=>	'3,4,5,7',
        		'description'		=>	'运维学科',
        		'cover_img'			=>	'/statics/demo.jpg',
        		'created_at'		=>	date('Y-m-d H:i:s'),
        		'sort'				=>	rand(1,99),
        		'duration'			=>	rand(80,100),
        		'price'				=>	'1000.00'
        	],
        ]);
    }
}
