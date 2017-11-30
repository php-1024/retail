<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class ProgramCheckIsLogin{
    public function handle($request,Closure $next){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        dump($admin_data);
    }
}
?>