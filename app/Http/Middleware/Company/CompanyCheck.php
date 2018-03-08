<?php
/**
 * 检测是否登录的中间件
 */
namespace App\Http\Middleware\Company;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class CompanyCheck{
    public function handle($request,Closure $next){
        $route_name = $request->path();//获取当前的页面路由
        switch($route_name){
            /*****登录页,如果已经登录则不需要再次登录*****/
            case "company/login"://登录页,如果已经登录则不需要再次登录
                //获取用户登录存储的SessionId
                $sess_key = Session::get('company_account_id');
                //如果不为空跳转到选择商户组织页面
                if(!empty($sess_key)) {
                    return redirect('company');
                }
                break;
            /****仅检测是否登录及是否具有权限****/
            case "company":                             //后台首页
            case "company/company_switch":              //退出切换商户
            case "company/company_list":                //所有商户列表
            case "company/account/profile":             //密码设置
            case "company/account/password":            //密码设置
            case "company/account/safe_password":       //安全密码设置
            case "company/account/operation_log":       //账户中心个人操作日志
            case "company/account/login_log":           //账户中心个人登录日志
            case "company/store/store_add":             //店铺管理创建店铺
            case "company/store/store_add_second":      //店铺管理立即开店
            case "company/store/store_list":            //店铺管理
                $re = $this->checkLoginAndRule($request);//判断是否登录
                return self::format_response($re,$next);
                break;
        }
        return $next($request);
    }

    //检测是否admin或是否有权限
    public function checkLoginAndRule($request){
        $re = $this->checkIsLogin($request);//判断是否登录
        if($re['status']=='0'){
            return $re;
        }else{
            $re2 = $this->checkHasRule($re['response']);//判断用户是否admin或是否有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }

    //部分页面检测用户是否admin，否则检测是否有权限
    public function checkHasRule($request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        if($admin_data['id']!=1){
            //暂定所有用户都有权限
            //return self::res(1,redirect('zerone'));
            return self::res(1,$request);
        }else{
            return self::res(1,$request);
        }
    }


    /**
     * 1、普通页面检测用户是否登录
     * 2、工厂方法返回结果
     * 3、格式化返回值
     */
    //1、普通页面检测用户是否登录
    public function checkIsLogin($request){
        //获取用户登录存储的SessionId
        $sess_key = Session::get('company_account_id');
        //如果为空跳转到登录页面
        if(!empty($sess_key)) {
            $sess_key = Session::get('company_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('company');//连接到我的缓存服务器
            $admin_data = Redis::get('company_system_admin_data_'.$sess_key);//获取管理员信息
            $menu_data = Redis::get('zerone_system_menu_3_'.$sess_key);
            $son_menu_data = Redis::get('zerone_system_son_menu_3_'.$sess_key);
            $admin_data = unserialize($admin_data);//解序列我的信息
            $menu_data =  unserialize($menu_data);//解序列一级菜单
            $son_menu_data =  unserialize($son_menu_data);//解序列子菜单
            $request->attributes->add(['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);//添加参数
            //把参数传递到下一个中间件
            return self::res(1,$request);
        }else{
            return self::res(0,redirect('company/login'));
        }
    }

    //2、工厂方法返回结果
    public static function res($status,$response){
        return ['status'=>$status,'response'=>$response];
    }
    //3、格式化返回值
    public static function format_response($re,Closure $next){
        if($re['status']=='0'){
            return $re['response'];
        }else{
            return $next($re['response']);
        }
    }
}
?>