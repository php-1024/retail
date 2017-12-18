<?php
/**
 * 检测添加账号数据中间件
 */
namespace App\Http\Middleware\Tooling;
use Closure;
use Session;

class ToolingAccountEditCheck {
    public function handle($request,Closure $next){
        if(empty($request->input('id'))){
            return response()->json(['data' => '数据传输错误', 'status' => '0']);
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