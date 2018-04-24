<?php
/**
 * 检测是否登录的中间件
 */

namespace App\Http\Middleware\User;

use App\Models\FansmanageUser;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\WechatAuthorization;
use Closure;
use DB;
use Session;
use Illuminate\Support\Facades\Redis;


class UserCheck
{
    protected $wechat_info = [];
    protected $organization_id = 2;

    public function handle($request, Closure $next)
    {
        $route_name = $request->path();//获取当前的页面路由
        switch ($route_name) {
            case "pay/sft/test11":            //测试
                $this->authorizeInfo();
        }
        return $next($request);
    }

    public function authorizeInfo()
    {
        // 判断公众号是否授权给零壹第三方公众号平台
        $this->getShopBaseInfo();
        // 初次访问的地址
        $url = request()->fullUrl();

        // 刷新并获取授权令牌
        $authorization_info = \Wechat::refresh_authorization_info($this->organization_id);

        if ($authorization_info === false) {
            return "微信公众号没有授权到第三方";
        }

        // 判断是否存在 零壹服务用户id
        if (empty(session("zerone_auth_info.zerone_user_id"))) {
            $this->getAuthorizeZeroneInfo($url);
        }

        // 判断 session 中是否存在店铺id
        if (empty(session("zerone_auth_info.shop_user_id"))) {
            $this->getAuthorizeShopInfo($url);
        }

        // 添加参数
        request()->attributes->add(['zerone_auth_info' => session("zerone_auth_info")]);
    }


    public function getAuthorizeZeroneInfo($url)
    {
        // 获取 code 地址
        $code = request()->input('code');

        // 如果不存在zerone_openid就进行授权
        if (empty($code)) {
//            $url = request()->url();
            \Wechat::get_web_auth_url($url, config("app.wechat_web_setting.appid"));
        } else {
            // 保存相对应的数据
            $appid = config("app.wechat_web_setting.appid");
            $appsecret = config("app.wechat_web_setting.appsecret");
            $this->setAuthorizeZeroneInfo($appid, $appsecret, $code);
//            if ($res === true) {
//                $this->authorizeInfo();
////                $url = request()->url();
////                return redirect($url);
////                Header("Location:{$url}");
//            }
        }
    }


    public function getAuthorizeShopInfo($url)
    {
        $code = request()->input('code');
        $appid = $this->wechat_info["authorizer_appid"];
        if (empty($code)) {
            \Wechat::get_open_web_auth_url($appid, $url);
        } else {
            $this->setAuthorizeShopInfo($appid, $code);
        }
    }

    /**
     * 获取店铺公众号的基本信息
     */
    public function getShopBaseInfo()
    {
        // 获取公众号的基本信息
        $res = WechatAuthorization::getAuthInfo(["organization_id" => $this->organization_id], ["authorizer_appid", "authorizer_access_token"]);
        // 判断公众号是否在零壹第三方平台授权过
        if ($res !== false) {
            $this->wechat_info = $res;
        } else {
            // 公众号信息没有授权应该进行的步骤

        }
    }

    public function setAuthorizeZeroneInfo($appid, $appsecret, $code)
    {
        // 静默授权：通过授权使用的code,获取到用户openid
        $res_access_arr = \Wechat::get_web_access_token($code, $appid, $appsecret);

        // 如果不存在授权所特有的access_token,则重新获取code,并且验证
        if (!empty($res_access_arr['access_token'])) {
            $openid = $res_access_arr['openid'];
        } else {
            $this->getAuthorizeZeroneInfo(request()->url());
            return;
        }


        DB::beginTransaction();
        try {
            // 获取account 最大的值，然后就可以进行数据的累加
            $account = User::max("account");
            $param["account"] = ++$account;
            $param["password"] = 123456;
            $param["safepassword"] = 123456;
            $param["zerone_open_id"] = $openid;
            $param["mobile"] = "13333333333";
            $param["status"] = 1;
            $res = User::insertData($param, "update_create", ["zerone_open_id" => $param["zerone_open_id"]]);
            session(["zerone_auth_info.zerone_user_id" => $res["id"]]);
            // 数据提交
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }


    public function setAuthorizeShopInfo($appid, $code, $re_url = "")
    {
        // 静默授权：通过授权使用的code,获取到用户openid
        $res_access_arr = \Wechat::get_open_web_access_token($appid, $code);

        // 如果不存在授权所特有的access_token,则重新获取code,并且验证
        if (!empty($res_access_arr['access_token'])) {
            $openid = $res_access_arr['openid'];
        } else {
            $this->getAuthorizeShopInfo(request()->url());
            return;
        }

        DB::beginTransaction();
        try {
            // 店铺公众号的信息
            // 组织id
            $param["fansmanage_id"] = request()->get("organization_id");
            $param["user_id"] = session("zerone_auth_info.zerone_user_id");
            $param["open_id"] = $openid;
            $param["status"] = 1;
            // 创建或者更新粉丝数据
            $fansmanage_user = FansmanageUser::insertData($param, "update_create", ["open_id" => $param["open_id"]]);
            // 缓存用户的店铺id
            session(["zerone_auth_info.shop_user_id" => $fansmanage_user["id"]]);

            // 获取用户的信息
            $user_info = \Wechat::get_web_user_info($res_access_arr['access_token'], $openid);

            // 用户id
            $param_user_info["user_id"] = session("zerone_auth_info.zerone_user_id");
            $param_user_info["nickname"] = $user_info["nickname"];
            $param_user_info["sex"] = $user_info["sex"];
            $param_user_info["city"] = $user_info["city"];
            $param_user_info["country"] = $user_info["country"];
            $param_user_info["province"] = $user_info["province"];
            $param_user_info["head_imgurl"] = $user_info["headimgurl"];
            // 保存用户数据$
            $res = UserInfo::insertData($param_user_info);
            // 数据提交
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
