<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
 * 后台的路由集合
 */
//                                  平台/控制器/方法
Route::get('/admin/public/login','Admin\PublicController@login')->name('login');//登录的方法
Route::post('/admin/public/check','Admin\PublicController@check');//检测登录的数据

//后台登录之后的相关路由
Route::group(['prefix' =>'admin','middleware'=>'auth:diy_admin'],function (){
//    首页路由
    Route::get('index/index','Admin\IndexController@index');
    Route::get('index/welcome','Admin\IndexController@welcome');
//    用户退出路由
    Route::get('public/logout','Admin\PublicController@logout');

//   管理员的列表操作
    Route::get('manager/index','Admin\ManagerController@index');



});