<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware\Tooling;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class ToolingCheck{
    public function handle($request,Closure $next){
        $route_name = $request->path();//获取当前的页面路由

        switch($route_name){
            case "tooling"://后台首页
                $re = $this->checkIsLogin($request);
                if($re['status']=='0'){
                    return $re['response'];
                }else{
                    return $next($re['response']);
                }
                   break;
        }
    }

    //普通页面检测用户是否登陆
    public function checkIsLogin($request){
        //获取用户登陆存储的SessionId
        $sess_key = Session::get('zerone_tooling_account_id');
        //如果为空跳转到登陆页面
        if(empty($sess_key)) {
            return ['status'=>0,'response'=>redirect('tooling/login')];
        }else{
            $sess_key = Session::get('zerone_tooling_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('zeo');//连接到我的缓存服务器
            $admin_data = Redis::get('tooling_system_admin_data_'.$sess_key);//获取管理员信息
            $admin_data = unserialize($admin_data);//解序列我的信息
            $request->attributes->add(['admin_data'=>$admin_data]);//添加参数
            //把参数传递到下一个中间件
            return ['status'=>1,'response'=>$request];
        }
    }


}
?>