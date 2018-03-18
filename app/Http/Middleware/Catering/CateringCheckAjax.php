<?php
/**
 * 检测中间件囖
 */
namespace App\Http\Middleware\Catering;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Request;

class CateringCheckAjax
{
    public function handle($request, Closure $next)
    {
        $route_name = $request->path();//获取当前的页面路由
        switch ($route_name) {
            case "catering/ajax/login_check"://检测登录数据提交
                $re = $this->checkLoginPost($request);
                return self::format_response($re, $next);
                break;

            case "catering/ajax/profile_check"://检测登录和权限和安全密码和账号信息是否为空
                $re = $this->checkLoginAndRuleAndSafeAndProfile($request);
                return self::format_response($re, $next);
                break;
            case "catering/ajax/password_check"://检测登录和权限和安全密码和登入密码
                $re = $this->checkLoginAndRuleAndSafeAndPassword($request);
                return self::format_response($re, $next);
                break;
            case "catering/ajax/safe_password_check"://设置安全密码
                $re = $this->checkLoginAndRuleAndSafeEdit($request);
                return self::format_response($re, $next);
                break;
            case "catering/ajax/role_add_check"://检测是否登录 权限 安全密码 和角色名不能为空--权限角色添加
                $re = $this->checkLoginAndRuleAndSafeAndRoleAdd($request);
                return self::format_response($re,$next);
                break;
            case "catering/ajax/subordinate_add_check"://检测 登录 和 权限 和 安全密码 和 添加下级人员的数据提交
                $re = $this->checkLoginAndRuleAndSafeAndSubordinateAdd($request);
                return self::format_response($re,$next);
                break;
            case "catering/ajax/subordinate_edit_check"://检测 登录 和 权限 和 安全密码 和 编辑下级人员的数据提交
                $re = $this->checkLoginAndRuleAndSafeAndSubordinateEdit($request);
                return self::format_response($re,$next);
                break;
            case "catering/ajax/subordinate_authorize_check"://检测 登录 和 权限 和 安全密码 和 编辑下级人员权限数据提交
                $re = $this->checkLoginAndRuleAndSafeAndSubordinateAuthorize($request);
                return self::format_response($re,$next);
                break;
            case "catering/ajax/label_add_check"://检测 登录 和 权限 和 安全密码 和 添加会员标签数据提交
            case "catering/ajax/label_edit_check"://检测 登录 和 权限 和 安全密码 和 编辑会员标签数据提交
                $re = $this->checkLoginAndRuleAndSafeAndLabelAdd($request);
                return self::format_response($re,$next);
                break;
            case "catering/ajax/user_list_edit_check"://检测 登录 和 权限 和 安全密码 和 用户编辑数据提交
                $re = $this->checkLoginAndRuleAndSafeAndUserEdit($request);
                return self::format_response($re,$next);
            case "catering/ajax/branch_create_check"://检测 登录 和 权限 和 安全密码 和 总分店添加数据提交
                $re = $this->checkLoginAndRuleAndSafeAndBranchCreate($request);
                return self::format_response($re,$next);
            case "catering/ajax/member_add_check"://检测 登录 和 权限 和 安全密码 和 会员卡添加数据提交
                $re = $this->checkLoginAndRuleAndSafeAndMemberAdd($request);
                return self::format_response($re,$next);

                break;

            case "api/ajax/material_article_add_check":  //单条文章素材上传检测
                $re = $this->checkLoginAndRuleAndMaterialArticleAdd($request);
                return self::format_response($re,$next);
                break;

            case "api/ajax/material_articles_add_check":  //单条文章素材上传检测
                $re = $this->checkLoginAndRuleAndMaterialArticlesAdd($request);
                return self::format_response($re,$next);
                break;

            case "api/ajax/material_article_edit_check":  //单条文章素材上传检测
                $re = $this->checkLoginAndRuleAndMaterialArticleEdit($request);
                return self::format_response($re,$next);
                break;

            case "api/ajax/material_articles_edit_check":  //单条文章素材上传检测
                $re = $this->checkLoginAndRuleAndMaterialArticlesEdit($request);
                return self::format_response($re,$next);
                break;

            case "api/ajax/auto_reply_add_check"://检测添加自动回复关键字
                $re = $this->checkLoginAndRuleAndAutoReplyAdd($request);
                return self::format_response($re,$next);
                break;

            case "api/ajax/auto_reply_edit_text_check"://检测自动回复文章数据提交
                $re = $this->checkLoginAndRuleAndAutoReplyEditText($request);
                return self::format_response($re,$next);
                break;

            case "api/ajax/auto_reply_edit_image_check"://检测自动回复图片素材啊数据提交
                $re = $this->checkLoginAndRuleAndAutoReplyEditImage($request);
                return self::format_response($re,$next);
                break;

            case "api/ajax/auto_reply_edit_article_check"://检测自动回复图文素材啊数据提交
                $re = $this->checkLoginAndRuleAndAutoReplyEditArticle($request);
                return self::format_response($re,$next);
                break;

            case "api/ajax/auto_reply_edit_check"://检测自动回复图文素材啊数据提交
                $re = $this->checkLoginAndRuleAndAutoReplyEdit($request);
                return self::format_response($re,$next);
                break;

            case "api/ajax/subscribe_reply_text_edit_check"://检测馆周后自动回复文本素材啊数据提交
                $re = $this->checkLoginAndRuleAndSubscribeReplyEdit($request);
                return self::format_response($re,$next);
                break;
            case "catering/ajax/role_edit_check"://检测是否登录 权限 安全密码
            case "catering/ajax/role_delete_check"://检测是否登录 权限 安全密码
            case "catering/ajax/subordinate_lock_check"://检测是否登录 权限 安全密码
            case "catering/ajax/label_delete_check"://检测是否登录 权限 安全密码--删除会员标签
            case "catering/ajax/user_list_lock_check"://检测是否登录 权限 安全密码--冻结粉丝标签
            case "api/ajax/material_image_delete_check"://检测是否登陆 权限 安全密码--删除图片素材
            case "api/ajax/material_article_delete_check"://检测是否登陆 权限 安全密码--删除图片素材
            case "api/ajax/auto_reply_delete_check"://检测是否登陆 权限 安全密码--删除关键字
                $re = $this->checkLoginAndRuleAndSafe($request);
                return self::format_response($re,$next);
                break;
            case "catering/ajax/role_edit":                 //编辑权限角色弹出框检测登入和权限
            case "catering/ajax/role_delete":               //编辑权限角色弹出框检测登入和权限
            case "catering/ajax/quick_rule":                //快速授权检测登入和权限
            case "catering/ajax/selected_rule":             //快速授权检测登入和权限
            case "catering/ajax/subordinate_edit":          //下级人员列表编辑用户弹出框
            case "catering/ajax/subordinate_lock":          //添加下级人员快速授权
            case "catering/ajax/subordinate_authorize":     //添加下级人员用户授权显示页面
            case "catering/ajax/subordinate_delete":        //添加下级人员用户授权显示页面
            case "catering/ajax/label_add":                 //添加会员标签显示页面
            case "catering/ajax/label_edit":                //编辑会员标签显示页面
            case "catering/ajax/label_delete":              //删除会员标签显示页面
            case "catering/ajax/store_label_add_check":     //粉丝会员标签改变显示页面
            case "catering/ajax/user_list_edit":            //会员列表编辑显示页面
            case "catering/ajax/user_list_lock":            //会员列表冻结显示页面
            case "catering/ajax/user_list_wallet":          //会员列表粉丝钱包显示页面
            case "api/ajax/meterial_image_upload":          //图片上传弹窗
            case "api/ajax/meterial_image_upload_check":   //图片上传检测
            case "api/ajax/material_image_delete_comfirm": //图片上传确认弹窗
            case "api/ajax/material_article_delete_comfirm": //文章上传确认弹窗
            case "api/ajax/material_image_select":        //图片选择弹窗
            case "api/ajax/defined_menu_add":              //自定义菜单添加
            case "api/ajax/defined_menu_get":              //自定义菜单添加
            case "api/ajax/auto_reply_add":              //自定义菜单添加
            case "api/ajax/auto_reply_edit_text":       //修改关键字回复文本内容
            case "api/ajax/auto_reply_edit_image":      //修改关键字回复图片内容
            case "api/ajax/auto_reply_edit_article":    //修改关键字回复图文内容
            case "api/ajax/auto_reply_edit"://修改自动回复关键字
            case "api/ajax/auto_reply_delete_confirm"://删除关键字弹窗
            case "api/ajax/subscribe_reply_text_edit"://修改关注后文本回复弹窗
            $re = $this->checkLoginAndRule($request);
                return self::format_response($re, $next);
                break;

        }
    }
    /******************************复合检测*********************************/
    //检测登陆，权限，修改关注后自动回复文本内容
    public function checkLoginAndRuleAndSubscribeReplyEdit($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkSubscribeReplyEdit($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登陆，权限，修改关键字
    public function checkLoginAndRuleAndAutoReplyEdit($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkAutoReplyEdit($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登陆，权限，修改关键字自动回复图文内容
    public function checkLoginAndRuleAndAutoReplyEditArticle($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkAutoReplyEditArticle($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登陆，权限，修改关键字自动回复图片内容
    public function checkLoginAndRuleAndAutoReplyEditImage($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkAutoReplyEditImage($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登陆，权限，修改自动回复关键字文本内容
    public function checkLoginAndRuleAndAutoReplyEditText($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkAutoReplyEditText($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登陆，权限，添加自动回复关键字
    public function checkLoginAndRuleAndAutoReplyAdd($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkAutoReplyAdd($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登陆，权限，和多条图文修改
    public function checkLoginAndRuleAndMaterialArticlesEdit($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkMaterialArticlesEdit($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登陆，权限，和图文修改
    public function checkLoginAndRuleAndMaterialArticleEdit($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkMaterialArticleEdit($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登陆，权限和上传多条图文素材
    public function checkLoginAndRuleAndMaterialArticleAdd($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkMaterialArticleAdd($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测登陆，权限和上传图文素材
    public function checkLoginAndRuleAndMaterialArticlesAdd($request){
        $re = $this->checkLoginAndRule($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkMaterialArticlesAdd($re['response']);//检测是否具有权限
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
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
    public function checkLoginAndRuleAndSafeAndProfile($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkProfile($re['response']);//检测参数是否为空
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
            $re2 = $this->checkSafePassword($re['response']);//检测安全密码是否正确
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
    //检测 登录 和 权限 和 安全密码 和 编辑下级人员权限数据提交
    public function checkLoginAndRuleAndSafeAndSubordinateAuthorize($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkSubordinateAuthorize($re['response']);//检测数据是否为空
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测 登录 和 权限 和 安全密码 和 会员标签添加数据提交
    public function checkLoginAndRuleAndSafeAndLabelAdd($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkLabelAdd($re['response']);//检测数据是否为空
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测 登录 和 权限 和 安全密码 和粉丝用户管理编辑数据提交
    public function checkLoginAndRuleAndSafeAndUserEdit($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkUserEdit($re['response']);//检测数据是否为空
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测 登录 和 权限 和 安全密码 和 分店添加数据提交
    public function checkLoginAndRuleAndSafeAndBranchCreate($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkBranchCreate($re['response']);//检测数据是否为空
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    //检测 登录 和 权限 和 安全密码 和 会员卡添加数据提交
    public function checkLoginAndRuleAndSafeAndMemberAdd($request){
        $re = $this->checkLoginAndRuleAndSafe($request);//判断是否登录
        if($re['status']=='0'){//检测是否登录
            return $re;
        }else{
            $re2 = $this->checkMemberAdd($re['response']);//检测数据是否为空
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
        if($admin_data['is_super'] == '2'){
            $key = config("app.zerone_safe_encrypt_key");//获取加密盐
        }else{
            $key = config("app.catering_safe_encrypt_key");//获取加密盐
        }
        $encrypted = md5($safe_password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        if(empty($safe_password)){
            return self::res(0,response()->json(['data' => '请输入安全密码', 'status' => '0']));
        }
        if(empty($admin_data['safe_password']) && $admin_data['is_super'] != '2'){
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
        $sess_key = Session::get('catering_account_id');
        //如果为空返回登录失效
        if (empty($sess_key)) {
            return self::res(0, response()->json(['data' => '登录状态失效', 'status' => '-1']));
        } else {
            $sess_key = Session::get('catering_account_id');//获取管理员ID
            $sess_key = decrypt($sess_key);//解密管理员ID
            Redis::connect('catering');//连接到我的缓存服务器
            $admin_data = Redis::get('catering_system_admin_data_' . $sess_key);//获取管理员信息
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
            return self::res(0, response()->json(['data' => '角色名称不能为空', 'status' => '0']));
        }
        return self::res(1, $request);
    }


    //检测账号中心-账号信息是否为空
    public function checkProfile($request){
        if (empty($request->input('realname'))) {
            return self::res(0, response()->json(['data' => '真实姓名不能为空', 'status' => '0']));
        }
        if (empty($request->input('mobile'))) {
            return self::res(0, response()->json(['data' => '手机号不能为空', 'status' => '0']));
        }
        return self::res(1, $request);
    }
    //检测账号中心-登入密码修改
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
        if(empty($request->input('mobile'))){
            return self::res(0,response()->json(['data' => '请输入联系方式', 'status' => '0']));
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
    //检测添加会员标签
    public function checkLabelAdd($request){
        if(empty($request->input('label_name'))){
            return self::res(0,response()->json(['data' => '请输入会员标签', 'status' => '0']));
        }
        return self::res(1,$request);
    }

    //检测添加总分店数数据
    public function checkUserEdit($request){
        if(empty($request->input('qq'))){
            return self::res(0,response()->json(['data' => '请输qq号', 'status' => '0']));
        }
        if(empty($request->input('mobile'))){
            return self::res(0,response()->json(['data' => '请输入手机号', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测添加总分店数数据
    public function checkBranchCreate($request){
        if(empty($request->input('program_id'))){
            return self::res(0,response()->json(['data' => '请选择程序模式', 'status' => '0']));
        }
        if(empty($request->input('organization_name'))){
            return self::res(0,response()->json(['data' => '请输入分店名称', 'status' => '0']));
        }
        if(empty($request->input('mobile'))){
            return self::res(0,response()->json(['data' => '请输入手机号', 'status' => '0']));
        }
        if(empty($request->input('realname'))){
            return self::res(0,response()->json(['data' => '请输入负责人姓名', 'status' => '0']));
        }
        if(empty($request->input('password'))){
            return self::res(0,response()->json(['data' => '请输入登入密码', 'status' => '0']));
        }
        if(empty($request->input('re_password'))){
            return self::res(0,response()->json(['data' => '请输入重复密码', 'status' => '0']));
        }
        if($request->input('password') <> $request->input('re_password')){
            return self::res(0,response()->json(['data' => '两次密码输入不一致', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测添加会员卡数据
    public function checkMemberAdd($request){
        if(empty($request->input('member_name'))){
            return self::res(0,response()->json(['data' => '请输入会员卡名称', 'status' => '0']));
        }
        if(empty($request->input('discount'))){
            return self::res(0,response()->json(['data' => '请输入折扣比例', 'status' => '0']));
        }
        if(empty($request->input('issue_mun'))){
            return self::res(0,response()->json(['data' => '请输入发行数量', 'status' => '0']));
        }
        if(empty($request->input('card_price'))){
            return self::res(0,response()->json(['data' => '请输入会员卡价格', 'status' => '0']));
        }
        if(empty($request->input('start_time'))){
            return self::res(0,response()->json(['data' => '请选择开始时间', 'status' => '0']));
        }
        if(empty($request->input('expire_time'))){
            return self::res(0,response()->json(['data' => '请选择结束时间', 'status' => '0']));
        }
        if(empty($request->input('adapt_store'))){
            return self::res(0,response()->json(['data' => '请选择适用的分店', 'status' => '0']));
        }
        return self::res(1,$request);
    }

    //检测编辑多条图文素材
    public function checkMaterialArticleEdit($request){
        if(empty($request->input('id'))){
            return self::res(0,response()->json(['data' => '错误的数据传输', 'status' => '0']));
        }
        if(empty($request->input('img_id'))){
            return self::res(0,response()->json(['data' => '请选择图片素材', 'status' => '0']));
        }
        if(empty($request->input('thumb_media_id'))){
            return self::res(0,response()->json(['data' => '请选择图片素材', 'status' => '0']));
        }
        if(empty($request->input('title'))){
            return self::res(0,response()->json(['data' => '请输入文章标题', 'status' => '0']));
        }
        if(empty($request->input('author'))){
            return self::res(0,response()->json(['data' => '请填写文章作者', 'status' => '0']));
        }
        if(empty($request->input('content'))){
            return self::res(0,response()->json(['data' => '请输入文章内容', 'status' => '0']));
        }
        return self::res(1,$request);
    }

    //检测关注后自动回复文本消息的内容
    public function checkSubscribeReplyEdit($request){
        if(empty($request->input('id'))){
            return self::res(0,response()->json(['data' => '错误的数据传输', 'status' => '0']));
        }
        if(empty($request->input('keyword'))){
            return self::res(0,response()->json(['data' => '请输入关键字', 'status' => '0']));
        }
        return self::res(1,$request);
    }

    //检测修改关键字内容
    public function checkAutoReplyEdit($request){
        if(empty($request->input('id'))){
            return self::res(0,response()->json(['data' => '错误的数据传输', 'status' => '0']));
        }
        if(empty($request->input('keyword'))){
            return self::res(0,response()->json(['data' => '请输入关键字', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测关键字自定义回复图文内容
    public function checkAutoReplyEditArticle($request){
        if(empty($request->input('id'))){
            return self::res(0,response()->json(['data' => '错误的数据传输', 'status' => '0']));
        }
        if(empty($request->input('article_id'))){
            return self::res(0,response()->json(['data' => '请选择图文素材', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测关键字自定义回复图片内容
    public function checkAutoReplyEditImage($request){
        if(empty($request->input('id'))){
            return self::res(0,response()->json(['data' => '错误的数据传输', 'status' => '0']));
        }
        if(empty($request->input('image_id'))){
            return self::res(0,response()->json(['data' => '请选择图片素材', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测关键字自定义回复文本内容
    public function checkAutoReplyEditText($request){
        if(empty($request->input('id'))){
            return self::res(0,response()->json(['data' => '错误的数据传输', 'status' => '0']));
        }
        if(empty($request->input('reply_info'))){
            return self::res(0,response()->json(['data' => '请输入自动回复文本内容', 'status' => '0']));
        }
        return self::res(1,$request);
    }
    //检测自动回复关键字
    public function checkAutoReplyAdd($request){
        if(empty($request->input('keyword'))){
            return self::res(0,response()->json(['data' => '请输入关键字', 'status' => '0']));
        }
        return self::res(1,$request);
    }

    //检测编辑单条图文素材
    public function checkMaterialArticlesEdit($request){
        if(empty($request->input('id'))){
            return self::res(0,response()->json(['data' => '错误的数据传输', 'status' => '0']));
        }
        $num = $request->input('num');
        for($i=1;$i<=$num;$i++){
            if(empty($request->input('img_id_'.$i))){
                return self::res(0,response()->json(['data' => '请选择第'.$i.'篇文章的图片素材', 'status' => '0']));
            }
            if(empty($request->input('thumb_media_id_'.$i))){
                return self::res(0,response()->json(['data' => '请选择第'.$i.'篇文章的图片素材', 'status' => '0']));
            }
            if(empty($request->input('title_'.$i))){
                return self::res(0,response()->json(['data' => '请输入第'.$i.'篇文章的文章标题', 'status' => '0']));
            }
            if(empty($request->input('author_'.$i))){
                return self::res(0,response()->json(['data' => '请填写第'.$i.'篇文章的文章作者', 'status' => '0']));
            }

            if(empty($request->input('content_'.$i))){
                return self::res(0,response()->json(['data' => '请输入第'.$i.'篇文章的文章内容', 'status' => '0']));
            }
        }
        return self::res(1,$request);
    }

    //检测上传单条图文素材
    public function checkMaterialArticleAdd($request){
        if(empty($request->input('img_id'))){
            return self::res(0,response()->json(['data' => '请选择图片素材', 'status' => '0']));
        }
        if(empty($request->input('thumb_media_id'))){
            return self::res(0,response()->json(['data' => '请选择图片素材', 'status' => '0']));
        }
        if(empty($request->input('title'))){
            return self::res(0,response()->json(['data' => '请输入文章标题', 'status' => '0']));
        }
        if(empty($request->input('author'))){
            return self::res(0,response()->json(['data' => '请填写文章作者', 'status' => '0']));
        }

        if(empty($request->input('content'))){
            return self::res(0,response()->json(['data' => '请输入文章内容', 'status' => '0']));
        }
        return self::res(1,$request);
    }

    //检测上传多条图文素材
    public function checkMaterialArticlesAdd($request){
        $num = $request->input('num');
        for($i=1;$i<=$num;$i++){
            if(empty($request->input('img_id_'.$i))){
                return self::res(0,response()->json(['data' => '请选择第'.$i.'篇文章的图片素材', 'status' => '0']));
            }
            if(empty($request->input('thumb_media_id_'.$i))){
                return self::res(0,response()->json(['data' => '请选择第'.$i.'篇文章的图片素材', 'status' => '0']));
            }
            if(empty($request->input('title_'.$i))){
                return self::res(0,response()->json(['data' => '请输入第'.$i.'篇文章的文章标题', 'status' => '0']));
            }
            if(empty($request->input('author_'.$i))){
                return self::res(0,response()->json(['data' => '请填写第'.$i.'篇文章的文章作者', 'status' => '0']));
            }

            if(empty($request->input('content_'.$i))){
                return self::res(0,response()->json(['data' => '请输入第'.$i.'篇文章的文章内容', 'status' => '0']));
            }
        }
        return self::res(1,$request);
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