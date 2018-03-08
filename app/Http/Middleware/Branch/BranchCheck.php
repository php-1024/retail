<?php
/**
 * 检测是否登录的中间件
 */
namespace App\Http\Middleware\Branch;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class BranchCheck{
    public function handle($request,Closure $next){
        $route_name = $request->path();//获取当前的页面路由
        switch($route_name){
            /*****登录页,如果已经登录则不需要再次登录*****/
            case "branch/login"://登录页,如果已经登录则不需要再次登录
                //获取用户登录存储的SessionId
                $sess_key = Session::get('branch_account_id');
                //如果不为空跳转到选择商户组织页面
                if(!empty($sess_key)) {
                    return redirect('branch');
                }
                break;
            /****仅检测是否登录及是否具有权限****/
            case "branch":                             //后台首页
            case "branch/branch_list":                 //所有分店列表
            case "branch/branch_switch":               //退出切换店铺
            case "branch/account/profile":             //账号信息
            case "branch/account/safe_password":       //安全密码设置
            case "branch/account/message_setting":     //消息接收设置
            case "branch/account/password":            //密码设置
            case "branch/account/operation_log":       //账户中心个人操作日志
            case "branch/account/login_log":           //账户中心个人登录日志
            case "branch/cashier":                     //收银台
            case "branch/goods/category_add":          //添加商品分类
            case "branch/goods/category_list":         //商品分类列表
            case "branch/goods/goods_add":             //添加商品
            case "branch/goods/goods_edit":            //编辑商品
            case "branch/goods/goods_list":            //商品列表
            case "branch/goods/goods_copy":            //拷贝其他分店商品
            case "branch/role/role_add":               //添加权限角色
            case "branch/role/role_list":              //权限角色列表
            case "branch/subordinate/subordinate_add": //添加下级人员
            case "branch/subordinate/subordinate_list"://下级人员列表

            case "branch/order/order_spot":             //订单管理-现场订单
            case "branch/order/order_spot_detail":      //订单管理-现场订单详情
            case "branch/order/order_takeout":          //订单管理-外卖订单
            case "branch/order/order_takeout_detail":   //订单管理-外卖订单详情
            case "branch/order/order_appointment":      //预约管理
            case "branch/device/room_add":               //设备管理-添加包厢
            case "branch/device/room_list":              //设备管理-包厢管理
            case "branch/device/table_add":              //设备管理-添加餐桌
            case "branch/device/table_list":             //设备管理-餐桌管理
            case "branch/device/printer_add":            //设备管理-添加打印机
            case "branch/device/printer_list":           //设备管理-打印机管理
            case "branch/device/printer_goods":           //设备管理-打印机关联商品

            case "branch/user/user_tag":                //用户管理-粉丝标签管理
            case "branch/user/user_list":               //用户管理-粉丝用户管理
            case "branch/user/user_timeline":           //用户管理-粉丝足迹管理

            case "branch/finance/balance":              //财务管理-余额管理
            case "branch/finance/balance_recharge":     //财务管理-余额充值扣费
            case "branch/finance/credit":               //财务管理-积分管理
            case "branch/finance/credit_recharge":      //财务管理-积分充值扣费

            case "branch/paysetting/wechat_setting":    //支付设置-微信支付
            case "branch/paysetting/zerone_setting":    //支付设置-零舍壹得
            case "branch/paysetting/shengf_setting":    //支付设置-盛付通
            case "branch/paysetting/kuaifu_setting":    //支付设置-快付通
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
        $sess_key = Session::get('branch_account_id');
        //如果为空跳转到登录页面
        if(!empty($sess_key)) {
            $sess_key = Session::get('branch_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('zeo');//连接到我的缓存服务器
            $admin_data = Redis::get('branch_system_admin_data_'.$sess_key);//获取管理员信息
            $menu_data = Redis::get('zerone_system_menu_5_'.$sess_key);
            $son_menu_data = Redis::get('zerone_system_son_menu_5_'.$sess_key);
            $admin_data = unserialize($admin_data);//解序列我的信息
            $menu_data =  unserialize($menu_data);//解序列一级菜单
            $son_menu_data =  unserialize($son_menu_data);//解序列子菜单
            $request->attributes->add(['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);//添加参数
            //把参数传递到下一个中间件
            return self::res(1,$request);
        }else{
            return self::res(0,redirect('branch/login'));
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