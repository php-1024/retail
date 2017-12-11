<?php
/**
 * 检测添加账号数据中间件
 */
namespace App\Http\Middleware\Program;
use Closure;
use Session;

class AccountLockCheck {
    public function handle($request,Closure $next){
        if(empty($request->input('id'))){
            return response()->json(['data' => '数据传输错误', 'status' => '0']);
        }
        if(empty($request->input('account'))){
            return response()->json(['data' => '数据传输错误', 'status' => '0']);
        }
        return $next($request);
    }
}
?>