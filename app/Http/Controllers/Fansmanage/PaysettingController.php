<?php
/**
 * 粉丝管理系统
 * 支付设置
 **/

namespace App\Http\Controllers\Fansmanage;

use App\Http\Controllers\Controller;
use App\Models\WechatAuthorization;
use App\Models\WechatPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaysettingController extends Controller
{

    /**
     * 微信支付设置
     */
    public function wechat_setting(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 中间件产生的菜单数据参数
        $menu_data = $request->get('menu_data');
        // 中间件产生的子菜单数据参数
        $son_menu_data = $request->get('son_menu_data');
        // 获取当前的页面路由
        $route_name = $request->path();

        // 店铺id
        $fansmanage_id = $admin_data['organization_id'];
        // 支付信息
        $pay_info = [];
        // 获取公众号的信息
        $authorize_info = WechatAuthorization::getAuthInfo(["organization_id" => $fansmanage_id], ["authorizer_appid"]);

        if (!empty($res)) {
            $pay_info = WechatPay::getInfo(["organization_id" => $fansmanage_id], ["appid", "appsecret", "mchid", "api_key", "apiclient_cert_pem", "apiclient_key_pem", "status"]);
        }

        return view('Fansmanage/Paysetting/wechat_setting', ["authorize_info" => $authorize_info, "pay_info" => $pay_info, 'admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }
}

