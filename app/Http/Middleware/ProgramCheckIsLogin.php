<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware;
use Closure;
use Session;

class ProgramCheckIsLogin{
    public function handle($request,Closure $next){
        //获取用户登陆存储的SessionId
        $sess_key = Session::get('zerone_program_account_id');
        //如果为空跳转到登陆页面
        if(empty($sess_key)) {
            return redirect('program/login');
        }
        //把参数传递到下一个中间件
        return $next($request);
    }
}
?>