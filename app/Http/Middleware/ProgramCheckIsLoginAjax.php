<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class ProgramCheckIsLoginAjax{
    public function handle($request,Closure $next){
        //获取用户登陆存储的SessionId
        $sess_key = Session::get('zerone_program_account_id');
        return response()->json(['data' => '登陆状态失效', 'status' => '-1']);
        //如果为空返回登陆失效
        if(empty($sess_key)) {

        }else{
            $sess_key = Session::get('zerone_program_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('zeo');//连接到我的缓存服务器
            $admin_data = Redis::get('program_system_admin_data_'.$sess_key);//获取管理员信息
            $admin_data = unserialize($admin_data);//解序列我的信息
            $request->attributes->add(['admin_data'=>$admin_data]);//添加参数
            //把参数传递到下一个中间件
            return $next($request);
        }
    }
}
?>