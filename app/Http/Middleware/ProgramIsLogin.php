<?php
/**
 * 登录页面检测是否已经登陆过的中间件
 */
namespace App\Http\Middleware;
use Closure;
use Session;

class ProgramIsLogin{
    public function handle($request,Closure $next){
        //获取用户登陆存储的SessionId
        $sess_key = Session::get('zerone_program_account_id');

        //如果不为空跳转到首页
        if(!empty($sess_key)) {
            return redirect('program');
        }
        //把参数传递到下一个中间件
        return $next($request);
    }
}
?>