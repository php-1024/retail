<?php
/**
 * 检测是否登录的中间件
 */

namespace App\Http\Middleware\User;

use App\Models\FansmanageUser;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\WechatAuthorization;
use App\Models\XhoLog;
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
            case "pay/sft/test14":            //测试
                $this->authorizeInfo();
        }
        return $next($request);
    }

    public function authorizeInfo()
    {
        // 判断公众号是否授权给零壹第三方公众号平台
        $res = $this->getShopBaseInfo();
        if($res === false){
            return "微信公众号没有授权到第三方";
        }

        $self_path = ["pay/sft/test12","pay/sft/test13","pay/sft/test14"];
        // 初次访问的地址
        $url = request()->fullUrl();

        if(!in_array(request()->path(),$self_path)) {
            session(["zerone_auth_info.initial_url_address" => $url]);
        }

        // 刷新并获取授权令牌
        $authorization_info = \Wechat::refresh_authorization_info($this->organization_id);
        if ($authorization_info === false) {
            return "微信公众号没有授权到第三方";
        }


        // 判断是否存在 零壹服务用户id
        if (empty(session("zerone_auth_info.zerone_user_id"))) {
            XhoLog::create(["name"=>"跳转1","content"=>"zerone_user_id"]);
            Header("Location:http://develop.01nnt.com/pay/sft/test12");
        }


        var_dump(session("zerone_auth_info"));
        exit;

        // 判断 session 中是否存在店铺id
        if (empty(session("zerone_auth_info.shop_user_id"))) {
            XhoLog::create(["name"=>"跳转3","content"=>"shop_user_id"]);
            Header("Location:http://develop.01nnt.com/pay/sft/test13");
        }

        // 添加参数
        request()->attributes->add(['zerone_auth_info' => session("zerone_auth_info")]);
    }

    /**
     * 获取店铺公众号的基本信息
     */
    public function getShopBaseInfo()
    {
        // 获取公众号的基本信息
        $res = WechatAuthorization::getAuthInfo(["organization_id" => $this->organization_id], ["authorizer_appid", "authorizer_access_token"]);
        // 判断公众号是否在零壹第三方平台授权过
        return $res;
    }
}