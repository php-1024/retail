<?php
/**
 * 检测是否登录的中间件
 */

namespace App\Http\Middleware\Api;

use App\Models\Account;
use App\Models\WechatAuthorization;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class WechatApiCheck
{
    public function handle($request, Closure $next)
    {
        // 获取当前的页面路由
        $route_name = $request->path();
        switch ($route_name) {
            case "api/wechatApi/store_list"://检测店铺列表提交数据
                $re = $this->checkTokenAndStoreList($request);
                return self::format_response($re, $next);
                break;
            case "api/wechatApi/category"://检测店铺分类提交数据
            case "api/wechatApi/goods_list"://检测店铺分类提交数据
            case "api/wechatApi/shopping_cart_add"://检测店铺分类提交数据
                $re = $this->checkTokenAndCategory($request);
                return self::format_response($re, $next);
                break;

            // 测试
            case "api/authApi/test11" :
//                 零壹服务授权
//            case "api/authApi/zerone_auth" :
//                // 商户公众号授权
//            case "api/authApi/shop_auth" :
                // 授权完毕中转站
            case "api/authApi/change_trains" :

                request()->attributes->add(['organization_id' => 2]);
                $this->checkToken($request);

        }
        return $next($request);
    }


    /******************************复合检测*********************************/

    /**
     * 检测token值 And 店铺列表提交数据
     */
    public function checkTokenAndStoreList($request)
    {
        $re = $this->checkToken($request);//判断Token值是否正确
        if ($re['status'] == '0') {
            return $re;
        } else {
            $re2 = $this->checkStoreList($re['response']);//检测数据提交
            if ($re2['status'] == '0') {
                return $re2;
            } else {
                return self::res(1, $re2['response']);
            }
        }
    }

    /**
     * 检测token值 And 店铺分类列表提交数据
     */
    public function checkTokenAndCategory($request)
    {
        $re = $this->checkRetailId($request);//判断Token值是否正确
        if ($re['status'] == '0') {
            return $re;
        } else {
            return self::res(1, $re['response']);
        }
    }


    /******************************单项检测*********************************/


    /**
     * 店铺列表数据提交检测
     */
    public function checkStoreList($request)
    {
        if (empty($request->input('organization_id'))) {
            return self::res(0, response()->json(['msg' => '商户id不能为空', 'status' => '0', 'data' => '']));
        }
        if (empty($request->input('lat'))) {
            return self::res(0, response()->json(['msg' => '微信地理位置纬度不能为空', 'status' => '0', 'data' => '']));
        }
        if (empty($request->input('lng'))) {
            return self::res(0, response()->json(['msg' => '微信地理位置经度不能为空', 'status' => '0', 'data' => '']));
        }
        return self::res(1, $request);
    }


    /**
     * 店铺分类列表数据提交检测
     */
    public function checkRetailId($request)
    {
        if (empty($request->input('retail_id'))) {
            return self::res(0, response()->json(['msg' => '店铺id不能为空', 'status' => '0', 'data' => '']));
        }
        return self::res(1, $request);
    }


    /**
     * 进入所有页面的前置流程
     */
    public function checkToken($request)
    {
//        return self::res(1, $request);

        // 获取组织id
        $organization_id = request()->get("organization_id");

        // 判断公众号是否授权给零壹第三方公众号平台
        $res = $this->getShopBaseInfo($organization_id);
        if ($res === false) {
            exit("微信公众号没有授权到第三方");
        }

        // 跳转自己的地址
        $self_path = ["api/authApi/zerone_auth", "api/authApi/shop_auth", "api/authApi/change_trains"];
        // 初次访问的地址
        $url = request()->fullUrl();

        if (!in_array(request()->path(), $self_path)) {
            session(["zerone_auth_info.initial_url_address" => $url]);
        }

        dd($organization_id);
        // 刷新并获取授权令牌
        $authorization_info = \Wechat::refresh_authorization_info($organization_id);


        if ($authorization_info === false) {
            return "微信公众号没有授权到第三方";
        }

        // 判断是否存在 零壹服务用户id
        if (empty(session("zerone_auth_info.zerone_user_id"))) {
            Header("Location:" . request()->root() . "/api/authApi/zerone_auth");
        }

        // 判断 session 中是否存在店铺id
        if (empty(session("zerone_auth_info.shop_user_id"))) {
            Header("Location:" . request()->root() . "/api/authApi/shop_auth");
        }

        // 添加参数
        request()->attributes->add(['zerone_auth_info' => session("zerone_auth_info")]);
    }

    /**
     * 获取店铺公众号的基本信息
     * @param $organization_id
     * @return bool
     */
    public function getShopBaseInfo($organization_id)
    {
        // 获取公众号的基本信息
        $res = WechatAuthorization::getAuthInfo(["organization_id" => $organization_id], ["authorizer_appid", "authorizer_access_token"]);
        // 判断公众号是否在零壹第三方平台授权过
        return $res;
    }


    /**
     * 工厂方法返回结果
     */
    public static function res($status, $response)
    {
        return ['status' => $status, 'response' => $response];
    }

    /**
     * 格式化返回值
     */
    public static function format_response($re, Closure $next)
    {
        if ($re['status'] == '0') {
            return $re['response'];
        } else {
            return $next($re['response']);
        }
    }

}

?>