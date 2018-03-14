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
//                获取用户登录存储的SessionId
                $sess_key = Session::get('retail_account_id');
//                如果不为空跳转到首页
                if(!empty($sess_key)) {
                    return redirect('retail');
                }
                break;

            case "retail/switch_status"://超级管理员切换服务商
                $this->checkLoginAndRuleAndSwitchStatus($request);//判断是否登录
                break;

            /****仅检测是否登录及是否具有权限****/

            /****店铺概况****/
            case "retail":                                  //店铺后台首页
            case "retail/select_shop":                      //店铺超级管员进入操作
            /****店铺概况****/

            /****账号中心****/
            case "catering/account/profile":                //账号信息
            case "catering/account/password":               //登入密码修改
            case "catering/account/safe_password":          //安全密码设置
            case "catering/account/message_setting":        //消息推送设置
            case "catering/account/operation_log":          //操作日记
            case "catering/account/login_log":              //登入日记
            /****账号中心****/

            /****公众号管理****/
            //case "catering/subscription/setting":                   //公众号授权
            case "api/catering/store_auth"://公众号授权
            case "catering/subscription/material_image":            //图片素材
            case "catering/subscription/material_writing":          //图文素材
            case "catering/subscription/material_writing_one":      //单条图文素材
            case "catering/subscription/material_writing_one_edit": //单条图文素材编辑
            case "catering/subscription/material_writing_many":     //多条图文素材
            case "catering/subscription/material_writing_many_edit"://多条图文素材编辑
            /****公众号管理****/

            /****公众号管理-消息管理****/
            case "catering/news/message":                   //关键词自动回复
            case "catering/news/message_attention":         //关注后自动回复
            case "catering/news/message_default":           //默认回复
            case "catering/news/message_mass":              //消息群发
            /****公众号管理-消息管理****/

            /****公众号管理-菜单管理****/
            case "catering/menu/menu_customize":            //自定义菜单
            case "catering/menu/menu_different":            //个性化菜单
            /****公众号管理-菜单管理****/

            /****用户管理****/
            case "catering/user/user_tag":                  //粉丝标签管理
            case "catering/user/user_list":                 //粉丝用户管理
            case "catering/user/user_timeline":             //粉丝用户足迹
            /****用户管理****/

            /****下属管理--权限角色****/
            case "catering/role/role_add":                  //权限角色添加
            case "catering/role/role_list":                 //权限角色列表
            /****下属管理--权限角色****/

            /****下级人员管理--添加组****/
            case "catering/subordinate/subordinate_add":    //下级人员添加
            case "catering/subordinate/subordinate_list":   //下级人员列表
            case "catering/subordinate/quick_rule":         //添加下级人员快速授权
            /****下级人员管理--添加组****/

            /****财务管理****/
            case "catering/finance/balance":                //余额管理
            case "catering/finance/balance_recharge":       //余额详情
            case "catering/finance/credit":                 //积分管理
            case "catering/finance/credit_recharge":        //充值扣费
            case "catering/finance/commission":             //佣金管理
            /****财务管理****/

            /****支付设置****/
            case "catering/payment/wechat_setting":         //微信支付
            case "catering/payment/zerone_setting":         //零舍壹得
            case "catering/payment/sheng_setting":          //盛付通
            case "catering/payment/kuai_setting":           //快付通
            /****支付设置****/

            /****支付设置****/
            case "catering/goods/goods_category":           //商品分类查询
            case "catering/goods/goods_list":               //商品查询
            case "catering/goods/goods_detail":             //商品查看详情
            /****支付设置****/

            /****总分店管理****/
            case "catering/store/branch_create":            //创建总分店
            case "catering/store/branch_list":              //总分店管理
            /****总分店管理****/

            /****总分店管理****/
            case "catering/card/card_add":                  //添加会员卡
            case "catering/card/card_list":                 //会员卡管理
            case "catering/card/card_goods":                //调整适用商品
            /****总分店管理****/

                $re = $this->checkLoginAndRule($request);   //判断是否登录
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
                \ZeroneRedis::create_retail_account_cache(1,$admin_data);//生成账号数据的Redis缓存
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
        $sess_key = Session::get('retail_account_id');
        //如果为空跳转到登录页面
        if(empty($sess_key)) {
            return self::res(0,redirect('retail/login'));
        }else{
            $sess_key = Session::get('retail_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('retail');//连接到我的缓存服务器
            $admin_data = Redis::get('retail_system_admin_data_'.$sess_key);//获取管理员信息
            $menu_data = Redis::get('retail_system_menu_'.$sess_key);
            $son_menu_data = Redis::get('retail_system_menu_'.$sess_key);
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