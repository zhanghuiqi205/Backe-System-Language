<?php

use Illuminate\Database\Seeder;

class CourseAndLessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //二合一填充器
        DB::table('course') -> insert([
		    'course_name'		=>		'linux',
		    'profession_id'		=>		'2',
		    'cover_img'			=>		'/statics/demo.jpg',
		    'created_at'		=>		date('Y-m-d H:i:s'),
		]);
		DB::table('course') -> insert([
		    'course_name'		=>		'jQuery',
		    'profession_id'		=>		'2',
		    'cover_img'			=>		'/statics/demo.jpg',
		    'created_at'		=>		date('Y-m-d H:i:s'),
		]);
		DB::table('course') -> insert([
		    'course_name'		=>		'ThinkPHP',
		    'profession_id'		=>		'2',
		    'cover_img'			=>		'/statics/demo.jpg',
		    'created_at'		=>		date('Y-m-d H:i:s'),
		]);
		DB::table('course') -> insert([
		    'course_name'		=>		'laravel',
		    'profession_id'		=>		'2',
		    'cover_img'			=>		'/statics/demo.jpg',
		    'created_at'		=>		date('Y-m-d H:i:s'),
		]);
		DB::table('lesson') -> insert([
		    'lesson_name'		=>		'liunx发展史',
		    'course_id'			=>		'1',
		    'video_addr'		=>		'/statics/demo.mp4',
		    'created_at'		=>		date('Y-m-d H:i:s'),
		    'video_time'		=>		86400,
		]);
		DB::table('lesson') -> insert([
		    'lesson_name'		=>		'虚拟机安装',
		    'course_id'			=>		'1',
		    'video_addr'		=>		'/statics/demo.mp4',
		    'created_at'		=>		date('Y-m-d H:i:s'),
		    'video_time'		=>		86400,
		]);
		DB::table('lesson') -> insert([
		    'lesson_name'		=>		'jQuery事件编程',
		    'course_id'			=>		'2',
		    'video_addr'		=>		'/statics/demo.mp4',
		    'created_at'		=>		date('Y-m-d H:i:s'),
		    'video_time'		=>		86400,
		]);
		DB::table('lesson') -> insert([
		    'lesson_name'		=>		'九大选择器',
		    'course_id'			=>		'2',
		    'video_addr'		=>		'/statics/demo.mp4',
		    'created_at'		=>		date('Y-m-d H:i:s'),
		    'video_time'		=>		86400,
		]);
    }
}
