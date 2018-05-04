<?php
/**
 * Wechat接口
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WechatWebAuthorization;
use App\Services\Curl\HttpCurl;
use Session;

class WechatController extends Controller

{
    /**
     * 店铺列表
     */
    public function display(Request $request)
    {
        // 获取微信公众号JSSDK 凭证
        $this->getSignPackage();
        // 获取组织id
        $organization_id = request()->get("organization_id");
        // 赋值
        $zerone_jssdk_info = (request()->get("zerone_jssdk_info"));
        // 渲染页面
        return view('Simple/Wechat/display', ['appId' => $zerone_jssdk_info['appId'], 'nonceStr' => $zerone_jssdk_info['nonceStr'], 'timestamp' => $zerone_jssdk_info['timestamp'], 'rawString' => $zerone_jssdk_info['rawString'], 'signature' => $zerone_jssdk_info['signature'], 'organization_id' => $organization_id]);
    }

    /**
     * 店铺列表
     */
    public function goodslist(Request $request)
    {

        // 渲染页面
        return view('Simple/Wechat/goodslist');
    }

    /**
     * 获取 wx.config 里面的签名,JSSDk 所需要的
     */
    public function getSignPackage()
    {
        $wxid = "gh_c548784211ab";
        $wechat_config = WechatWebAuthorization::getWechatConfig($wxid);
        $res = WechatWebAuthorization::updateWechatVoucher($wechat_config, ["jssdk"]);

        // 设置得到签名的参数
        $url = request()->fullUrl();
        $timestamp = time();
        $nonceStr = substr(md5(time()), 0, 16);
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket={$res["jsapi_ticket"]}&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);
        $signPackage = array("appId" => $res["appid"], "nonceStr" => $nonceStr, "timestamp" => $timestamp, "url" => $url, "rawString" => $string, "signature" => $signature);

        request()->attributes->add(['zerone_jssdk_info' => $signPackage]);
    }


}