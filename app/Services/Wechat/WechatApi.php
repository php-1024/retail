<?php
namespace App\Services\Wechat;
use App\Models\WechatOpenSetting;
use App\Models\WechatAuthorizationInfo;
use App\Services\Wechat\wxfiles\WXBizMsgCrypt;
/*
    微信开放平台操作相关接口
*/

class WechatApi{
    public function test(){
        //$info = \HttpCurl::doget('http://www.baidu.com');
        //dump($info);
        echo 1234;
    }

    /*
     * 获取授权信息
     * $auth_code  公众号授权后回调时返回的授权码
     * $organization_id 该公众号关联组织ID
     */
    public function get_authorization_info($auth_code,$organization_id){
        $wxparam = config('app.wechat_open_setting');
        $component_access_token = $this->get_component_access_token();
        $url = 'https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token='.$component_access_token;
        $data = array(
            'component_appid'=>$wxparam['open_appid'],
            'authorization_code'=>$auth_code
        );
        $data = json_encode($data);
        $origin_re =  \HttpCurl::doPost($url,$data);
        $re = json_decode($origin_re,true);
        if(!empty($re['authorization_info'])){
            //授权方APPID
            $authorizer_appid = $re['authorization_info']['authorizer_appid'];
            //第三方调用接口令牌
            $authorizer_access_token = $re['authorization_info']['authorizer_access_token'];
            //第三方刷新调用接口令牌
            $authorizer_refresh_token = $re['authorization_info']['authorizer_refresh_token'];

            $auth_data = array(
                'organization_id'=>$organization_id,
                'authorizer_appid'=>$authorizer_appid,
                'authorizer_access_token'=>$authorizer_access_token,
                'authorizer_refresh_token'=>$authorizer_refresh_token,
                'origin_data'=>$origin_re,
                'status'=>1,
                'expire_time'=>time()+7200,
            );

            WechatAuthorizationInfo::addInfo($auth_data);

            return array(
                'authorizer_appid'=> $re['authorization_info']['authorizer_appid'],
                'authorizer_access_token'=>$re['authorization_info']['authorizer_access_token'],
                'authorizer_refresh_token'=>$re['authorization_info']['authorizer_refresh_token']
            );
        }else{
            exit('授权失败，请重新授权');
        }
    }

    /*
     * 获取授权链接
     */
    public function get_auth_url(){
        $wxparam = config('app.wechat_open_setting');
        $open_appid = $wxparam['open_appid'];//第三方平台方appid
        $pre_auth_code = $this->get_pre_auth_code();//预授权码
        $redirect_url = 'http://o2o.01nnt.com/api/wechat/redirect';//回调链接
        $auth_type = 3;//1则商户扫码后，手机端仅展示公众号、2表示仅展示小程序，3表示公众号和小程序都展示
        $url = "https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid=" . $open_appid . "&pre_auth_code=" . $pre_auth_code . "&redirect_uri=".$redirect_url."&auth_type=".$auth_type;
        return $url;
    }
    /*
   *获取开放平台的预授权码
   */
    public function get_pre_auth_code(){
        $auth_info = WechatOpenSetting::getPreAuthCode();
        if(!empty($auth_info->param_value) && $auth_info->expire_time - time() > 00){//过时前60秒也需要重置了
            return $auth_info->param_value;
        }
        $wxparam = config('app.wechat_open_setting');
        $component_access_token = $this->get_component_access_token();
        $url = 'https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token='.$component_access_token;
        $data = array(
            'component_appid'=>$wxparam['open_appid']
        );
        $data = json_encode($data);
        $re = \HttpCurl::doPost($url, $data);
        $re = json_decode($re,true);
        if (!empty($re['pre_auth_code'])) {
            WechatOpenSetting::editPreAuthCode($re['pre_auth_code'],time()+600);
            return $re['pre_auth_code'];
        }else{
            return false;
        }
    }

    /*
     *获取开放平台的接口调用凭据
     */
    public function get_component_access_token(){
        $token_info = WechatOpenSetting::getComponentAccessToken();
        if(!empty($token_info->param_value) && $token_info->expire_time - time() > 300){//过时前5分钟也需要重置了
            return $token_info->param_value;
        }
        $wxparam = config('app.wechat_open_setting');
        $ticket_info = WechatOpenSetting::getComponentVerifyTicket();
        if(empty($ticket_info->param_value)){
            exit('获取微信开放平台ComponentVerifyTicket失败');
        }else{
            $url = 'https://api.weixin.qq.com/cgi-bin/component/api_component_token';
            $data = array(
                'component_appid' => $wxparam['open_appid'],
                'component_appsecret' => $wxparam['open_appsecret'],
                'component_verify_ticket' => $ticket_info->param_value
            );
            $data = json_encode($data);
            $re = \HttpCurl::doPost($url, $data);
            $re = json_decode($re,true);
            if (!empty($re['component_access_token'])) {
                WechatOpenSetting::editComponentAccessToken($re['component_access_token'],time()+7200);
                return $re['component_access_token'];
            }else{
                exit('获取微信开放平台ComponentAccessToken失败');
            }
        }
    }
    /* 出于安全考虑，在第三方平台创建审核通过后，微信服务器 每隔10分钟会向第三方的消息接收地址推送一次component_verify_ticket，用于获取第三方平台接口调用凭据
     *  获取该参数
    */
    public function getVerify_Ticket($timeStamp,$nonce,$encrypt_type,$msg_sign,$encryptMsg){
        $wxparam = config('app.wechat_open_setting');
        $jm = new WXBizMsgCrypt($wxparam['open_token'],  $wxparam['open_key'], $wxparam['open_appid']);
        $xml_tree = new \DOMDocument();
        $xml_tree->loadXML($encryptMsg);
        $array_e = $xml_tree->getElementsByTagName('Encrypt');
        $encrypt = $array_e->item(0)->nodeValue;
        $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
        $from_xml = sprintf($format, $encrypt);
        $msg = '';
        $errCode = $jm->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
        if ($errCode == 0) {
            $xml = new \DOMDocument();
            $xml->loadXML($msg);
            $array_e = $xml->getElementsByTagName('ComponentVerifyTicket');
            $component_verify_ticket = $array_e->item(0)->nodeValue;
            WechatOpenSetting::editComponentVerifyTicket($component_verify_ticket,time()+550);
            return true;
        }else{
            return false;
        }
    }
}
?>