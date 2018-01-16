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

            case "zerone/ajax/role_edit_check"://检测登陆和权限和安全密码和编辑角色
                $re = $this->checkLoginAndRuleAndSafeAndRoleEdit($request);
                return self::format_response($re, $next);
                break;

            case "zerone/ajax/setup_edit_check"://检测 登陆 和 权限 和 安全密码 和 编辑系统参数设置
                $re = $this->checkLoginAndRuleAndSafeAndSetupEdit($request);
                return self::format_response($re, $next);
                break;

            case "zerone/ajax/proxy_add_check"://检测服务商名称 负责人姓名 负责人身份证号 手机号码 服务商登陆密码 安全密码是否为空
                $re = $this->checkLoginAndRuleAndSafeAndProxyAdd($request);
                return self::format_response($re,$next);
                break;
            case "zerone/ajax/proxy_examine"://检测 登录 和 权限
                $re = $this->checkLoginAndRule($request);
                return self::format_response($re,$next);
                break;
            case "zerone/ajax/proxy_list_edit"://检测 登录 和 权限
                $re = $this->checkLoginAndRule($request);
                return self::format_response($re,$next);
                break;
            case "zerone/ajax/proxy_list_frozen"://检测 登录 和 权限
                $re = $this->checkLoginAndRule($request);
                return self::format_response($re,$next);
                break;
            case "zerone/ajax/proxy_list_frozen_check"://检测 登录 和 权限 和 安全密码 和数据是否为空
                $re = $this->checkLoginAndRuleAndSafe($request);
                return self::format_response($re,$next);
                break;
            case "zerone/ajax/proxy_list_delete"://检测 登录 和 权限
                $re = $this->checkLoginAndRule($request);
                return self::format_response($re,$next);
                break;
            case "zerone/ajax/proxy_list_edit_check"://检测 登录 和 权限 和 安全密码 和数据是否为空
                $re = $this->checkLoginAndRuleAndSafeAndOrgEdit($request);
                return self::format_response($re,$next);
                break;
            case "zerone/ajax/proxy_examine_check"://检测 登录 和 权限 和 安全密码
                $re = $this->checkLoginAndRuleAndSafe($request);
                return self::format_response($re,$next);
                break;

            case "zerone/ajax/subordinate_add_check"://检测 登录 和 权限 和 安全密码 和 添加下级人员的数据提交
                $re = $this->checkLoginAndRuleAndSafeAndSubordinateAdd($request);
                return self::format_response($re,$next);
                break;

            case "zerone/ajax/subordinate_edit_check"://检测 登录 和 权限 和 安全密码 和 编辑下级人员的数据提交
                $re = $this->checkLoginAndRuleAndSafeAndSubordinateEdit($request);
                return self::format_response($re,$next);
                break;

            case "zerone/ajax/subordinate_authorize_check"://检测 登录 和 权限 和 安全密码 和 编辑下级人员权限数据提交
                $re = $this->checkLoginAndRuleAndSafeAndSubordinateAuthorize($request);
                return self::format_response($re,$next);
                break;

            case "zerone/ajax/password_edit_check"://检测 登录 和 权限 和 安全密码 和 修改登录密码权限数据提交
                $re = $this->checkLoginAndRuleAndSafeAndPasswordEdit($request);
                return self::format_response($re,$next);
                break;

            case "zerone/ajax/safe_password_edit_check"://检测 登录 和 权限 和 安全密码 和 修改登录密码权限数据提交
                $re = $this->checkLoginAndRuleAndSafeAndSafepasswordEdit($request);
                return self::format_response($re,$next);
                break;
            case "zerone/ajax/company_add_check"://检测商户名称 负责人姓名 负责人身份证号 手机号码 服务商登陆密码 安全密码是否为空
                $re = $this->checkLoginAndRuleAndSafeAndCompanyAdd($request);
                return self::format_response($re,$next);
                break;

            case "zerone/ajax/subordinate_delete_confirm"://删除下级人员管理页面弹出框
            case "zerone/ajax/subordinate_authorize"://授权下级人员管理页面弹出框
            case "zerone/ajax/subordinate_lock_confirm"://冻结下级人员安全密码弹出框检测登陆和权限
            case "zerone/ajax/role_delete_comfirm"://删除权限角色安全密码弹出框检测登陆和权限
            case "zerone/ajax/role_edit"://修改权限角色弹出框检测登陆和权限
            case "zerone/ajax/subordinate_edit"://修改权限角色弹出框检测登陆和权限
            case "zerone/ajax/quick_rule"://添加下架人员快速授权检测登陆和权限
            case "zerone/ajax/selected_rule"://添加下架人员快速授权检测登陆和权限
                $re = $this->checkLoginAndRule($request);
                return self::format_response($re, $next);
                break;

            case "zerone/ajax/subordinate_lock"://冻结下级人员 检测 登陆 和 权限 和 安全密码 和 ID是否为空
            case "zerone/ajax/role_delete"://删除权限角色 检测 登陆 和 权限 和 安全密码 和 ID是否为空
                $re = $this->checkLoginAndRuleAndSafeAndID($request);
                return self::format_response($re, $next);
                break;
        }
    }
    /******************************复合检测*********************************/
    //检测安全密码
    public function checkLoginAndRuleAndSafeAndSafepasswordEdit($request){
        $admin_data = $request->get('admin_data');
        if($admin_data['safe_password'] == ''){
            $re = $this->checkLoginAndRule($request);//判断是否登陆
            if($re['status']=='0'){//检测是否登陆
                return $re;
            }else{
                return self::res(1,$request);
            }

        }else{
            $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登陆
            if($re['status']=='0'){//检测是否登陆
                return $re;
            }else{
                $re2 = $this->checkSafepasswordEdit($re['response']);//检测修改或者设置的安全密码是否正常
                if($re2['status']=='0'){
                    return $re2;
                }else{
                    return self::res(1,$re2['response']);
                }
            }
        }
    }
    //检测登录和权限和安全密码
    public function checkLoginAndRuleAndSafeAndPasswordEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
            return $re;
        }else{
            $re2 = $this->checkPasswordEdit($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测 登录 和 权限 和 安全密码 和 编辑下级人员权限数据提交
    public function checkLoginAndRuleAndSafeAndSubordinateAuthorize($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
            return $re;
        }else{
            $re2 = $this->checkSubordinateAuthorize($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }

    //检测 登录 和 权限 和 安全密码 和 添加下级人员的数据提交
    public function checkLoginAndRuleAndSafeAndSubordinateEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
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

    //检测 登录 和 权限 和 安全密码 和 添加下级人员的数据提交
    public function checkLoginAndRuleAndSafeAndSubordinateAdd($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
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

    //检测 登录 和 权限 和 安全密码 和 添加服务商的数据提交
    public function checkLoginAndRuleAndSafeAndProxyAdd($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
            return $re;
        }else{
            $re2 = $this->checkProxyAdd($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登陆和权限和安全密码和ID是否为空
    public function checkLoginAndRuleAndSafeAndID($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
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

    //检测登陆和权限和安全密码和添加角色
    public function checkLoginAndRuleAndSafeAndRoleEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
            return $re;
        }else{
            $re2 = $this->checkRoleEdit($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
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
    //检测登陆和权限和安全密码和编辑系统参数而设置
    public function checkLoginAndRuleAndSafeAndSetupEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
            return $re;
        }else{
            $re2 = $this->checkSetupEdit($re['response']);//检测是否具有权限
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
    //检测登录和权限和安全密码
    public function checkLoginAndRuleAndSafeAndOrgEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
            return $re;
        }else{
            $re2 = $this->checkOrgEditData($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测 登录 和 权限 和 安全密码 和 添加服务商的数据提交
    public function checkLoginAndRuleAndSafeAndCompanyAdd($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登陆
        if($re['status']=='0'){//检测是否登陆
            return $re;
        }else{
            $re2 = $this->checkCompanyAdd($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }

    /******************************单项检测*********************************/
    //检测编辑下级人员权限数据
    public function checkSubordinateAuthorize($request){
        if(empty($request->input('id'))){
            return self::res(0,response()->json(['data' => '数据传输错误', 'status' => '0']));
        }
        if(empty($request->input('role_id'))){
            return self::res(0,response()->json(['data' => '请选择用户角色', 'status' => '0']));
        }
        if(empty($request->input('module_node_ids'))){
            return self::res(0,response()->json(['data' => '请勾选用户权限', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测编辑下级人员数据
    public function checkSubordinateEdit($request){
        if(empty($request->input('id'))){
            return self::res(0,response()->json(['data' => '数据传输错误', 'status' => '0']));
        }
        if(empty($request->input('realname'))){
            return self::res(0,response()->json(['data' => '请输入真实姓名', 'status' => '0']));
        }
        if(empty($request->input('mobile'))){
            return self::res(0,response()->json(['data' => '请输入联系方式', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测修改登陆密码
    public function checkPasswordEdit($request){
        if(empty($request->input('password'))){
            return self::res(0,response()->json(['data' => '请输入原登陆密码', 'status' => '0']));
        }
        if(empty($request->input('new_password'))){
            return self::res(0,response()->json(['data' => '新登陆密码不能为空', 'status' => '0']));
        }
        if(empty($request->input('news_password'))){
            return self::res(0,response()->json(['data' => '请确认新登陆密码是否一致', 'status' => '0']));
        }
        if($request->input('new_password') != $request->input('news_password')){
            return self::res(0,response()->json(['data' => '新密码和重复密码不一致', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测修改设置安全密码
    public function checkSafepasswordEdit($request){
        if(empty($request->input('safe_password'))){
            return self::res(0,response()->json(['data' => '请输入原安全密码', 'status' => '0']));
        }
        if(empty($request->input('new_safe_password'))){
            return self::res(0,response()->json(['data' => '新安全密码不能为空', 'status' => '0']));
        }
        if(empty($request->input('news_safe_password'))){
            return self::res(0,response()->json(['data' => '请确认新安全密码是否一致', 'status' => '0']));
        }
        if($request->input('new_safe_password') != $request->input('news_safe_password')){
            return self::res(0,response()->json(['data' => '新密码和重复密码不一致', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测添加下级人员数据
    public function checkSubordinateAdd($request){
        if(empty($request->input('account'))){
            return self::res(0,response()->json(['data' => '请输入用户账号', 'status' => '0']));
        }
        if(empty($request->input('password'))){
            return self::res(0,response()->json(['data' => '请输入用户登陆密码', 'status' => '0']));
        }
        if(empty($request->input('repassword'))){
            return self::res(0,response()->json(['data' => '请再次输入用户登陆密码', 'status' => '0']));
        }
        if($request->input('password')<>$request->input('repassword')){
            return self::res(0,response()->json(['data' => '两次登陆密码输入不一致', 'status' => '0']));
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
    //检测编辑系统参数设置数据
    public function checkSetupEdit($request){
        if(empty($request->input('serviceurl'))){
            return self::res(0,response()->json(['data' => '请输入服务商通道链接', 'status' => '0']));
        }
        if(empty($request->input('merchanturl'))){
            return self::res(0,response()->json(['data' => '请输入商户通道链接', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测编辑权限角色数据
    public function checkRoleEdit($request){
        if(empty($request->input('id'))){
            return self::res(0,response()->json(['data' => '数据传输错误', 'status' => '0']));
        }
        if(empty($request->input('role_name'))){
            return self::res(0,response()->json(['data' => '请输入角色名称', 'status' => '0']));
        }
        if(empty($request->input('module_node_ids'))){
            return self::res(0,response()->json(['data' => '请勾选角色权限', 'status' => '0']));
        }
        return self::res(1,$request);
    }
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
            //return self::res(0, response()->json(['data' => '您没有该功能的权限！', 'status' => '-1']));
            return self::res(1,$request);
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
    //检测服务商申请表信息
    public function checkProxyAdd($request){
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
        if (empty($request->input('proxy_password'))) {
            return self::res(0, response()->json(['data' => '请输入服务商登陆密码', 'status' => '0']));
        }elseif ($request->input('proxy_password')!=$request->input('re_proxy_password')){
            return self::res(0, response()->json(['data' => '两次密码不一致', 'status' => '0']));
        }
        return self::res(1, $request);
    }
    //检测商户申请表信息
    public function checkCompanyAdd($request){
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
        if (empty($request->input('proxy_password'))) {
            return self::res(0, response()->json(['data' => '请输入服务商登陆密码', 'status' => '0']));
        }elseif ($request->input('proxy_password')!=$request->input('re_proxy_password')){
            return self::res(0, response()->json(['data' => '两次密码不一致', 'status' => '0']));
        }
        return self::res(1, $request);
    }
    //检测服务商申请表信息
    public function checkOrgEditData($request){
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

    //检测登陆提交数据
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