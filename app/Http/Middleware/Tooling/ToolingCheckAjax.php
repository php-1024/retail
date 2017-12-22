<?php
/**
 * 检测中间件囖
 */
namespace App\Http\Middleware\Tooling;
use Closure;
use Session;

class ToolingCheckAjax {
    public function handle($request,Closure $next){
        $route_name = $request->path();//获取当前的页面路由
        switch($route_name){
            case "tooling/ajax/checklogin"://后台首页
                $re = $this->checkLoginPost($request);
                if($re['status']=='0'){
                    return $re['response'];
                }else{
                    return $next($re['response']);
                }
                break;

            case "tooling/ajax/program_edit"://修改程序
                $re = $this->checkIsLogin($request);
                if($re['status']=='0'){
                    return $re['response'];
                }else{
                    return $next($re['response']);
                }
                break;

        }
    }

    //检测是否登陆
    public function checkIsLogin($request){
        $sess_key = Session::get('zerone_tooling_account_id');
        //如果为空返回登陆失效
        if(!empty($sess_key)) {
            return self::res(0,response()->json(['data' => '登陆状态失效', 'status' => '-1']));
        }else{
            $sess_key = Session::get('zerone_tooling_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('zeo');//连接到我的缓存服务器
            $admin_data = Redis::get('tooling_system_admin_data_'.$sess_key);//获取管理员信息
            $admin_data = unserialize($admin_data);//解序列我的信息
            $request->attributes->add(['admin_data'=>$admin_data]);//添加参数
            //把参数传递到下一个中间件
            return self::res(1,$request);
        }
    }

    //检测登陆提交数据
    public function checkLoginPost($request){
        if(empty($request->input('username'))){
            return self::res(0,response()->json(['data' => '请输入用户名', 'status' => '0']));
        }
        if(empty($request->input('password'))){
            return self::res(0,response()->json(['data' => '请输入登录密码', 'status' => '0']));
        }
        if(empty($request->input('captcha'))){
            return self::res(0,response()->json(['data' => '请输入验证码', 'status' => '0']));
        }
        if (Session::get('tooling_system_captcha') == $request->input('captcha')) {
            //把参数传递到下一个程序
            return self::res(1,$request);
        } else {
            //用户输入验证码错误
            return self::res(0,response()->json(['data' => '验证码错误', 'status' => '0']));
        }
    }
    //工厂方法返回结果
    public static function res($status,$response){
        return ['status'=>$status,'response'=>$response];
    }
}
?>