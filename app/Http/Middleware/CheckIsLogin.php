<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware\Program;
use Closure;
use Session;

class CheckIsLogin{
    public function handle($request,Closure $next){
        //获取用户登陆存储的SessionId
        $sess_key = Session::get('zerone_admin_id');
        //如果为空跳转到登陆页面
        if(empty($sess_key)) {
            return redirect('login');
        }else{
            //....若已经登陆，通过该中间件从数据库获取权限信息，创建菜单。
        }
        //把参数传递到下一个中间件
        return $next($request);
    }
}
?>