<?php
/**
 * 检测修改密码数据中间件
 */
namespace App\Http\Middleware\Program;
use Closure;
use Session;

class ProgramEditPasswordCheck{
    public function handle($request,Closure $next){
        if(empty($request->input('oldpassword'))){
            return response()->json(['data' => '请输入原登陆密码', 'status' => '0']);
        }
        if(empty($request->input('password'))){
            return response()->json(['data' => '请输入新登陆密码', 'status' => '0']);
        }
        if(empty($request->input('repassword'))){
            return response()->json(['data' => '请再次输入新登陆密码', 'status' => '0']);
        }
        if($request->input('password')==$request->input('oldpassword')){
            return response()->json(['data' => '新旧密码不能相同', 'status' => '0']);
        }
        if($request->input('password')!=$request->input('repassword')){
            return response()->json(['data' => '两次输入的新密码不一致', 'status' => '0']);
        }
        return $next($request);
    }
}
?>