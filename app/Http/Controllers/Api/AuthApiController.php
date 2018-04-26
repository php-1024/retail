<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/26
 * Time: 14:17
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\FansmanageUser;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserOrigin;
use App\Models\WechatAuthorization;
use Illuminate\Support\Facades\DB;

class AuthApiController extends Controller
{
    protected $wechat_info = [];
    protected $organization_id = 2;


    public function test11()
    {
        var_dump(11);
        $zerone_auth_info = request()->get("zerone_auth_info");
        var_dump($zerone_auth_info);
    }

    public function test12()
    {
        var_dump(12);
        $zerone_auth_info = request()->get("zerone_auth_info");
        var_dump($zerone_auth_info);
    }

    /**
     * 获取 零壹服务 的授权信息
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function getZeroneAuth()
    {
        // 获取 code 地址
        $code = request()->input('code');
        // 如果不存在zerone_openid就进行授权
        if (empty($code)) {
            $url = request()->url();
            \Wechat::get_web_auth_url($url, config("app.wechat_web_setting.appid"));
        } else {
            // 保存相对应的数据
            $appid = config("app.wechat_web_setting.appid");
            $appsecret = config("app.wechat_web_setting.appsecret");
            $this->setAuthorizeZeroneInfo($appid, $appsecret, $code);
            return redirect(request()->root() . "/api/authApi/change_trains");
        }
    }

    /**
     * 获取店铺 公众号的授权信息
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function getShopAuth()
    {
        // 获取第三方授权信息
        $this->getShopBaseInfo(request()->get("organization_id"));
        $code = request()->input('code');
        $appid = $this->wechat_info["authorizer_appid"];
        $access_token = $this->wechat_info["authorizer_access_token"];

        if (empty($code)) {
            $url = request()->url();
            \Wechat::get_open_web_auth_url($appid, $url);
        } else {
            $this->setAuthorizeShopInfo($appid, $code, $access_token);
            return redirect(request()->root() . "/api/authApi/change_trains");
        }
    }

    /**
     * 保存零壹服务公众号的用户信息
     * @param $appid
     * @param $appsecret
     * @param $code
     * @return bool|void
     * @throws \Exception
     */
    public function setAuthorizeZeroneInfo($appid, $appsecret, $code)
    {
        // 静默授权：通过授权使用的code,获取到用户openid
        $res_access_arr = \Wechat::get_web_access_token($code, $appid, $appsecret);

        // 如果不存在授权所特有的access_token,则重新获取code,并且验证
        if (!empty($res_access_arr['access_token'])) {
            $openid = $res_access_arr['openid'];
        } else {
            $this->getZeroneAuth();
            return;
        }

        // 事务处理
        DB::beginTransaction();
        try {
            // 获取account 最大的值，然后就可以进行数据的累加
            $account = User::max("account");
            $param["account"] = ++$account;
            $param["password"] = 123456;
            $param["safepassword"] = 123456;
            $param["zerone_open_id"] = $openid;
            $res = User::insertData($param, "update_create", ["zerone_open_id" => $param["zerone_open_id"]]);

            session(["zerone_auth_info.zerone_user_id" => $res["id"]]);
            \Session::save();
            // 数据提交
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }


    /**
     * 保存店铺公众号的用户信息
     * @param $appid
     * @param $code
     * @param string $access_token
     * @return bool
     * @throws \Exception
     */
    public function setAuthorizeShopInfo($appid, $code, $access_token)
    {
        // 静默授权：通过授权使用的code,获取到用户openid
        $res_access_arr = \Wechat::get_open_web_access_token($appid, $code);


        // 如果不存在授权所特有的access_token,则重新获取code,并且验证
        if (!empty($res_access_arr['access_token'])) {
            $openid = $res_access_arr['openid'];
        } else {
            $this->getShopAuth();
            return ;
        }

        // 零壹用户id
        $zerone_user_id = session("zerone_auth_info.zerone_user_id");
        // 组织id
        $organization_id = request()->get("organization_id");

        // 事务处理
        DB::beginTransaction();
        try {
            // 店铺公众号数据处理
            // 组织id
            $param["fansmanage_id"] = $organization_id;
            // 用户id
            $param["user_id"] = $zerone_user_id;
            // 店铺公众号  openid
            $param["open_id"] = $openid;
            // 创建或者更新粉丝数据
            $fansmanage_user = FansmanageUser::insertData($param, "update_create", ["open_id" => $openid]);

            // 缓存用户的店铺id
            session(["zerone_auth_info.shop_user_id" => $fansmanage_user["id"]]);
            \Session::save();

            // 获取用户的信息
            $user_info = \Wechat::get_fans_info($access_token, $openid);
            // 用户数据处理
            $param_user_info["user_id"] = $zerone_user_id;
            $param_user_info["nickname"] = $user_info["nickname"];
            $param_user_info["sex"] = $user_info["sex"];
            $param_user_info["city"] = $user_info["city"];
            $param_user_info["country"] = $user_info["country"];
            $param_user_info["province"] = $user_info["province"];
            $param_user_info["head_imgurl"] = $user_info["headimgurl"];
            $param_user_info["remark"] = "";
            $param_user_info["qq"] = "";
            // 保存用户数据
            UserInfo::insertData($param_user_info);

            // 源头数据处理
            $param_user_origin["user_id"] = $zerone_user_id;
            $param_user_origin["fansmanager_id"] = $organization_id;
            // 保存源头数据
            UserOrigin::insertData($param_user_origin, "update_create", ["fansmanager_id" => $organization_id, "user_id" => $zerone_user_id]);

            // 数据提交
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }


    /**
     * 授权之后的 中转站
     */
    public function changeTrains()
    {
        $url = session("zerone_auth_info.initial_url_address");
        Header("Location:{$url}");
    }

    /**
     * 获取店铺公众号的基本信息
     */
    public function getShopBaseInfo($organization_id)
    {
        // 获取公众号的基本信息
        $res = WechatAuthorization::getAuthInfo(["organization_id" => $organization_id], ["authorizer_appid", "authorizer_access_token"]);
        // 判断公众号是否在零壹第三方平台授权过
        if ($res !== false) {
            $this->wechat_info = $res;
        } else {
            // 公众号信息没有授权应该进行的步骤

        }
    }

}