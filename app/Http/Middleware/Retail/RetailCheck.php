<?php
/**
 * 检测是否登录的中间件
 */
namespace App\Http\Middleware\Retail;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class RetailCheck{
    public function handle($request,Closure $next){
        $route_name = $request->path();//获取当前的页面路由
        switch($route_name){
            /*****登录页,如果已经登录则不需要再次登录*****/
            case "retail/login"://登录页,如果已经登录则不需要再次登录
                //获取用户登录存储的SessionId
                $sess_key = Session::get('retail_account_id');
                //如果不为空跳转到选择商户组织页面
                if(!empty($sess_key)) {
                    return redirect('retail');
                }
                break;
            /****仅检测是否登录及是否具有权限****/
            case "retail":                             //后台首页
            case "retail/branch_list":                 //所有分店列表
            case "retail/branch_switch":               //退出切换店铺
            case "retail/account/profile":             //账号信息
            case "retail/account/safe_password":       //安全密码设置
            case "retail/account/message_setting":     //消息接收设置
            case "retail/account/password":            //密码设置

            case "retail/category/category_add":       //添加商品分类
            case "retail/category/category_list":      //商品分类列表
            case "retail/goods/goods_add":             //添加商品
            case "retail/goods/goods_edit":            //编辑商品
            case "retail/goods/goods_list":            //商品列表

            case "retail/role/role_add":               //添加权限角色
            case "retail/role/role_list":              //权限角色列表
            case "retail/subordinate/subordinate_add": //添加下级人员
            case "retail/subordinate/subordinate_list"://下级人员列表

            case "retail/order/order_spot":             //订单管理-现场订单
            case "retail/order/order_spot_detail":      //订单管理-现场订单详情
            case "retail/order/order_takeout":          //订单管理-外卖订单
            case "retail/order/order_takeout_detail":   //订单管理-外卖订单详情
            case "retail/order/order_appointment":      //预约管理
            case "retail/device/room_add":               //设备管理-添加包厢
            case "retail/device/room_list":              //设备管理-包厢管理
            case "retail/device/table_add":              //设备管理-添加餐桌
            case "retail/device/table_list":             //设备管理-餐桌管理
            case "retail/device/printer_add":            //设备管理-添加打印机
            case "retail/device/printer_list":           //设备管理-打印机管理
            case "retail/device/printer_goods":           //设备管理-打印机关联商品

            case "retail/user/user_list":               //用户管理-粉丝用户管理


            case "retail/paysetting/wechat_setting":    //支付设置-微信支付
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
        $sess_key = Session::get('retail_account_id');
        //如果为空跳转到登录页面
        if(!empty($sess_key)) {
            $sess_key = Session::get('retail_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('zeo');//连接到我的缓存服务器
            $admin_data = Redis::get('retail_system_admin_data_'.$sess_key);//获取管理员信息
            $menu_data = Redis::get('zerone_system_menu_10_'.$sess_key);
            $son_menu_data = Redis::get('zerone_system_son_menu_10_'.$sess_key);
            $admin_data = unserialize($admin_data);//解序列我的信息
            $menu_data =  unserialize($menu_data);//解序列一级菜单
            $son_menu_data =  unserialize($son_menu_data);//解序列子菜单
            $request->attributes->add(['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);//添加参数
            //把参数传递到下一个中间件
            return self::res(1,$request);
        }else{
            return self::res(0,redirect('retail/login'));
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