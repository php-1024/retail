<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware\Program;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class Check{
    public function handle($request,Closure $next){
        $route_name = $request->path();//获取当前的页面路由
        switch($route_name){
            case "":
        }
    }

    public function check_is_login($request,Closure $next){

    }
}
?>