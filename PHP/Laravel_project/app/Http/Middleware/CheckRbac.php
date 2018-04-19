<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Auth;
class CheckRbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
        //需要写代码的位置
        //1.获取当前的访问的路由
        if(Auth::guard('diy_admin')->user()->role_id !=1){
            $route = Route::currentRouteAction();
            //获取具体的部分
            $tmp = explode('\\',$route);  //用到了一个转义字符  
            //2.获取当前用户对应的角色权限ac
            $ac = Auth::guard('diy_admin')->user() ->rel_role ->auth_ac;
            //3.对比判断是否具有权限(大小写要统一)
            if(stripos($ac,end($tmp))===false){
                header('HTTP/1.1 403 Forbidden');die;
            }
        }
        return $next($request);
    }
}
