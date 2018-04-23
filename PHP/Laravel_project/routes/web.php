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

// Route::get('/', function () {
//     return view('welcome');
// });




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

    //会员管理操作
    Route::get('member/index','Admin\MemberController@index');//列表
    Route::any('member/add','Admin\MemberController@add');//添加操作

   //会员管理模块
    Route::post('uploader/webuploader','Admin\UploaderController@webuploader');//上传头像
    Route::get('member/getAreaById','Admin\MemberController@getAreaById');//添加用户板块

  //专业与专业分类
    Route::get('protype/index','Admin\ProtypeController@index');//专业分类列表   
    Route::get('profession/index','Admin\ProfessionController@index');//专业列表   

   //课程与点播课程管理
   Route::get('course/index','Admin\CourseController@index');//课程列表
   Route::get('lesson/index','Admin\LessonController@index');//点播列表
   Route::get('lesson/play','Admin\LessonController@play');//播放列表



   //试卷试题部分
   Route::get('paper/index','Admin\PaperController@index');//试卷列表    
   Route::get('question/index','Admin\QuestionController@index');//试题列表    
   Route::get('question/export','Admin\QuestionController@export');//试卷导出    
   Route::any('question/import','Admin\QuestionController@import');//试卷导入
   
   

   //直播部分
   Route::get('stream/index','Admin\StreamController@index');//流列表    
   Route::any('stream/add','Admin\StreamController@add');//流添加    
   Route::get('live/index','Admin\LiveController@index');//直播课程列表
});


/*
*
前台路由
*/
Route::get('/', 'Home\IndexController@index'); //首页
// 专业详情页面
Route::get('/profession/detail', 'Home\ProfessionController@detail');
// 下单页面
Route::get('/showOrder', 'Home\ProfessionController@showOrder');

//微信支付
Route::get('/payWithWX', 'Home\ProfessionController@payWithWX');