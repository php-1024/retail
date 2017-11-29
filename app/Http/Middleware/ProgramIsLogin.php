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
        session('zerone_program_account_id',1);//存储登录session_id为当前用户ID
        $sess_key = session('zerone_program_account_id');
        dump($sess_key);
        exit();
        //如果不为空跳转到首页
        if(!empty($sess_key)) {
            return redirect('program');
        }
        //把参数传递到下一个中间件
        return $next($request);
    }
}
?>