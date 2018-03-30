<?php
/**
 * 检测是否登录的中间件
 */
namespace App\Http\Middleware\Api;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class AndroidapiCheckCheck{
    public function handle($request,Closure $next){
        $route_name = $request->path();//获取当前的页面路由
        switch($route_name){
            /*****登录*****/
            case "api/androidapi/login"://检测登入提交数据
                $this->checkLogin($request);
                break;
            /****登录****/

        }
        return $next($request);
    }


    /**
     * 普通页面检测用户是否登录
     */
    public function checkLogin($request){
        if (empty($request->input('account'))) {
            return self::res(0, response()->json(['data' => '请输入用户名', 'status' => '0']));
        }
        if (empty($request->input('password'))) {
            return self::res(0, response()->json(['data' => '请输入密码', 'status' => '0']));
        }
        return self::res(1,$request);
    }

    //工厂方法返回结果
    public static function res($status,$response){
        return ['status'=>$status,'response'=>$response];
    }
    //格式化返回值
    public static function format_response($re,Closure $next){
        if($re['status']=='0'){
            return $re['response'];
        }else{
            return $next($re['response']);
        }
    }
}
?>