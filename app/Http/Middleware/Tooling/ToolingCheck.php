<?php
/**
 * 检测是否登录的中间件
 */
namespace App\Http\Middleware\Tooling;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class ToolingCheck{
    public function handle($request,Closure $next){
        $route_name = $request->path();//获取当前的页面路由
        switch($route_name){
            /*****登录页,如果已经登录则不需要再次登录*****/
            case "tooling/login"://登录页,如果已经登录则不需要再次登录
                //获取用户登录存储的SessionId
                $sess_key = Session::get('tooling_account_id');
                //如果不为空跳转到首页
                if(!empty($sess_key)) {
                    return redirect('tooling');
                }
            break;

            /****检测用户是否登录 是否超级管理员****/
            case "tooling/dashboard/account_list"://账号列表
            case "tooling/dashboard/account_add"://添加账号
                $re = $this->checkLoginAndSuper($request);//判断是否登录和是否超级管理员
                return self::format_response($re,$next);
            break;

            /****检测用户是否登录 是否超级管理员 日期输入是否正确****/
            case "tooling/dashboard/operation_log"://操作日志
            case "tooling/dashboard/login_log"://登录日志
                $re = $this->checkLoginAndSuperAndDate($request);
                return self::format_response($re,$next);
            break;

            /****普通页面，检测是否登录，日期输入是否正确****/
            case "tooling/personal/operation_log"://我的操作日志
            case "tooling/personal/login_log"://我的登录日志
                $re = $this->checkLoginAndDate($request);
                return self::format_response($re,$next);
            break;

            /****仅检测是否登录****/
            case "tooling/module/module_add"://添加模块
            case "tooling/module/module_list"://模块列表
            case "tooling/node/node_add"://添加节点
            case "tooling/node/node_list"://节点列表
            case "tooling/program/program_add"://添加程序
            case "tooling/program/program_list"://程序列表
            case "tooling/personal/password_edit"://修改登录密码
            case "tooling/program/menu_list"://程序菜单列表
            case "tooling"://后台首页
                $re = $this->checkIsLogin($request);//判断是否登录
                return self::format_response($re,$next);
            break;
        }
        return $next($request);
    }

    //检测用户是否登录 是否超级管理员 日期输入是否正确
    public function checkLoginAndSuperAndDate($request){
        $re = $this->checkLoginAndSuper($request);//是否超级管理员和登录
        if($re['status']=='0'){
            return $re;
        }else{
            $re2 = $this->checkDate($re['response']);//判断时间段是否正确
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }

    //检测用户是否登录 日期输入是否正确
    public function checkLoginAndDate($request){
        $re = $this->checkIsLogin($request);//判断是否登录
        if($re['status']=='0'){
            return $re;
        }else{
            $re2 = $this->checkDate($re['response']);
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }

    //检测是否登录后检测是否超级管理员
    public function checkLoginAndSuper($request){
        $re = $this->checkIsLogin($request);//判断是否登录
        if($re['status']=='0'){
            return $re;
        }else{
            $re2 = $this->checkIsSuper($re['response']);//判断是否超级管理员
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }

    //get查询检测日期是否输入正确
    public function checkDate($request){
        $time_st = $request->input('time_st');
        $time_nd = $request->input('time_nd');
        $time_st_format = strtotime($time_st);
        $time_nd_format = strtotime($time_nd);

        if((empty($time_st) && !empty($time_nd)) || (!empty($time_st) && empty($time_nd))){
            return self::res(0,response()->json(['data' => '错误的日期格式！', 'status' => '0']));
        }
        if(!empty($time_st) && !empty($time_nd) && $time_nd_format<$time_st_format){
            return self::res(0,response()->json(['data' => '错误的日期格式！', 'status' => '0']));
        }
        return self::res(1,$request);
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

    //普通页面检测用户是否登录
    public function checkIsLogin($request){
        //获取用户登录存储的SessionId
        $sess_key = Session::get('tooling_account_id');
        //如果为空跳转到登录页面
        if(empty($sess_key)) {
            return self::res(0,redirect('tooling/login'));
        }else{
            $sess_key = Session::get('tooling_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('zeo');//连接到我的缓存服务器
            $admin_data = Redis::get('tooling_system_admin_data_'.$sess_key);//获取管理员信息
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