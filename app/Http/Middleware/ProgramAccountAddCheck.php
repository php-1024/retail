<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware;
use Closure;
use Session;

class ProgramAccountAddCheck{
    public function handle($request,Closure $next){
        if(empty($request->input('account'))){
            return response()->json(['data' => '请输入登陆账号', 'status' => '0']);
        }
        if(empty($request->input('password'))){
            return response()->json(['data' => '请输入登陆密码', 'status' => '0']);
        }
        if(empty($request->input('repassword'))){
            return response()->json(['data' => '请再次输入登陆密码', 'status' => '0']);
        }
        if($request->input('password')!=$request->input('repassword')){
            return response()->json(['data' => '两次输入密码不一致', 'status' => '0']);
        }
        return $next($request);
    }
}
?>