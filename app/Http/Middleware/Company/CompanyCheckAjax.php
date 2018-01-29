<?php
/**
 * 检测中间件囖
 */
namespace App\Http\Middleware\Company;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Request;

class CompanyCheckAjax
{
    public function handle($request, Closure $next)
    {
        $route_name = $request->path();//获取当前的页面路由
        switch ($route_name) {
            case "company/ajax/login_check"://检测登录数据提交
                $re = $this->checkLoginPost($request);
                return self::format_response($re, $next);
                break;
            case "company/ajax/company_select"://超级管理员选择商户提交数据
                $re = $this->checkIsLogin($request);
                return self::format_response($re, $next);
                break;
            case "company/ajax/password_edit_check"://检测登录，权限，及修改密码的数据
                $re = $this->checkLoginAndRuleAndPasswordEdit($request);
                return self::format_response($re, $next);
                break;
            //下面是冗余代码，待参考
            case "zerone/ajax/subordinate_lock"://冻结下级人员 检测 登录 和 权限 和 安全密码 和 ID是否为空
            case "zerone/ajax/role_delete"://删除权限角色 检测 登录 和 权限 和 安全密码 和 ID是否为空
                $re = $this->checkLoginAndRuleAndSafeAndID($request);
                return self::format_response($re, $next);
                break;
        }
    }
    /******************************复合检测*********************************/
    //检测登录，权限，及修改密码的数据
    public function checkLoginAndRuleAndPasswordEdit($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
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






    /**
     * @param $request
     * @return array
     */

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
    //检测 登录 和 权限 和 安全密码 和 编辑下级人员权限数据提交
    public function checkLoginAndRuleAndSafeAndSubordinateAuthorize($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
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

    //检测 登录 和 权限 和 安全密码 和 添加服务商的数据提交
    public function checkLoginAndRuleAndSafeAndProxyAdd($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
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

    //检测登录和权限和安全密码和添加角色
    public function checkLoginAndRuleAndSafeAndRoleEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
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
    //检测登录和权限和安全密码和添加角色
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
    //检测登录和权限和安全密码和编辑系统参数而设置
    public function checkLoginAndRuleAndSafeAndSetupEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
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
    //服务商 检测登录和权限和安全密码
    public function checkLoginAndRuleAndSafeAndOrgEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
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
    //商户 检测登录和权限和安全密码
    public function checkLoginAndRuleAndSafeAndComEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkComEditData($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测 登录 和 权限 和 安全密码 和 添加服务商的数据提交
    public function checkLoginAndRuleAndSafeAndCompanyAdd($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
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
    //检测 登录 和 权限 和 安全密码 和 修改战区的数据提交
    public function checkLoginAndRuleAndSafeAndWarzoneAdd($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkWarzoneAdd($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }

    //检测 登录 和 权限 和 安全密码 和 修改战区的数据提交
    public function checkLoginAndRuleAndSafeAndWarzoneEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkWarzoneEdit($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }

    //检测 登录 和 权限 和 安全密码 和 修改战区的数据提交
    public function checkLoginAndRuleAndSafeAndPersonalEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkPersonalEdit($re['response']);//检测是否具有权限
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

    /******************************单项检测*********************************/
    //检测编辑个人信息数据
    public function checkPersonalEdit(Request $request){
        if(empty($request->input('realname'))){
            return self::res(0,response()->json(['data' => '请输入用户真实姓名', 'status' => '0']));
        }
        if(empty($request->input('mobile'))){
            return self::res(0,response()->json(['data' => '请输入用户手机号码', 'status' => '0']));
        }
        return self::res(1,$request);
    }
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
    //检测修改登录密码
    public function checkPasswordEdit($request){
        if(empty($request->input('password'))){
            return self::res(0,response()->json(['data' => '请输入原登录密码', 'status' => '0']));
        }
        if(empty($request->input('new_password'))){
            return self::res(0,response()->json(['data' => '新登录密码不能为空', 'status' => '0']));
        }
        if(empty($request->input('news_password'))){
            return self::res(0,response()->json(['data' => '请确认新登录密码是否一致', 'status' => '0']));
        }
        if($request->input('new_password') != $request->input('news_password')){
            return self::res(0,response()->json(['data' => '新密码和重复密码不一致', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测修改设置安全密码
    public function checkSafepasswordEdit($request){
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
    //检测是否登录
    public function checkIsLogin($request)
    {
        //获取用户登录存储的SessionId
        $sess_key = Session::get('zerone_company_account_id');
        $super_sess_key = Session::get('zerone_super_company_account_id');
        //如果为空跳转到登录页面
        if(!empty($sess_key)) {
            $sess_key = Session::get('zerone_company_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('company');//连接到我的缓存服务器
            $admin_data = Redis::get('company_system_admin_data_'.$sess_key);//获取管理员信息
            $admin_data = unserialize($admin_data);//解序列我的信息
            $request->attributes->add(['admin_data'=>$admin_data]);//添加参数
            //把参数传递到下一个中间件
            return self::res(1,$request);
        }elseif (!empty($super_sess_key)){
            $sess_key = Session::get('zerone_super_company_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('company');//连接到我的缓存服务器
            $admin_data = Redis::get('super_company_system_admin_data_'.$sess_key);//获取管理员信息
            $admin_data = unserialize($admin_data);//解序列我的信息
            $request->attributes->add(['admin_data'=>$admin_data]);//添加参数
            //把参数传递到下一个中间件
            return self::res(1,$request);
        }else{
            return self::res(0, response()->json(['data' => '登录状态失效', 'status' => '-1']));
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
            return self::res(0, response()->json(['data' => '请输入服务商登录密码', 'status' => '0']));
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
            return self::res(0, response()->json(['data' => '请输入服务商登录密码', 'status' => '0']));
        }elseif ($request->input('proxy_password')!=$request->input('re_proxy_password')){
            return self::res(0, response()->json(['data' => '两次密码不一致', 'status' => '0']));
        }
        return self::res(1, $request);
    }
    //检测战区添加表信息
    public function checkWarzoneAdd($request){
        if (empty($request->input('zone_name'))) {
            return self::res(0, response()->json(['data' => '请输入战区名称', 'status' => '0']));
        }
        if (empty($request->input('province_id'))) {
            return self::res(0, response()->json(['data' => '请选择战区包含省份', 'status' => '0']));
        }
        if (empty($request->input('safe_password'))) {
            return self::res(0, response()->json(['data' => '请输入安全密码', 'status' => '0']));
        }
        return self::res(1, $request);
    }
    //检测战区编辑表信息
    public function checkWarzoneEdit($request){
        if (empty($request->input('zone_name'))) {
            return self::res(0, response()->json(['data' => '请输入战区名称', 'status' => '0']));
        }
        if (empty($request->input('safe_password'))) {
            return self::res(0, response()->json(['data' => '请输入安全密码', 'status' => '0']));
        }
        return self::res(1, $request);
    }
    //检测服务商编辑表信息
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
    //检测商户编辑表信息
    public function checkComEditData($request){
        if (empty($request->input('organization_name'))) {
            return self::res(0, response()->json(['data' => '请输入商户名称', 'status' => '0']));
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