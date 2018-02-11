<?php
namespace App\Services\Wechat;
require_once ("wxfiles/wxBizMsgCrypt.php");
/*
    全球 IPv4 地址归属地数据库(IPIP.NET 版)
*/

class WechatApi{
    public function test(){
        $info = \HttpCurl::doget('http://www.baidu.com');
        //dump($info);
    }

    /* 出于安全考虑，在第三方平台创建审核通过后，微信服务器 每隔10分钟会向第三方的消息接收地址推送一次component_verify_ticket，用于获取第三方平台接口调用凭据
     *  获取该参数
    */
    public function getVerify_Ticket(){
        $wxparam = config('app.wechat_open_setting');
        dump($wxparam);
    }
}
?>