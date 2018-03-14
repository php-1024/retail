<?php
namespace App\Services\Wechat;
use App\Models\WechatOpenSetting;
use App\Models\WechatAuthorization;
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
     * 第三方平台代公众号页面授权链接，第一步，通过授权链接获取code
    */
    public function get_open_web_auth_url($appid,$redirect_url){
        $wxparam = config('app.wechat_open_setting');
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_url.'&response_type=code&scope=snsapi_userinfo&state=lyxkj2018&component_appid='.$wxparam['open_appid'].'#wechat_redirect';
        return $url;
    }
    /*
     * 第三方平台代公众号获取页面授权第二步，获取access_token
     */
    public function get_open_web_access_token($appid,$auth_code){
        $component_access_token = $this->get_component_access_token();
        $wxparam = config('app.wechat_open_setting');
        $url = 'https://api.weixin.qq.com/sns/oauth2/component/access_token?appid='.$appid.'&code='.$auth_code.'&grant_type=authorization_code&component_appid='.$wxparam['open_appid'].'&component_access_token='.$component_access_token;
        $re = \HttpCurl::doGet($url);
        $re = json_decode($re,true);
        return $re;
    }


    /*
     * 获取用户对于默认零壹公众号的唯一open_id;
     * $auth_code 用户授权后获取的授权码
     */
    public function get_web_access_token($auth_code){
        $wxparam = config('app.wechat_web_setting');
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$wxparam['appid'].'&secret='.$wxparam['appsecret'].'&code='.$auth_code.'&grant_type=authorization_code';
        $re = \HttpCurl::doGet($url);
        $re = json_decode($re,true);
        return $re;
    }

    /*
     * 获取网页授权链接，
     * $appid:默认公众号ID
     * $redirect_uri:回调链接
     */
    public function get_web_auth_url($redirect_uri){
        $wxparam = config('app.wechat_web_setting');
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$wxparam['appid'].'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_userinfo&state=lyxkj2018#wechat_redirect';
        return $url;
    }



    /*
     * 创建自定义菜单
     * $authorizer_access_token 第三方平台调用接口凭证
     * $menu_data 创建的菜单数据
     */
    public function create_menu($authorizer_access_token,$menu_data){
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$authorizer_access_token;
        $data = json_encode($menu_data, JSON_UNESCAPED_UNICODE);
        $re = \HttpCurl::doPost($url,$data);
        return $re;
    }

    /*
     * 查询自定义菜单
     * $authorizer_access_token 第三方平台调用接口凭证
     */
    public function search_menu($authorizer_access_token){
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$authorizer_access_token;
        $re = \HttpCurl::doGet($url);
        return $re;
    }

    /*
     * 删除自定义菜单
     * $authorizer_access_token 第三方平台调用接口凭证
     */
    public function delete_menu($authorizer_access_token){
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$authorizer_access_token;
        $re = \HttpCurl::doGet($url);
        return $re;
    }

    /*
     * 发送客服消息
     * $authorizer_access_token 第三方平台调用接口凭证
     * $text 发送内容
     */
    public function send_fans_text($authorizer_access_token,$to_user,$text){
        $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$authorizer_access_token;
        $data = [
            'touser'=>$to_user,
            'msgtype'=>'text',
            'text'=>[
                'content'=>$text,
            ],
        ];
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $re = \HttpCurl::doPost($url,$data);
        dump($re);
    }
    /*
     * 获取粉丝信息详情
     *  $authorizer_access_token 第三方平台调用接口凭证
     * $open_id 粉丝在该公众号下的open_id
     */
    public function get_fans_info($authorizer_access_token,$open_id){
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$authorizer_access_token.'&openid='.$open_id.'&lang=zh_CN ';
        $re = \HttpCurl::doGet($url);
        $re = json_decode($re,true);
        dump($re);
    }

    /*
     * 获取粉丝列表
     *  $authorizer_access_token 第三方平台调用接口凭证
     */
    public function get_fans_list($authorizer_access_token,$next_openid=''){
        $url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$authorizer_access_token.'&next_openid='.$next_openid;
        $re = \HttpCurl::doGet($url);
        $re = json_decode($re,true);
        return $re;
    }

    /*
     * 创建粉丝标签
     * organization_id 绑定授权组织的ID
     */
    public function create_fans_tag($authorizer_access_token,$tag_name){
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token='.$authorizer_access_token;
        $data = [
            'tag'=>[
                'name'=>$tag_name,
            ],
        ];
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $re = \HttpCurl::doPost($url,$data);
        return $re;
    }

    /*
     * 获取授权方基本信息
     * 授权方APPID
     */
    public function get_authorizer_info($authorizer_appid){
        $wxparam = config('app.wechat_open_setting');
        $component_access_token = $this->get_component_access_token();
        $url = 'https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_info?component_access_token='.$component_access_token;
        $data = array(
            'component_appid'=>$wxparam['open_appid'],
            'authorizer_appid'=>$authorizer_appid,
        );
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $re =  \HttpCurl::doPost($url,$data);
        $re = json_decode($re,true);
        return $re;
    }

    /*
     * 刷新授权调用令牌凭证
     * $organization_id 绑定的组织ID
     */
    public function refresh_authorization_info($organization_id){
        $info = WechatAuthorization::getOne([['organization_id',$organization_id]]);
        if(empty($info)||empty($info->authorizer_access_token)){
            exit('您尚未授权，请先前往进行授权操作');
        }
        if($info->expire_time - time()>600){//仍未过期直接返回值
            return array(
                'authorizer_appid'=> $info->authorizer_appid,
                'authorizer_access_token'=>$info->authorizer_access_token,
                'authorizer_refresh_token'=>$info->authorizer_refresh_token,
            );
        }
        $wxparam = config('app.wechat_open_setting');
        $component_access_token = $this->get_component_access_token();
        $url = 'https://api.weixin.qq.com/cgi-bin/component/api_authorizer_token?component_access_token='.$component_access_token;
        $data = array(
            'component_appid'=>$wxparam['open_appid'],
            'authorizer_appid'=>$info->authorizer_appid,
            'authorizer_refresh_token'=>$info->authorizer_refresh_token,
        );
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $origin_re =  \HttpCurl::doPost($url,$data);
        $re = json_decode($origin_re,true);
        if(!empty($re['authorizer_access_token'])){
            $authorizer_access_token = $re['authorizer_access_token'];
            $authorizer_refresh_token = $re['authorizer_refresh_token'];
            $auth_data = array(
                'authorizer_access_token'=>$authorizer_access_token,
                'authorizer_refresh_token'=>$authorizer_refresh_token,
                'origin_data'=>$origin_re,
                'expire_time'=>time()+7200,
            );
            WechatAuthorization::editAuthorization([['id',$info->id]],$auth_data);
            return array(
                'authorizer_appid'=> $info->authorizer_appid,
                'authorizer_access_token'=>$authorizer_access_token,
                'authorizer_refresh_token'=>$authorizer_refresh_token,
            );
        }else{
            return false;
        }
    }

    /*
     * 授权并保存授权信息
     * $auth_code  公众号授权后回调时返回的授权码
     * $organization_id 该公众号关联组织ID
     */
    public function get_authorization_info($auth_code){
        $wxparam = config('app.wechat_open_setting');
        $component_access_token = $this->get_component_access_token();
        $url = 'https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token='.$component_access_token;
        $data = array(
            'component_appid'=>$wxparam['open_appid'],
            'authorization_code'=>$auth_code
        );
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $origin_re =  \HttpCurl::doPost($url,$data);
        $re = json_decode($origin_re,true);
        if(!empty($re['authorization_info'])){
            //授权方APPID
            $authorizer_appid = $re['authorization_info']['authorizer_appid'];
            //第三方调用接口令牌
            $authorizer_access_token = $re['authorization_info']['authorizer_access_token'];
            //第三方刷新调用接口令牌
            $authorizer_refresh_token = $re['authorization_info']['authorizer_refresh_token'];
            return array(
                'authorizer_appid'=> $authorizer_appid,
                'authorizer_access_token'=>$authorizer_access_token,
                'authorizer_refresh_token'=>$authorizer_refresh_token ,
                'origin_re'=>$origin_re,
            );
        }else{
            exit('授权失败，请重新授权');
        }
    }

    /*
     * 获取授权链接
     */
    public function get_auth_url($origanization_id){
        $wxparam = config('app.wechat_open_setting');
        $open_appid = $wxparam['open_appid'];//第三方平台方appid
        $pre_auth_code = $this->get_pre_auth_code();//预授权码
        $redirect_url = 'http://o2o.01nnt.com/api/wechat/redirect';//回调链接
        $auth_type = 3;//1则商户扫码后，手机端仅展示公众号、2表示仅展示小程序，3表示公众号和小程序都展示
        $url = "https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid=" . $open_appid . "&pre_auth_code=" . $pre_auth_code . "&redirect_uri=".$redirect_url.'?organization_id='.$origanization_id."&auth_type=".$auth_type;
        return $url;
    }
    /*
   *获取开放平台的预授权码
   */
    public function get_pre_auth_code(){
        $wxparam = config('app.wechat_open_setting');
        $component_access_token = $this->get_component_access_token();
        $url = 'https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token='.$component_access_token;
        $data = array(
            'component_appid'=>$wxparam['open_appid']
        );
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
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
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
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
            $param = $this->xml2array($msg);
            switch ($param ['InfoType']) {
                case 'component_verify_ticket' : // 授权凭证
                        $component_verify_ticket = $param ['ComponentVerifyTicket'];
                        WechatOpenSetting::editComponentVerifyTicket($component_verify_ticket,time()+550);
                    break;
                case 'unauthorized' : // 取消授权
                    $status = 2;
                    break;
                case 'authorized' : // 授权
                    $status = 1;
                    break;
                case 'updateauthorized' : // 更新授权
                    break;
            }
            return true;
        }else{
            return false;
        }
    }
    /*
     * XML转化为数组
     */
    public  function xml2array($xmlstring)
    {
        $object = simplexml_load_string($xmlstring, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
        return @json_decode(@json_encode($object),1);
    }
    /*
     * 获取生成临时二维码的Ticket
     * $authorizer_access_token 接口调用凭证
     */
    public function createLsQrcode($authorizer_access_token,$expire_seconds,$sence_str){
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$authorizer_access_token;
        $data = [
            'expire_seconds'=>$expire_seconds,
            'action_name'=>'QR_STR_SCENE',//默认采用字符串而非ID模式
            'action_info'=>[
                'scene'=>[
                    'scene_str'=>$sence_str,
                ]
            ],
        ];
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);

        $re = \HttpCurl::doPost($url, $data);
        $re = json_decode($re,true);
        if(empty($re['ticket'])){
            return false;
        }else{
            return 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$re['ticket'];
        }
    }

    /*
     * 获取生成永久二维码的Ticket
     */
    public function createQrcode($authorizer_access_token,$sence_str){
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$authorizer_access_token;
        $data = [
            'action_name'=>'QR_LIMIT_STR_SCENE',//默认采用字符串而非ID模式
            'action_info'=>[
                'scene'=>[
                    'scene_str'=>$sence_str,
                ]
            ],
        ];
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);

        $re = \HttpCurl::doPost($url, $data);
        $re = json_decode($re,true);
        if(empty($re['ticket'])){
            return false;
        }else{
            return 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$re['ticket'];
        }
    }

    /*
     * 返回加密解密类
     */
    public function WXBizMsgCrypt(){
        $wxparam = config('app.wechat_open_setting');
        $jm = new WXBizMsgCrypt($wxparam['open_token'],  $wxparam['open_key'], $wxparam['open_appid']);
        return $jm;
    }
}
?>