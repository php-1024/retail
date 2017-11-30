<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class AccountAddCheck{
    public function handle($request,Closure $next){
        if(empty($request->input('username'))){
            return response()->json(['data' => '请输入登陆账号', 'status' => '0']);
        }
        if(empty($request->input('password'))){
            return response()->json(['data' => '请输入登陆密码', 'status' => '0']);
        }
        return $next($request);
    }
}
?>