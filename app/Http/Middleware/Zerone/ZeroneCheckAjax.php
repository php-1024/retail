<?php
/**
 * 检测中间件囖
 */
namespace App\Http\Middleware\Zerone;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class ZeroneCheckAjax
{
    public function handle($request, Closure $next)
    {
        $route_name = $request->path();//获取当前的页面路由
        switch ($route_name) {
            case "zerone/ajax/login_check"://检测登陆数据提交
                $re = $this->checkLoginPost($request);
                return self::format_response($re, $next);
                break;

            case "zerone/ajax/role_add_check"://检测登陆和权限和安全密码和添加角色
                $re = $this->checkLoginAndRuleAndSafeAndRoleAdd($request);
                return self::format_response($re, $next);
                break;

            case "zerone/ajax/role_edit"://检测登陆和权限
                $re = $this->checkLoginAndRule($request);
                return self::format_response($re, $next);
                break;
        }
    }
    /******************************复合检测*********************************/
    //检测登陆和权限和安全密码和添加角色
    public function checkLoginAndRuleAndSafeAndRoleAdd($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
            return $re;
        }else{
            $re2 = $this->checkRoleAdd($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登录和权限
    public function checkLoginAndRule($request){
        $re = $this->checkIsLogin($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
            return $re;
        }else{
            $re2 = $this->checkHasRule($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登录和权限和安全密码
    public function checkLoginAndRuleAndSafe($request){
        $re = $this->checkLoginAndRule($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
            return $re;
        }else{
            $re2 = $this->checkSafePassword($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    /******************************单项检测*********************************/
    //检测添加权限角色数据
    public function checkRoleAdd($request){
        if(empty($request->input('role_name'))){
            return self::res(0,response()->json(['data' => '请输入角色名称', 'status' => '0']));
        }
        if(empty($request->input('module_node_ids'))){
            return self::res(0,response()->json(['data' => '请勾选角色权限', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测安全密码是否输入正确
    public function checkSafePassword($request){
        $admin_data = $request->get('admin_data');
        $safe_password = $request->input('safe_password');
        $key = config("app.zerone_safe_encrypt_key");//获取加密盐
        $encrypted = md5($safe_password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        if(empty($safe_password)){
            return self::res(0,response()->json(['data' => '请输入安全密码', 'status' => '0']));
        }
        if(empty($admin_data['safe_password'])){
            return self::res(0,response()->json(['data' => '您尚未设置安全密码，请先前往 个人中心 》安全密码设置 设置', 'status' => '0']));
        }
        if($encryptPwd != $admin_data['safe_password']){
            return self::res(0,response()->json(['data' => '您输入的安全密码不正确', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //部分页面检测用户是否admin，否则检测是否有权限
    public function checkHasRule($request){
        $admin_data = $request->get('admin_data');
        if($admin_data['id']!=1){
            //暂定除admin外所有用户都没有权限
            return self::res(0, response()->json(['data' => '您没有该功能的权限！', 'status' => '0']));
            //return self::res(1,$request);
        }else{
            return self::res(1,$request);
        }
    }
    //检测是否登陆
    public function checkIsLogin($request)
    {
        $sess_key = Session::get('zerone_account_id');
        //如果为空返回登陆失效
        if (empty($sess_key)) {
            return self::res(0, response()->json(['data' => '登陆状态失效', 'status' => '-1']));
        } else {
            $sess_key = Session::get('zerone_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('zeo');//连接到我的缓存服务器
            $admin_data = Redis::get('zerone_system_admin_data_' . $sess_key);//获取管理员信息
            $admin_data = unserialize($admin_data);//解序列我的信息
            $request->attributes->add(['admin_data' => $admin_data]);//添加参数
            //把参数传递到下一个中间件
            return self::res(1, $request);
        }
    }
    //检测登陆提交数据
    public function checkLoginPost($request)
    {
        if (empty($request->input('username'))) {
            return self::res(0, response()->json(['data' => '请输入用户名或手机号码', 'status' => '0']));
        }
        if (empty($request->input('password'))) {
            return self::res(0, response()->json(['data' => '请输入登录密码', 'status' => '0']));
        }
        if (empty($request->input('captcha'))) {
            return self::res(0, response()->json(['data' => '请输入验证码', 'status' => '0']));
        }
        if (Session::get('zerone_system_captcha') == $request->input('captcha')) {
            //把参数传递到下一个程序
            return self::res(1, $request);
        } else {
            //用户输入验证码错误
            return self::res(0, response()->json(['data' => '验证码错误', 'status' => '0']));
        }
    }
    //工厂方法返回结果
    public static function res($status, $response)
    {
        return ['status' => $status, 'response' => $response];
    }
    //格式化返回值
    public static function format_response($re, Closure $next)
    {
        if ($re['status'] == '0') {
            return $re['response'];
        } else {
            return $next($re['response']);
        }
    }
}