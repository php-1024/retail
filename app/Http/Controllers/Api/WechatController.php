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
        // 渲染页面
        return view('Simple/Wechat/display');

    }
}