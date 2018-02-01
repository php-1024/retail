<?php
/**
 * 检测中间件囖
 */
namespace App\Http\Middleware\Proxy;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Request;

class ProxyCheckAjax
{
    public function handle($request, Closure $next)
    {
        $route_name = $request->path();//获取当前的页面路由
        switch ($route_name) {
            case "proxy/ajax/login_check"://检测登录数据提交
                $re = $this->checkLoginPost($request);
                return self::format_response($re, $next);
                break;

            case "proxy/ajax/proxy_info_check"://检测登录和权限和安全密码和公司信息是否为空
                $re = $this->checkLoginAndRuleAndSafeAndProxyInfo($request);
                return self::format_response($re, $next);
                break;
            case "proxy/ajax/account_info_check"://检测登录和权限和安全密码和公司信息是否为空
                $re = $this->checkLoginAndRuleAndSafeAndAccountInfo($request);
                return self::format_response($re, $next);
                break;
            case "proxy/ajax/password_check"://检测登录和权限和安全密码和公司信息是否为空
                $re = $this->checkLoginAndRuleAndSafeAndPassword($request);
                return self::format_response($re, $next);
                break;
            case "proxy/ajax/safe_password_check"://设置安全密码
                $re = $this->checkLoginAndRuleAndSafeEdit($request);
                return self::format_response($re, $next);
                break;
            case "proxy/ajax/company_assets_check"://检测是否登录 权限 安全密码 数字不能为空
                $re = $this->checkLoginAndRuleAndSafeAndAssets($request);
                return self::format_response($re,$next);
                break;
            case "proxy/ajax/role_add_check"://检测是否登录 权限 安全密码 和角色名不能为空--权限角色添加
                $re = $this->checkLoginAndRuleAndSafeAndRoleAdd($request);
                return self::format_response($re,$next);
                break;
            case "proxy/ajax/subordinate_add_check"://检测 登录 和 权限 和 安全密码 和 添加下级人员的数据提交
                $re = $this->checkLoginAndRuleAndSafeAndSubordinateAdd($request);
                return self::format_response($re,$next);
                break;
            case "proxy/ajax/subordinate_edit_check"://检测 登录 和 权限 和 安全密码 和 编辑下级人员的数据提交
                $re = $this->checkLoginAndRuleAndSafeAndSubordinateEdit($request);
                return self::format_response($re,$next);
                break;

            case "proxy/ajax/role_edit_check"://检测是否登录 权限 安全密码
            case "proxy/ajax/role_delete_check"://检测是否登录 权限 安全密码
                $re = $this->checkLoginAndRuleAndSafe($request);
                return self::format_response($re,$next);
                break;
            case "proxy/ajax/company_assets":   //商户资产划入检测弹出登入和权限
            case "proxy/ajax/role_edit":        //编辑权限角色弹出框检测登入和权限
            case "proxy/ajax/role_delete"://编辑权限角色弹出框检测登入和权限
            case "proxy/ajax/quick_rule"://快速授权检测登入和权限
            case "proxy/ajax/selected_rule"://快速授权检测登入和权限
            case "proxy/ajax/subordinate_edit"://下级人员列表编辑用户弹出框
            case "proxy/ajax/subordinate_lock":  //添加下级人员快速授权
            $re = $this->checkLoginAndRule($request);
                return self::format_response($re, $next);
                break;

        }
    }
    /******************************复合检测*********************************/
    //检测登录，权限，及修改安全密码的数据
    public function checkLoginAndRuleAndSafepasswordEdit($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkSafepasswordEdit($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登录和权限和安全密码和服务商修改信息
    public function checkLoginAndRuleAndSafeAndProxyInfo($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkProxyInfo($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登录和权限和安全密码和个人修改信息
    public function checkLoginAndRuleAndSafeAndAccountInfo($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkAccountInfo($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登录和权限和安全密码和登入密码修改信息
    public function checkLoginAndRuleAndSafeAndPassword($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkPassword($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }



    //检测登录和权限和安全密码和ID是否为空
    public function checkLoginAndRuleAndSafeAndID($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkID($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }


    //检测登录和权限
    public function checkLoginAndRule($request){
        $re = $this->checkIsLogin($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
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
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
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


    //检测是否登录 权限 安全密码 数字不能为空
    public function checkLoginAndRuleAndSafeAndAssets($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkAssets($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测是否登录 权限 安全密码--权限角色添加
    public function checkLoginAndRuleAndSafeAndRoleAdd($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
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

    //检测是否登录 权限 修改安全密码
    public function checkLoginAndRuleAndSafeEdit($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录和权限
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkSafeEdit($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测 登录 和 权限 和 安全密码 和 添加下级人员的数据提交
    public function checkLoginAndRuleAndSafeAndSubordinateAdd($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkSubordinateAdd($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测 登录 和 权限 和 安全密码 和 添加下级人员的数据提交
    public function checkLoginAndRuleAndSafeAndSubordinateEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkSubordinateEdit($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测添加下级人员数据
    public function checkSubordinateAdd($request){
        if(empty($request->input('password'))){
            return self::res(0,response()->json(['data' => '请输入用户登录密码', 'status' => '0']));
        }
        if(empty($request->input('repassword'))){
            return self::res(0,response()->json(['data' => '请再次输入用户登录密码', 'status' => '0']));
        }
        if($request->input('password')<>$request->input('repassword')){
            return self::res(0,response()->json(['data' => '两次登录密码输入不一致', 'status' => '0']));
        }
        if(empty($request->input('realname'))){
            return self::res(0,response()->json(['data' => '请输入用户真实姓名', 'status' => '0']));
        }
        if(empty($request->input('mobile'))){
            return self::res(0,response()->json(['data' => '请输入用户手机号码', 'status' => '0']));
        }
        if(empty($request->input('role_id'))){
            return self::res(0,response()->json(['data' => '请为用户选择权限角色', 'status' => '0']));
        }
        if(empty($request->input('module_node_ids'))){
            return self::res(0,response()->json(['data' => '请勾选用户权限节点', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    /******************************单项检测*********************************/



    //检测修改设置安全密码
    public function checkSafeEdit($request){
        if(empty($request->input('is_editing'))){
            return self::res(0,response()->json(['data' => '数据传输错误', 'status' => '0']));
        }

        if($request->input('is_editing')=='-1'){//设置安全密码时
            if(empty($request->input('safe_password'))){
                return self::res(0,response()->json(['data' => '请输入安全密码', 'status' => '0']));
            }
            if(empty($request->input('re_safe_password'))){
                return self::res(0,response()->json(['data' => '请重复安全密码', 'status' => '0']));
            }
            if($request->input('safe_password') <> $request->input('re_safe_password')){
                return self::res(0,response()->json(['data' => '两次安全密码输入不一致', 'status' => '0']));
            }
        }elseif($request->input('is_editing')=='1'){//修改安全密码时
            if(empty($request->input('old_safe_password'))){
                return self::res(0,response()->json(['data' => '请输入旧安全密码', 'status' => '0']));
            }
            if(empty($request->input('safe_password'))){
                return self::res(0,response()->json(['data' => '请输入新安全密码', 'status' => '0']));
            }
            if(empty($request->input('re_safe_password'))){
                return self::res(0,response()->json(['data' => '请重复新安全密码', 'status' => '0']));
            }
            if($request->input('safe_password') <> $request->input('re_safe_password')){
                return self::res(0,response()->json(['data' => '两次安全密码输入不一致', 'status' => '0']));
            }
        }
        return self::res(1,$request);
    }


    //检测安全密码是否输入正确
    public function checkSafePassword($request){
        $admin_data = $request->get('admin_data');
        $safe_password = $request->input('safe_password');

        if($admin_data['super_id'] == '2'){
            $key = config("app.zerone_safe_encrypt_key");//获取加密盐
            $encrypted = md5($safe_password);//加密密码第一重
            $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        }else{
            $key = config("app.proxy_safe_encrypt_key");//获取加密盐
            $encrypted = md5($safe_password);//加密密码第一重
            $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        }
        if(empty($safe_password)){
            return self::res(0,response()->json(['data' => '请输入安全密码', 'status' => '0']));
        }
        if(empty($admin_data['safe_password']) && $admin_data['super_id'] != '2'){
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
            //return self::res(0, response()->json(['data' => '您没有该功能的权限！', 'status' => '-1']));
            return self::res(1,$request);
        }else{
            return self::res(1,$request);
        }
    }
    //检测是否登录
    public function checkIsLogin($request)
    {
        $sess_key = Session::get('proxy_account_id');
        //如果为空返回登录失效
        if (empty($sess_key)) {
            return self::res(0, response()->json(['data' => '登录状态失效', 'status' => '-1']));
        } else {
            $sess_key = Session::get('proxy_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('proxy');//连接到我的缓存服务器
            $admin_data = Redis::get('proxy_system_admin_data_' . $sess_key);//获取管理员信息
            $admin_data = unserialize($admin_data);//解序列我的信息
            $request->attributes->add(['admin_data' => $admin_data]);//添加参数
            //把参数传递到下一个中间件
            return self::res(1, $request);
        }
    }
    //检测登录提交数据
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
//        if (Session::get('zerone_system_captcha') == $request->input('captcha')) {
//            //把参数传递到下一个程序
            return self::res(1, $request);
//        } else {
//            //用户输入验证码错误
//            return self::res(0, response()->json(['data' => '验证码错误', 'status' => '0']));
//        }
    }
  //检测是否登录 权限 安全密码--权限角色添加
    public function checkRoleAdd($request)
    {
        if (empty($request->input('role_name'))) {
            return self::res(0, response()->json(['data' => '角色名称', 'status' => '0']));
        }
        return self::res(1, $request);
    }


    //检测公司信息设置
    public function checkProxyInfo($request){
        if (empty($request->input('organization_name'))) {
            return self::res(0, response()->json(['data' => '请输入服务商名称', 'status' => '0']));
        }
        if (empty($request->input('realname'))) {
            return self::res(0, response()->json(['data' => '请输入负责人姓名', 'status' => '0']));
        }
        if (empty($request->input('idcard'))) {
            return self::res(0, response()->json(['data' => '请输入负责人身份证号', 'status' => '0']));
        }
        if (empty($request->input('mobile'))) {
            return self::res(0, response()->json(['data' => '请输入手机号码', 'status' => '0']));
        }
        return self::res(1, $request);
    }
    //检测个人信息修改
    public function checkAccountInfo($request){

        if (empty($request->input('realname'))) {
            return self::res(0, response()->json(['data' => '请输入负责人姓名', 'status' => '0']));
        }
        if (empty($request->input('mobile'))) {
            return self::res(0, response()->json(['data' => '请输入手机号码', 'status' => '0']));
        }
        return self::res(1, $request);
    }
    //检测登入密码修改
    public function checkPassword($request){

        if(empty($request->input('old_password'))){
            return self::res(0,response()->json(['data' => '请输入原密码', 'status' => '0']));
        }
        if(empty($request->input('password'))){
            return self::res(0,response()->json(['data' => '请输入新密码', 'status' => '0']));
        }
        if(empty($request->input('re_password'))){
            return self::res(0,response()->json(['data' => '请重复新密码', 'status' => '0']));
        }
        if($request->input('password') <> $request->input('re_password')){
            return self::res(0,response()->json(['data' => '两次安全密码输入不一致', 'status' => '0']));
        }
        return self::res(1, $request);
    }
    //检测编辑下级人员数据
    public function checkSubordinateEdit($request){
        if(empty($request->input('id'))){
            return self::res(0,response()->json(['data' => '数据传输错误', 'status' => '0']));
        }
        if(empty($request->input('realname'))){
            return self::res(0,response()->json(['data' => '请输入真实姓名', 'status' => '0']));
        }
//        if(empty($request->input('mobile'))){
//            return self::res(0,response()->json(['data' => '请输入联系方式', 'status' => '0']));
//        }
        return self::res(1,$request);
    }


    //检测商户编辑表信息
    public function checkAssets($request){
        $num = $request->input('num');
        if (preg_match("/^[1-9]{1}\d{0,9}$/",$num)){
            return self::res(1, $request);
        }else{
            return self::res(0, response()->json(['data' => '请输入正确的数量', 'status' => '0']));
        }
    }


    //检测登录提交数据
    public function checkID($request)
    {
        if (empty($request->input('id'))) {
            return self::res(0, response()->json(['data' => '无效的数据传输', 'status' => '0']));
        }
        return self::res(1, $request);
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