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
        print_r(request()->get("zerone_auth_info"));exit;
        session("organization_id",request()->get("zerone_auth_info.organization_id"));
        session("zerone_user_id",request()->get("zerone_auth_info.zerone_user_id"));
        session("fansmanage_user_id",request()->get("zerone_auth_info.shop_user_id"));
        echo  $aa = Session::get('fansmanage_user_id');
        // 渲染页面
        return view('Simple/Wechat/display');

    }
}