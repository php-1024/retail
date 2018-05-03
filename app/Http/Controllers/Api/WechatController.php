<?php
/**
 * Wechat接口
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class WechatController extends Controller

{
    /**
     * 店铺列表
     */
    public function display(Request $request)
    {
//       echo session("zerone_auth_info.organization_id");
//       echo session("zerone_auth_info.zerone_user_id");
//       echo session("zerone_auth_info.shop_user_id");
        print_r(request()->get("zerone_jssdk_info"));
//        Session::put('appId', request()->get("zerone_jssdk_info.appId"));//存储登录session_id为当前用户ID
//        echo Session::get('appId');

        // 渲染页面
        return view('Simple/Wechat/display');

    }
}