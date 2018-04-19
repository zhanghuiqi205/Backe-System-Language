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
Route::group(['prefix' =>'admin','middleware'=>['auth:diy_admin','rbac']],function (){
//    首页路由
    Route::get('index/index','Admin\IndexController@index');
    Route::get('index/welcome','Admin\IndexController@welcome');
//    用户退出路由
    Route::get('public/logout','Admin\PublicController@logout');

//   管理员的列表操作
    Route::get('manager/index','Admin\ManagerController@index');


//    权限管理相关路由
    Route::get('auth/index','Admin\AuthController@index');//列表
    Route::any('auth/add','Admin\AuthController@add');//添加操作

//    角色管理相关的路由
    Route::get('role/index','Admin\RoleController@index');//列表
    Route::any('role/assign','Admin\RoleController@assign');//权限分派操作

});