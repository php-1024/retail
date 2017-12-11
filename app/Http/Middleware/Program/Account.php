<?php
/**
 * 检测添加账号数据中间件
 */
namespace App\Http\Middleware\Program;
use Closure;
use Session;

class AccountAddCheck{
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

class AccountEditCheck {
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


class LoginPost {
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
        if (Session::get('program_system_captcha') == $request->input('captcha')) {
            //把参数传递到下一个程序
            return $next($request);
        } else {
            //用户输入验证码错误
            return response()->json(['data' => '验证码错误', 'status' => '0']);
        }
    }
}

class IsLogin{
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


class EditPasswordCheck{
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