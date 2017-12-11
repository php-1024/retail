<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware\Program;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class CheckIsLogin{
    public function handle($request,Closure $next){
        //获取用户登陆存储的SessionId
        $sess_key = Session::get('zerone_program_account_id');
        //如果为空跳转到登陆页面
        if(empty($sess_key)) {
            return redirect('program/login');
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

class CheckIsLoginAjax{
    public function handle($request,Closure $next){
        //获取用户登陆存储的SessionId
        $sess_key = Session::get('zerone_program_account_id');
        //如果为空返回登陆失效
        if(empty($sess_key)) {
            return response()->json(['data' => '登陆状态失效', 'status' => '-1']);
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

class CheckIsSuper{
    public function handle($request,Closure $next){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        if($admin_data['admin_is_super']!=1){
            return redirect('program');
        }else{
            return $next($request);
        }
    }
}

class CheckIsSuperAjax{
    public function handle($request,Closure $next){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        if($admin_data['admin_is_super']!=1){
            return response()->json(['data' => '您没有该功能的权限！', 'status' => '0']);
        }else{
            return $next($request);
        }
    }
}

class CheckSearchDate{
    public function handle($request,Closure $next){
        $time_st = $request->input('time_st');
        $time_nd = $request->input('time_nd');
        $time_st_format = strtotime($time_st);
        $time_nd_format = strtotime($time_nd);

        if((empty($time_st) && !empty($time_nd)) || (!empty($time_st) && empty($time_nd))){
            return response()->json(['data' => '错误的日期格式！', 'status' => '0']);
        }
        if(!empty($time_st) && !empty($time_nd) && $time_nd_format<$time_st_format){
            return response()->json(['data' => '错误的日期格式！', 'status' => '0']);
        }
        return $next($request);
    }
}

?>