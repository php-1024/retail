<?php
namespace App\Services\Wechat;
require_once ("wxfiles/wxBizMsgCrypt.php");
/*
    微信开放平台操作相关接口
*/

class WechatApi{
    public function test(){
        $info = \HttpCurl::doget('http://www.baidu.com');
        //dump($info);
    }

    /* 出于安全考虑，在第三方平台创建审核通过后，微信服务器 每隔10分钟会向第三方的消息接收地址推送一次component_verify_ticket，用于获取第三方平台接口调用凭据
     *  获取该参数
    */
    public function getVerify_Ticket($timeStamp,$nonce,$encrypt_type,$msg_sign,$encryptMsg){
        $wxparam = config('app.wechat_open_setting');
        $jm = new WXBizMsgCrypt( $wxparam['open_token'],  $wxparam['open_key'], $wxparam['open_appid']);
        $xml_tree = new DOMDocument();
        $xml_tree->loadXML($encryptMsg);
        $array_e = $xml_tree->getElementsByTagName('Encrypt');
        $encrypt = $array_e->item(0)->nodeValue;
        $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
        $from_xml = sprintf($format, $encrypt);
        $msg = '';
        $errCode = $jm->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
        if ($errCode == 0) {
            $xml = new DOMDocument();
            $xml->loadXML($msg);
            $array_e = $xml->getElementsByTagName('ComponentVerifyTicket');
            $component_verify_ticket = $array_e->item(0)->nodeValue;
            file_put_contents('component_verify_ticket.txt',$component_verify_ticket.'||'.time());
            return true;
        }else{
            return false;
        }
    }
}
?>