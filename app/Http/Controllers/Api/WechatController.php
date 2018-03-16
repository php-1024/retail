<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WechatOpenSetting;
use App\Models\WechatImage;
use App\Models\WechatAuthorization;
use App\Models\WechatAuthorizerInfo;
use App\Models\Organization;

class WechatController extends Controller{
    /*
     * 店铺授权
     */
    public function store_auth(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $url = \Wechat::get_auth_url($admin_data['organization_id'],$route_name);
        $wechat_info = [];
        $org_info = Organization::where('id',$admin_data['organization_id'])->first();
        if(isset($org_info->wechatAuthorization)) {//如果该组织授权了公众号

            $wechat_info = $org_info->wechatAuthorization->wechatAuthorizerInfo;//获取公众号信息

            //如果没有带参数的二维码
            if(empty($wechat_info['zerone_qrcode_url'])) {
                /**获取公众号带参数关注二维码**/
                $auth_info = \Wechat::refresh_authorization_info($admin_data['organization_id']);//刷新并获取授权令牌

                $imgre = \Wechat::createQrcode($auth_info['authorizer_access_token'], $admin_data['organization_id']);//测试创建临时二维码

                if ($imgre) {
                    WechatAuthorizerInfo::editAuthorizerInfo([['id',$org_info->wechatAuthorization->id]],['zerone_qrcode_url'=>$imgre]);
                    $wechat_info['zerone_qrcode_url'] = $imgre;
                }
            }
        }

        return view('Wechat/Catering/store_auth',['url'=>$url,'wechat_info'=>$wechat_info,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /*
     * 图片素材
     */
    public function material_image(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $list = WechatImage::getPaginage([['organization_id',$admin_data['organization_id']]],30,'id',$sort='DESC');
        return view('Wechat/Catering/material_image',['list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /*
     * 图片素材上传
     */
    public function meterial_image_upload(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Wechat/Catering/material_image_upload',['admin_data'=>$admin_data,'route_name'=>$route_name]);
    }

    /*
     * 图片上传检测
     */
    public function meterial_image_upload_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $file = $request->file('image');
        if(!in_array( strtolower($file->getClientOriginalExtension()),['jpeg','jpg','gif','gpeg','png'])){
            return response()->json(['status' => '0','data'=>'错误的图片格式']);
        }
        if ($file->isValid()) {
            //检验文件是否有效
            $new_name = date('Ymdhis') . mt_rand(100, 999) . '.' . $file->getClientOriginalExtension();  //重命名
            $path = $file->move(base_path() . '/uploads/wechat/'.$admin_data['organization_id'].'/', $new_name);   //$path上传后的文件路径
            $auth_info = \Wechat::refresh_authorization_info($admin_data['organization_id']);//刷新并获取授权令牌
            $re = \Wechat::uploadimg($auth_info['authorizer_access_token'],base_path() . '/uploads/wechat/'.$admin_data['organization_id'].'/'.$new_name);
            if(!empty($re['media_id'])) {
                $data = [
                    'organization_id' => $admin_data['organization_id'],
                    'filename' => $new_name,
                    'filepath' => base_path() . '/uploads/wechat/'.$admin_data['organization_id'].'/'.$new_name,
                    'media_id' => $re['media_id'],
                    'wechat_url' => $re['url']
                ];
                WechatImage::addWechatImage($data);
            }else{
                @unlink(base_path() . '/uploads/wechat/'.$admin_data['organization_id'].'/'.$new_name);
            }
            return response()->json(['data' => '上传商品图片信息成功', 'status' => '1']);
        } else {
            return response()->json(['data'=>'上传图片失败','status' => '0']);
        }
    }
    /*
     * 删除图片
     *
     */
    //直接输入安全密码操作的页面--删除
    public function material_image_delete_comfirm(Request $request){
        $id = $request->input('id');
        return view('Wechat/Catering/material_image_delete_comfirm',['id'=>$id]);
    }
    public function material_image_delete_check(Request $request){
        $id = $request->input('id');
        $image_info = WechatImage::getOne([['id',$id]]);
        $auth_info = \Wechat::refresh_authorization_info($image_info['organization_id']);//刷新并获取授权令牌

        $re = \Wechat::delete_meterial($auth_info['authorizer_access_token'],$image_info['media_id']);
        if($re['errcode']=='0'){
            @unlink($image_info['filepath']);
            WechatImage::where('id',$id)->forceDelete();
            return response()->json(['data'=>'删除图片素材成功','status' => '1']);
        }else{
            return response()->json(['data'=>'删除图片素材失败','status' => '0']);
        }
    }

    /*
     * 图文素材列表
     */
    public function material_article(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Wechat/Catering/material_article',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /*
     * 添加图文素材页面
     */
    public function material_article_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Wechat/Catering/material_article_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /*
     * 图片选择页面
     */
    public function material_image_select(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $list = WechatImage::getList([['organization_id',$admin_data['organization_id']]],'','id','desc');
        return view('Wechat/Catering/material_article_select',['list'=>$list]);
    }

    public function test(){
        $auth_info = \Wechat::refresh_authorization_info(1);//刷新并获取授权令牌

        /*获取授权方公众号信息*/
        //$info = WechatAuthorization::getOne([['organization_id',2]]);
        //\Wechat::get_authorizer_info($info->authorizer_appid);

        /*获取授权公众号的粉丝信息*/
        /*
        $fans_list = \Wechat::get_fans_list($auth_info['authorizer_access_token']);
        dump($fans_list);
        foreach($fans_list['data']['openid'] as $key=>$val){
            \Wechat::get_fans_info($auth_info['authorizer_access_token'],$val);
            exit();
        };
        */
        /******测试发送客服消息******/
        //$to_user = 'oyhbt1I_Gpz3u8JYxWP_NIugQhaQ';
        //$text = '你好世界';
        //\Wechat::send_fans_text($auth_info['authorizer_access_token'],$to_user,$text);

        /***网页授权测试***/
        $redirect_url = 'http://o2o.01nnt.com/api/wechat/web_redirect';
        $url = \Wechat::get_web_auth_url($redirect_url);
        echo "<script>location.href='".$url."'</script>";
        exit();



        //$auth_info =  \Wechat::refresh_authorization_info(1);//刷新并获取授权令牌
        /***测试创建自定义菜单****/
        /*
        $menu_data_test = [
            'button'=>[
                    [
                       'name'=>'菜单1',
                        'sub_button'=>[
                            [
                                'type'=>'click',
                                'name'=>'点击事件',
                                'key'=>'1234',
                            ],
                            [
                                'type'=>'view',
                                'name'=>'链接事件',
                                'url'=>'http://www.01nnt.com',
                            ],
                        ]
                    ],
                    [
                        'name'=>'菜单2',
                        'sub_button'=>[
                            [
                                'type'=>'scancode_waitmsg',
                                'name'=>'扫码提示',
                                'key'=>'1234',
                            ],

                            [
                                'type'=>'pic_sysphoto',
                                'name'=>'系统拍照',
                                'key'=>'1234',
                            ],
                            [
                                'type'=>'pic_photo_or_album',
                                'name'=>'拍照相册',
                                'key'=>'1234',
                            ],
                            [
                                'type'=>'pic_weixin',
                                'name'=>'微信相册',
                                'key'=>'1234',
                            ]
                        ]

                    ],
                    [
                        'name'=>'菜单3',
                        'sub_button'=>[
                            [
                                'type'=>'location_select',
                                'name'=>'发送位置',
                                'key'=>'1234',
                            ],
                            [
                                'type'=>'scancode_push',
                                'name'=>'扫码事件',
                                'key'=>'1234',
                            ],
                        ]
                    ],
            ],
        ];
        $re = \Wechat::create_menu($auth_info['authorizer_access_token'],$menu_data_test);
        dump($re);
        */

        /***测试创建自定义菜单****/
        /*
        $re = \Wechat::search_menu($auth_info['authorizer_access_token']);
        dump($re);
        */

        /***测试删除自定义菜单****/
        /*
        $re = \Wechat::delete_menu($auth_info['authorizer_access_token']);
        dump($re);
        */

        /***测试创建用户标签***/
        /*
        $re = \Wechat::create_fans_tag($auth_info['authorizer_access_token'],'测试标签');
        dump($re);
        */
    }

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
            }elseif ($keyword=='aaa'){
                $contentStr = '你好吗，世界';
            }
            //点击事件触发关键字回复
            elseif ($param['EventKey'] == "1234") {
                $contentStr = $openid.'||'.$param['FromUserName'].'||'.$param['ToUserName']."||测试内容2";
            }
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

    //授权链接
    public function auth(){
        $url = \Wechat::get_auth_url();
        echo "<a href='".$url."'>授权入口</a>";
        //header('location:'.$url);
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
}
?>