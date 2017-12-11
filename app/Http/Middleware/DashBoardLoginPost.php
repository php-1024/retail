<?php
/**
 * 检测中间件囖
 */
namespace App\Http\Middleware;
use Closure;
use Session;

class DashBoardLoginPost {
    public function handle($request,Closure $next){
        if(empty($request->input('username'))){
           return response()->json(['data' => '请输入用户名', 'status' => '0']);
        }
        if(empty($request->input('password'))){
            return response()->json(['data' => '请输入登录密码', 'status' => '0']);
        }
        if(empty($request->input('captcha'))){
            return response()->json(['data' => '请输入验证码', 'status' => '0']);
        }
        if (Session::get('milkcaptcha') == $request->input('captcha')) {
            //把参数传递到下一个程序
            return $next($request);
        } else {
            //用户输入验证码错误
            return response()->json(['data' => '验证码错误', 'status' => '0']);
        }
    }
}
?>