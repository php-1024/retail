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
        print_r(request()->get("zerone_auth_info."));exit;
        echo 1;
        // 渲染页面
        return view('Simple/Wechat/display');

    }
}