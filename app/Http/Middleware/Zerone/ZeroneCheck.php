<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware\Zerone;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class ZeroneCheck{
    public function handle($request,Closure $next){
        $route_name = $request->path();//获取当前的页面路由
        switch($route_name){
            /*****登录页,如果已经登陆则不需要再次登陆*****/
            case "zerone/login"://登录页,如果已经登陆则不需要再次登陆
                //获取用户登陆存储的SessionId
                $sess_key = Session::get('zerone_account_id');
                //如果不为空跳转到首页
                if(!empty($sess_key)) {
                    return redirect('tooling');
                }
                break;

            /****仅检测是否登陆****/
            case "zerone"://后台首页
                $re = $this->checkIsLogin($request);//判断是否登陆
                return self::format_response($re,$next);
                break;
        }
        return $next($request);
    }



    //部分页面检测用户是否超级管理员
    public function checkIsSuper($request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        if($admin_data['admin_is_super']!=1){
            return self::res(0,redirect('tooling'));
        }else{
            return self::res(1,$request);
        }
    }

    //普通页面检测用户是否登陆
    public function checkIsLogin($request){
        //获取用户登陆存储的SessionId
        $sess_key = Session::get('zerone_account_id');
        //如果为空跳转到登陆页面
        if(empty($sess_key)) {
            return self::res(0,redirect('zerone/login'));
        }else{
            $sess_key = Session::get('zerone_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('zeo');//连接到我的缓存服务器
            $admin_data = Redis::get('zerone_system_admin_data_'.$sess_key);//获取管理员信息
            $admin_data = unserialize($admin_data);//解序列我的信息
            $request->attributes->add(['admin_data'=>$admin_data]);//添加参数
            //把参数传递到下一个中间件
            return self::res(1,$request);
        }
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