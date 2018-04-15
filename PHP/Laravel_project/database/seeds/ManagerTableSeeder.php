<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //创建数据
        $data =[];
        $faker = \Faker\Factory::create('zh_CN');
        for ($i =0;$i<100;$i++){
            $data[]=[
                'username' =>$faker ->userName,
                'password' =>bcrypt('123456'),
                'gender'   =>rand(1,3),
                'mobile'   =>$faker ->phoneNumber,
                 'email'   =>$faker ->email,
                 'role_id' =>rand(1,10),
                'created_at'=> date('Y-m-d H:i:s'),
                'status'   =>rand(1,2)

            ];
        }
        DB::table('manager')->insert($data);

    }
}
