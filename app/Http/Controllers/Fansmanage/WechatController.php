<?php
namespace App\Http\Controllers\Fansmanage;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\Module;
use App\Models\OperationLog;
use App\Models\OrganizationStoreinfo;
use App\Models\ProgramModuleNode;
use App\Models\WechatAuthorization;
use App\Models\WechatAuthorizerInfo;
use App\Models\WechatDefaultReply;
use App\Models\WechatReply;
use App\Services\ZeroneRedis\ZeroneRedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class WechatController extends Controller{
    /**************************************************************************接收推送消息及回复开始*********************************************************************************/
    /*
     * 网页授权链接回调函数
     */
    public function web_redirect(){
        $code = trim($_GET['code']);
        $state = trim($_GET['state']);
        if($state == 'lyxkj2018'){
            $re = \Wechat::get_web_access_token($code);
            $appid = 'wxab6d2b312939eb01';
            $redirect_url = 'http://o2o.01nnt.com/api/wechat/open_web_redirect?param='.$appid.'||'.$re['openid'];
            $url = \Wechat::get_open_web_auth_url($appid,$redirect_url);
            echo "<script>location.href='".$url."'</script>";
            exit();
        }else{
            exit('无效的的回调链接');
        }
    }

    /*
     * 开放平台代网页授权链接回调函数
     */
    public function open_web_redirect(){
        $code = trim($_GET['code']);
        $state = trim($_GET['state']);
        $param = $_GET['param'];
        $param_arr = explode('||',$param);
        $appid = $param_arr[0];
        $open_id = $param_arr[1];
        $auth_info = \Wechat::refresh_authorization_info(1);//刷新并获取授权令牌
        if($state == 'lyxkj2018'){
            $re = \Wechat::get_open_web_access_token($appid,$code);
            dump($open_id);
            dump($re);
            $info = \Wechat::get_fans_info($auth_info['authorizer_access_token'],$open_id);
            dump($info);
            exit();
        }else{
            exit('无效的的回调链接');
        }
    }

    /*
     * 开放平台回复函数
     */
    public function response($appid,Request $request){
        $timestamp = empty($_GET['timestamp']) ? '' : trim($_GET['timestamp']);
        $nonce = empty($_GET['nonce']) ? '' : trim($_GET ['nonce']);
        $msgSign = empty($_GET['msg_signature']) ? '' : trim($_GET['msg_signature']);
        $signature = empty($_GET['signature']) ? '' : trim($_GET['signature']);
        $encryptType = empty($_GET['encrypt_type']) ? '' : trim($_GET['encrypt_type']);
        $openid = $appid;
        $input = file_get_contents('php://input');
        file_put_contents('test.txt',$input);
        $paramArr = $this->xml2array($input);

        $jm = \Wechat::WXBizMsgCrypt();
        $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
        $fromXml = sprintf($format, $paramArr['Encrypt']);
        $toXml='';
        $errCode = $jm->decryptMsg($msgSign, $timestamp, $nonce, $fromXml, $toXml); // 解密
        file_put_contents('test2.txt',$toXml);
        if($errCode == '0'){
            $param = $this->xml2array($toXml);
            $keyword = isset($param['Content']) ? trim($param['Content']) : '';
            // 案例1 - 发送事件
            if (isset($param['Event']) && $paramArr['ToUserName'] == 'gh_3c884a361561') {
                $contentStr = $param ['Event'] . 'from_callback';
            }
            // 案例2 - 返回普通文本
            elseif ($keyword == "TESTCOMPONENT_MSG_TYPE_TEXT") {
                $contentStr = "TESTCOMPONENT_MSG_TYPE_TEXT_callback";
            }
            // 案例3 - 返回Api文本信息
            elseif (strpos($keyword, "QUERY_AUTH_CODE:") !== false) {
                $authcode = str_replace("QUERY_AUTH_CODE:", "", $keyword);
                $contentStr = $authcode . "_from_api";
                $auth_info = \Wechat::get_authorization_info($authcode);
                $accessToken = $auth_info['authorizer_access_token'];
                \Wechat::send_fans_text($accessToken, $param['FromUserName'], $contentStr);
                return 1;
            }else{
                return $this->zerone_response($jm,$param,$appid,$_GET['encrypt_type'],$_GET['timestamp'],$_GET['nonce']);
            }
            //点击事件触发关键字回复
            /*
            elseif ($param['EventKey'] == "1234") {
                $contentStr = $openid.'||'.$param['FromUserName'].'||'.$param['ToUserName']."||测试内容2";
            }
            */
            $result = '';
            if (!empty($contentStr)) {
                $xmlTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            </xml>";
                $result = sprintf($xmlTpl, $param['FromUserName'], $param['ToUserName'], time(), $contentStr);
                if (isset($_GET['encrypt_type']) && $_GET['encrypt_type'] == 'aes') { // 密文传输
                    $encryptMsg = '';
                    $jm->encryptMsg($result, $_GET['timestamp'], $_GET['nonce'], $encryptMsg);
                    $result = $encryptMsg;
                }
            }
            echo $result;
        }
    }

    /**
     * 除全网发布外零壹的回复
     * $jm - 微信加密类
     * $param - 来源内容
     * $appid - 哪个公众号内传过来的消息
     * $encrypt_type - 是否密文传输
     * $timestamp,$nonce - 加密消息要用的数据
     *
     */
    private function zerone_response($jm,$param,$appid,$encrypt_type,$timestamp,$nonce){
        switch($param['MsgType']){
            case "text":
                $content = trim($param['Content']);
                //精确回复
                $re_accurate = WechatReply::getOne([['authorizer_appid',$appid],['type','1'],['keyword',$content]]);
                if(!empty($re_accurate)){
                    switch($re_accurate['reply_type']){
                        case "1":
                            $result = $this->zerone_response_text($param,$re_accurate['reply_info']);
                            break;
                        case "2":
                            $result = $this->zerone_response_image($param,$re_accurate['media_id']);
                            break;
                        case "3":
                            $article_data = $this->get_article_info_data($re_accurate['organization_id'],$re_accurate['media_id']);
                            $result = $this->zerone_response_article($param,$article_data);
                            break;
                    }
                }else{//模糊关键字回复
                    $re_about = WechatReply::getOne([['authorizer_appid',$appid],['type','2'],['keyword','like','%'.$content.'%']]);
                    if(!empty($re_about)){
                        switch($re_about['reply_type']){
                            case "1":
                                $result = $this->zerone_response_text($param,$re_about['reply_info']);
                                break;
                            case "2":
                                $result = $this->zerone_response_image($param,$re_about['media_id']);
                                break;
                            case "3":
                                $article_data = $this->get_article_info_data($re_about['organization_id'],$re_about['media_id']);
                                $result = $this->zerone_response_article($param,$article_data);
                                break;
                        }
                    }else{//默认回复
                        $re_default = WechatDefaultReply::getOne([['authorizer_appid',$appid]]);
                        if(!empty($re_default)){
                            switch($re_default['reply_type']){
                                case "1":
                                    $result = $this->zerone_response_text($param,$re_default['text_info']);
                                    break;
                                case "2":
                                    $result = $this->zerone_response_image($param,$re_default['image_media_id']);
                                    break;
                                case "3":
                                    $article_data = $this->get_article_info_data($re_default['organization_id'],$re_default['article_media_id']);
                                    $result = $this->zerone_response_article($param,$article_data);
                                    break;
                            }
                        }else{
                            $result = $this->zerone_response_text($param,'欢迎光临');
                        }
                    }
                }
                break;

            case "event":
                switch($param['Event']){
                    case "subscribe"://关注事件
                        $re_subscribe = WechatDefaultReply::getOne([['authorizer_appid',$appid]]);
                        if(!empty($re_subscribe)){
                            switch($re_subscribe['reply_type']){
                                case "1":
                                    $result = $this->zerone_response_text($param,$re_subscribe['text_info']);
                                    break;
                                case "2":
                                    $result = $this->zerone_response_image($param,$re_subscribe['image_media_id']);
                                    break;
                                case "3":
                                    $article_data = $this->get_article_info_data($re_subscribe['organization_id'],$re_subscribe['article_media_id']);
                                    $result = $this->zerone_response_article($param,$article_data);
                                    break;
                            }
                        }else{
                            $result = $this->zerone_response_text($param,'欢迎光临');
                        }
                        break;
                    case "unsubscribe"://取消关注事件
                        break;
                    case "CLICK"://点击事件
                        $content = trim($param['EventKey']);
                        //精确回复
                        $re_accurate = WechatReply::getOne([['authorizer_appid',$appid],['type','1'],['keyword',$content]]);
                        if(!empty($re_accurate)){
                            switch($re_accurate['reply_type']){
                                case "1":
                                    $result = $this->zerone_response_text($param,$re_accurate['reply_info']);
                                    break;
                                case "2":
                                    $result = $this->zerone_response_image($param,$re_accurate['media_id']);
                                    break;
                                case "3":
                                    $article_data = $this->get_article_info_data($re_accurate['organization_id'],$re_accurate['media_id']);
                                    $result = $this->zerone_response_article($param,$article_data);
                                    break;
                            }
                        }else{//模糊关键字回复
                            $re_about = WechatReply::getOne([['authorizer_appid',$appid],['type','2']]);
                            if(!empty($re_about)){
                                switch($re_about['reply_type']){
                                    case "1":
                                        $result = $this->zerone_response_text($param,$re_about['reply_info']);
                                        break;
                                    case "2":
                                        $result = $this->zerone_response_image($param,$re_about['media_id']);
                                        break;
                                    case "3":
                                        $article_data = $this->get_article_info_data($re_about['organization_id'],$re_about['media_id']);
                                        $result = $this->zerone_response_article($param,$article_data);
                                        break;
                                }
                            }else{//默认回复
                                $re_default = WechatDefaultReply::getOne([['authorizer_appid',$appid]]);
                                if(!empty($re_default)){
                                    switch($re_default['reply_type']){
                                        case "1":
                                            $result = $this->zerone_response_text($param,$re_default['text_info']);
                                            break;
                                        case "2":
                                            $result = $this->zerone_response_image($param,$re_default['image_media_id']);
                                            break;
                                        case "3":
                                            $article_data = $this->get_article_info_data($re_default['organization_id'],$re_default['article_media_id']);
                                            $result = $this->zerone_response_article($param,$article_data);
                                            break;
                                    }
                                }
                            }
                        }
                        break;
                    default:
                        $result = $this->zerone_response_text($param,'欢迎光临');
                        break;
                }
                break;
            default:
                $result = $this->zerone_response_text($param,'欢迎光临');
                break;

        }
        //$result = $this->zerone_response_text($param,'测试回复内容|'.$appid);
        //$result = $this->zerone_response_image($param,'bosoFPsCynb5D_7F_IPAPKd_FOPDaqpXw62tH8u_t8Q');
        //$result = $this->zerone_response_article($param,[['title'=>'今天礼拜天','description'=>'礼拜天人很少','picurl'=>'http://mmbiz.qpic.cn/mmbiz_jpg/Ft65fsDXhHpXW7QhsteXl5j1FX5ia9kCWwApHTWEfVrOibuZmSwaYhlxRS0ibPiccGv5lGGxSWCmnbBwuhVzCq0vvw/0?wx_fmt=jpeg','url'=>'http://o2o.01nnt.com']]);

        if (isset($encrypt_type) && $_GET['encrypt_type'] == 'aes') { // 密文传输
            $encryptMsg = '';
            $jm->encryptMsg($result, $timestamp, $nonce, $encryptMsg);
            $result = $encryptMsg;
        }
        return $result;
    }

    /*
     * 获取公众号默认回复内容
     */
    private function get_default_reply($appid){
        if(!empty($appid)){
            $info = WechatDefaultReply::getOne([['authorizer_appid',$appid]]);
            if($info['reply_type']=='1'){//文字回复
                return [1,trim($info['text_info'])];
            }elseif($info['reply_type']=='2'){
                return [2,$info['image_media_id']];
            }elseif($info['reply_type']=='2'){
                return [3,trim($info['article_media_id'])];
            }
        }else{
            return [1,''];
        }
    }

    //通过微信接口获取图文信息详情
    private function get_article_info_data($organization_id,$media_id){
        $auth_info = \Wechat::refresh_authorization_info($organization_id);//刷新并获取授权令牌
        $re = \Wechat::get_article_info($auth_info['authorizer_access_token'],$media_id);
        if(empty($re['errcode'])){
            $article_data = [];
            foreach($re['news_item'] as $key=>$val){
                $article_data[$key] = [
                    'title'=>$val['title'],
                    'description'=>$val['digest'],
                    'picurl'=>$val['thumb_url'],
                    'url'=>$val['url'],
                ];
            }
            return $article_data;
        }else{
            return false;
        }
    }

    /*
     * 回复文本消息
     */
    private function zerone_response_text($param,$contentStr){
        $xmlTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            </xml>";
        $result = sprintf($xmlTpl, $param['FromUserName'], $param['ToUserName'], time(), $contentStr);
        return $result;
    }
    /*
     * 回复图片消息
     */
    private function zerone_response_image($param,$media_id){
        $xmlTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[image]]></MsgType>
                <Image>
                <MediaId><![CDATA[%s]]></MediaId>
                </Image>
                </xml>";
        $result = sprintf($xmlTpl, $param['FromUserName'], $param['ToUserName'], time(), $media_id);
        return $result;
    }
    /*
     * 回复文本信息
     */
    private function zerone_response_article($param,$article_data){
        $xmlTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>%s</ArticleCount>
                <Articles>";
        foreach($article_data as $key=>$val){
            $xmlTpl.="<item>
<Title><![CDATA[".$val['title']."]]></Title>
<Description><![CDATA[".$val['description']."]]></Description>
<PicUrl><![CDATA[".$val['picurl']."]]></PicUrl>
<Url><![CDATA[".$val['url']."]]></Url>
</item>";
        }
        $xmlTpl.="</Articles>
                </xml> ";
        $result = sprintf($xmlTpl, $param['FromUserName'], $param['ToUserName'],time(), count($article_data));
        return $result;
    }

    /*
     * XML转化为数组
     */
    public  function xml2array($xmlstring)
    {
        $object = simplexml_load_string($xmlstring, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
        return @json_decode(@json_encode($object),1);
    }

    //接受收授权推送消息。
    public function open(Request $request){
        $timeStamp    =$_GET['timestamp'];
        $nonce        =$_GET['nonce'];
        $encrypt_type =$_GET['encrypt_type'];
        $msg_sign     =$_GET['msg_signature'];
        $encryptMsg   =file_get_contents('php://input');
        //file_put_contents('testopen.txt',$timeStamp.'|'.$nonce.'|'.$encrypt_type.'|'.$msg_sign.'|'.$encryptMsg);
        $result = \Wechat::getVerify_Ticket($timeStamp,$nonce,$encrypt_type,$msg_sign,$encryptMsg);
        if($result){
            ob_clean();
            echo "success";
        }
    }

    //授权回调链接
    public function redirect(Request $request){
        $zerone_param = $_GET['zerone_param'];//中间件产生的管理员数据参数
        $arr = explode('@@',$zerone_param);
        $organization_id = trim($arr[0]);
        $redirect_url = trim($arr[1]);
        $auth_code = $_GET['auth_code'];//授权码
        $auth_info = \Wechat::get_authorization_info($auth_code);//获取授权
        if(WechatAuthorization::checkRowExists($organization_id,$auth_info['authorizer_appid'])){
            return response()->json(['data' => '您的店铺已绑定公众号 或者 您的公众号已经授权到其他店铺', 'status' => '-1']);
        }else {
            $auth_data = array(
                'organization_id' => $organization_id,
                'authorizer_appid' => $auth_info['authorizer_appid'],
                'authorizer_access_token' => $auth_info['authorizer_access_token'],
                'authorizer_refresh_token' => $auth_info['authorizer_refresh_token'],
                'origin_data' => $auth_info['origin_re'],
                'status' => '1',
                'expire_time' => time() + 7200,
            );
            $id = WechatAuthorization::addAuthorization($auth_data);
            return view('Wechat/Catering/redirect',['organization_id'=>$organization_id,'id'=>$id,'redirect_url'=>$redirect_url]);
        }
    }

    /*
     * 从微信端拉取授权方公众号的基本信息 与 拉取它的所有粉丝 并保存到数据库
     */
    public function pull_authorizer_data(Request $request){
        $organization_id  = $request->input('organization_id');
        $id = $request->input('id');
        $auth_info = \Wechat::refresh_authorization_info($organization_id);//刷新并获取授权令牌
        $this->pull_authorizer_info($id,$auth_info,'');
        return response()->json(['data' => '拉取成功', 'status' => '1']);
    }

    /*
     * 拉取公众号的基本信息
     */
    private function pull_authorizer_info($id,$auth_info){
        $authorizer_data = \Wechat::get_authorizer_info($auth_info['authorizer_appid']);//获取对应公众号的详细信息
        $authorizer_info = $authorizer_data['authorizer_info'];
        $data = [
            'authorization_id'=>$id,
            'nickname'=>$authorizer_info['nick_name'],
            'head_img'=>$authorizer_info['head_img'],
            'service_type_info'=>serialize($authorizer_info['service_type_info']),
            'verify_type_info'=>serialize($authorizer_info['verify_type_info']),
            'user_name'=>$authorizer_info['user_name'],
            'principal_name'=>$authorizer_info['principal_name'],
            'alias'=>$authorizer_info['alias'],
            'business_info'=>serialize($authorizer_info['business_info']),
            'qrcode_url'=>$authorizer_info['qrcode_url'],
        ];
        WechatAuthorizerInfo::addAuthorizerInfo($data);
    }
    /**************************************************************************接收推送消息及回复结束********************************************************/


}
?>