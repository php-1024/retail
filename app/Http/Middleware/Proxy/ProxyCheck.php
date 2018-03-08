<?php
/**
 * 检测是否登录的中间件
 */
namespace App\Http\Middleware\Proxy;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class ProxyCheck{
    public function handle($request,Closure $next){
        $route_name = $request->path();//获取当前的页面路由
        switch($route_name){
            /*****登录页,如果已经登录则不需要再次登录*****/
            case "proxy/login"://登录页,如果已经登录则不需要再次登录
//                获取用户登录存储的SessionId
                $sess_key = Session::get('proxy_account_id');
//                如果不为空跳转到首页
                if(!empty($sess_key)) {
                    return redirect('proxy');
                }
                break;

            case "proxy/switch_status"://超级管理员切换服务商
                 $this->checkLoginAndRuleAndSwitchStatus($request);//判断是否登录
                break;

            /****仅检测是否登录及是否具有权限****/

            /****系统管理****/
            case "proxy/system/setup":                  //参数设置
            case "proxy/system/proxy_info":             //公司信息设置
            case "proxy":                               //服务商后台首页
            case "proxy/system/select_proxy":           //服务商超级管员进入操作
            case "proxy/system/proxy_structure":        //人员结构
            case "proxy/system/operationlog":           //操作日记
            case "proxy/system/loginlog":               //登入日记
            /****系统管理****/

            /****个人信息****/
            case "proxy/persona/account_info":          //个人信息修改
            case "proxy/persona/safe_password":         //安全密码修改
            case "proxy/persona/password":              //登入密码修改
            case "proxy/persona/myoperationlog":        //我的操作记录
            case "proxy/persona/myloginlog":            //登入密码修改
            /****个人信息****/

            /****下级人员管理--权限角色****/
            case "proxy/role/role_add":                 //权限角色添加
            case "proxy/role/role_list":                //权限角色列表
            /****下级人员管理--权限角色****/

            /****下级人员管理--添加组****/
            case "proxy/subordinate/subordinate_add":   //下级人员添加
            case "proxy/subordinate/subordinate_list":  //下级人员列表
            case "proxy/subordinate/subordinate_structure"://下级人员结构
            case "proxy/subordinate/quick_rule":        //添加下级人员快速授权

                /****下级人员管理--添加组****/

            /****系统资产管理****/
            case "proxy/program/program_list":           //权限角色添加
            case "proxy/program/program_log":            //权限角色列表
            /****系统资产管理****/
            
            /****下辖商户管理****/
            case "proxy/company/company_register":        //商户注册列表
            case "proxy/company/company_list":            //商户列表
            case "proxy/company/company_structure":       //店铺结构
            case "proxy/company/company_program":         //程序划拨
            /****下辖商户管理****/

                $re = $this->checkLoginAndRule($request);//判断是否登录
                return self::format_response($re,$next);
                break;
        }
        return $next($request);
    }



    //检测是否admin或是否有权限
    public function checkLoginAndRuleAndSwitchStatus($request){
        $re = $this->checkIsLogin($request);//判断是否登录
        if($re['status']=='0'){
            return $re;
        }else{
            $re2 = $this->checkHasRule($re['response']);//判断用户是否admin或是否有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
                if($admin_data['is_super'] != 2){ //防止直接输入地址访问
                    return self::res(0,$request);
                }
                $admin_data['is_super'] = 1; //切换权限
                \ZeroneRedis::create_proxy_account_cache(1,$admin_data);//生成账号数据的Redis缓存
                return self::res(1,$request);

            }
        }
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

    //普通页面检测用户是否登录
    public function checkIsLogin($request){
        //获取用户登录存储的SessionId
        $sess_key = Session::get('proxy_account_id');
        //如果为空跳转到登录页面
        if(empty($sess_key)) {
            return self::res(0,redirect('proxy/login'));
        }else{
            $sess_key = Session::get('proxy_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('zeo');//连接到我的缓存服务器
            $admin_data = Redis::get('proxy_system_admin_data_'.$sess_key);//获取管理员信息
            $menu_data = Redis::get('zerone_system_menu_2_'.$sess_key);
            dump($menu_data);
            $son_menu_data = Redis::get('zerone_system_son_menu_2_'.$sess_key);
            $admin_data = unserialize($admin_data);//解序列我的信息
            $menu_data =  unserialize($menu_data);//解序列一级菜单
            $son_menu_data =  unserialize($son_menu_data);//解序列子菜单
            $request->attributes->add(['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);//添加参数
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