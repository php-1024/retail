<?php
/**
 * Android接口
 */

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use App\Models\FansmanageUser;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\WechatAuthorization;
use App\Models\XhoLog;
use App\Services\Curl\HttpCurl;
use Illuminate\Support\Facades\Request;
use Session;

class SftController extends Controller
{
    protected $payChannel = [
        "wp" => ["payment_institution" => "WXZF", "mark" => "微信支付", "pay_type" => "PT312"],
        "ap" => ["payment_institution" => "ALZF", "mark" => "支付宝", "pay_type" => "PT312"],
        "ow" => ["payment_institution" => "OLWX", "mark" => "微信公众号", "pay_type" => "PT312"],
        "oa" => ["payment_institution" => "OLZF", "mark" => "支付宝服务窗", "pay_type" => "PT312"],
        "up" => ["payment_institution" => "UPZF", "mark" => "银联二维码", "pay_type" => "PT312"],
        "ux" => ["payment_institution" => "UPZF", "mark" => "银联条码", "pay_type" => "PT312"],
        "sj" => ["payment_institution" => "JDSA", "mark" => "京东扫码", "pay_type" => "PT312"],
        "sq" => ["payment_institution" => "QQSA", "mark" => "QQ扫码", "pay_type" => "PT312"],
        "hw" => ["payment_institution" => "H5WX", "mark" => "微信H5", "pay_type" => "PT312"],
        "ha" => ["payment_institution" => "H5WA", "mark" => "支付宝H5", "pay_type" => "PT312"],
    ];

    protected $requestFrom = [
        "ios" => [
            "from" => "IOS_APP",
            "app_name" => "",
            "bundle_id" => ""
        ],
        "android" => [
            "from" => "ANDROID_APP",
            "wap_name" => "",
            "package_name" => ""
        ],
        "wap" => [
            "from" => "WAP",
            "wap_name" => "",
            "wap_url" => ""
        ],
    ];

    protected $origin_key = "liuxingwen05118888";
    protected $merchantNo = "11548088";

//    protected $origin_key = "support4test";
//    protected $merchantNo = "540511";

//    protected $origin_key = "dd28576bfe57e5d3";
//    protected $merchantNo = "540511";

    public function test()
    {
        // 订单生成
        $api_url = 'http://mgw.shengpay.com/web-acquire-channel/pay/order.htm';
        $param_body["merchantNo"] = $this->merchantNo;
        $param_body["charset"] = 'UTF-8';
        $param_body["requestTime"] = date('YmdHis');

        // 业务参数
        // 订单号
        $param_body["merchantOrderNo"] = "LS20180408_5_1000" . rand(100, 999);
//        $param_body["merchantOrderNo"] = "LS20180408_5_1000801";

        // 交易金额
        $param_body["amount"] = "0.01";
        $param_body["expireTime"] = date('YmdHis', strtotime("+2 hours"));
        $param_body["notifyUrl"] = "http://develop.01nnt.com/pay/sft/notify";
        $param_body["productName"] = md5(microtime(true));
        $param_body["currency"] = "CNY";
        $param_body["userIp"] = "120.78.140.10";
        $param_body["payChannel"] = "ha";

//        $param_body["openid"] = '11548088';
        $param_body["pageUrl"] = 'http://develop.01nnt.com/pay/sft/test2';

        $exts = array(
            "requestFrom" => "WAP",//ANDROID_APP, IOS_APP, WAP
            "app_name" => "",// APP应用名称
            "bundle_id" => "",//IOS 应用唯一标识
            "package_name" => "",//Android 应用在一台设备上的唯一标识，在manifest文件里声明  ,示例值：com.tecet.tmgp.game
            "wap_url" => 'http://www.17kx.com',//授权域名(报备时填写的域名地址)
            "wap_name" => "测试WAP",//WAP应用名称,网页标题
            "note" => "http://www.17kx.com",//为商户自定义的跟本次交易有关的参数
            "attach" => "" //可以为空，或者为任何自己想要卡网关回传的校验类型的数据。
        );
        $param_body["exts"] = $exts;

        $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);

        $header = ["signType: MD5", "signMsg: " . strtoupper(md5($param_body_json . $this->origin_key))];

        $res = $this->httpRequest($api_url, "post", $param_body_json, $header, false);
        $res_arr = json_decode($res, true);

        if (!empty($res_arr["payUrl"])) {
//            dump($res);
            XhoLog::create(["name" => "跳转前", "content" => $res]);
            header('Location:' . $res_arr["payUrl"]);
        } else {
            dd($res_arr);
        }
    }


    public function test2()
    {
        $res = json_encode(\request()->all(), JSON_UNESCAPED_UNICODE);
        XhoLog::create(["name" => "test2", "content" => $res]);

//        $test = "<script>location.href = 'weixin://wxpay/bizpayurl?pr=m8aUz9Q'</script>";
//        echo $test;
        echo "test2";
    }

    public function notify()
    {
        $res = json_encode(\request()->all(), JSON_UNESCAPED_UNICODE);
        XhoLog::create(["name" => "notify", "content" => $res]);
        echo "OK";
    }


    public function test3()
    {
        // 订单查询
        $api_url = "http://mgw.shengpay.com/web-acquire-channel/pay/query.htm";

        $param_body["merchantNo"] = $this->merchantNo;
        $param_body["charset"] = 'UTF-8';
        $param_body["requestTime"] = date('YmdHis');


        $param_body["merchantOrderNo"] = "LS20180408_5_1000829";
        $param_body["sftOrderNo"] = null;
        $param_body["exts"] = null;

        $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);
        $header = ["signType: MD5", "signMsg: " . strtoupper(md5($param_body_json . $this->origin_key))];
        $res = $this->httpRequest($api_url, "post", $param_body_json, $header, true);
        dd($res);
    }


    public function test4()
    {
        // 退款
        $api_url = "http://mgw.shengpay.com/web-acquire-channel/pay/refund.htm";
        $param_body["merchantNo"] = $this->merchantNo;
        $param_body["charset"] = 'UTF-8';
        $param_body["requestTime"] = date('YmdHis');

        // 退款流水账号
        $param_body["refundOrderNo"] = "TK20180408_5_1000" . rand(100, 999);
        // 退款订单号
        $param_body["merchantOrderNo"] = "LS20180408_5_1000829";
        // 退款金额
        $param_body["refundAmount"] = "0.01";
        // 通知地址
        $param_body["notifyURL"] = "http://develop.01nnt.com/pay/sft/test8";
        // 其他
        $param_body["exts"] = "";

        $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);
        $header = ["signType: MD5", "signMsg: " . strtoupper(md5($param_body_json . $this->origin_key))];
        $this->httpRequest($api_url, "post", $param_body_json, $header, true);
    }



    public function test5()
    {
        // 退款查询
        $api_url = "http://mgw.shengpay.com/web-acquire-channel/pay/refundQuery.htm";
        $param_body["merchantNo"] = $this->merchantNo;
        $param_body["charset"] = 'UTF-8';
        $param_body["requestTime"] = date('YmdHis');

        $param_body["refundOrderNo"] = "TK20180408_5_1000419";
        $param_body["merchantOrderNo"] = "LS20180408_5_1000829";
//        $param_body["refundTransNo"] = "20180412161624998";
//        $param_body["sftOrderNo"] = null;
//        $param_body["exts"] = null;

        $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);
        $header = ["signType: MD5", "signMsg: " . strtoupper(md5($param_body_json . $this->origin_key))];
        $this->httpRequest($api_url, "post", $param_body_json, $header, true);
    }

    public function test6()
    {
        // 分账
        $api_url = "http://mgw.shengpay.com/web-acquire-channel/pay/sharing.htm";
        $param_body["merchantNo"] = $this->merchantNo;
        $param_body["charset"] = 'UTF-8';
        $param_body["requestTime"] = date('YmdHis');

        $num = "003";
        $param_body["sharingOrderNo"] = "FZ20180408_5_10000$num";
        $param_body["merchantOrderNo"] = "LS20180420_23_10000$num";
        $param_body["notifyURL"] = "http://develop.01nnt.com/pay/sft/test8";

        $param_body["sharingReqItem"][0]["sharingNo"] = "NH20180408_5_10000$num";
        $param_body["sharingReqItem"][0]["sharingAmount"] = "";
        $param_body["sharingReqItem"][0]["sharingRate"] = 0.5;
        $param_body["sharingReqItem"][0]["payeeId"] = "540511";
        $param_body["sharingReqItem"][0]["payeeIdType"] = 1;

        $param_body["exts"] = "";

//        dd($param_body);

        $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);
        $header = ["signType: MD5", "signMsg: " . strtoupper(md5($param_body_json . $this->origin_key))];
        $res = $this->httpRequest($api_url, "post", $param_body_json, $header, false);
        dd($res);
    }

    public function test7()
    {
        // 分账查询
        $api_url = "http://mgw.shengpay.com/web-acquire-channel/pay/sharingQuery.htm";
        $param_body["merchantNo"] = '11548088';
        $param_body["charset"] = 'UTF-8';
        $param_body["requestTime"] = date('YmdHis');

        $param_body["sharingQueryOrderNo"] = "";
        $param_body["paymentOrderNo"] = "";
        $param_body["sharingType"] = "";

        $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);
        $header = ["signType: MD5", "signMsg: " . strtoupper(md5($param_body_json . $this->origin_key))];
        $this->httpRequest($api_url, "post", $param_body_json, $header, true);
    }

    public function test8()
    {
        XhoLog::create(["name" => "退款通知", "content" => \request()->all()]);
    }

    public function generateSignature($param)
    {
//        if ($param_body["payChannel"] == 'hw') {
//            $param_body_attach_wxh5["requestFrom"] = "ANDROID_APP";
//            $param_body_attach_wxh5["app_name"] = "ANDROID_APP";
//            $param_body_attach_wxh5["bundle_id"] = "";
//            $param_body_attach_wxh5["package_name"] = "";
//            $param_body_attach_wxh5["wap_url"] = "";
//            $param_body_attach_wxh5["note"] = "";
//            $param_body_attach_wxh5["attach"] = "";
//        }
    }

    protected $zerone_info = [];

    public function test10()
    {
        exit;
        $param["account"] = 10003;
        $param["password"] = 1;
        $param["safepassword"] = 1;
        $param["zerone_open_id"] = 1;
        $param["mobile"] = 1;
        $param["status"] = 1;
        $res = User::updateOrCreate(["account" => 10003], $param);
        return $res;
        exit;

        // 获取零壹配置信息
        $this->zerone_info = config("app.wechat_web_setting");

        // 获取零壹授权信息
        $res = $this->getAuthorizeZeroneInfo();


        if ($res == false) {
            return redirect("benefit/error404");
        }

//        // 将参数添加到request 请求中, 后面控制器调用就直接使用request 获取
//        request()->attributes->add(
//            [
//                'user_info' => $this->user_info,
//                'wechat_config' => $this->wechat_config
//            ]
//        );
    }


    public function test11()
    {
        request()->attributes->add(['organization_id' => 5]); //添加参数
        $this->authorizeInfo();
    }

    protected $wechat_info = [];

    public function authorizeInfo()
    {
        // 判断公众号是否授权给零壹第三方公众号平台
        $this->getShopBaseInfo();
        // 初次访问的地址
        $url = request()->fullUrl();
        // 判断是否存在 零壹服务用户id
        if (empty(session("zerone_auth_info.zerone_user_id"))) {
            $this->getAuthorizeZeroneInfo($url);
            return;
        }
        // 判断 session 中是否存在店铺id
        if (empty(session("zerone_auth_info.shop_id"))) {
            $this->getAuthorizeShopInfo($url);
            return;
        }
        request()->attributes->add(['zerone_auth_info' => session("zerone_auth_info")]);//添加参数
    }

    /**
     * 获取用户信息,并判断是否需要进行跳转
     * @param string $url 跳转的地址
     */
    public function getAuthorizeZeroneInfo($url)
    {
        // 获取 code 地址
        $code = request()->input('code');

        // 如果不存在zerone_openid就进行授权
        if (empty($code)) {
            \Wechat::get_web_auth_url($url, config("app.wechat_web_setting.appid"));
            exit;
        } else {
            // 保存相对应的数据
            $appid = config("app.wechat_web_setting.appid");
            $appsecret = config("app.wechat_web_setting.appsecret");
            $this->setAuthorizeZeroneInfo($appid, $appsecret, $code);
        }
    }

    /**
     * 店铺 网页授权
     * @param string $url 跳转地址
     */
    public function getAuthorizeShopInfo($url)
    {
        $code = request()->input('code');
        $appid = $this->wechat_info["authorizer_appid"];

        // 如果不存在 zerone_openid 就进行授权
        if (empty($code)) {
            \Wechat::get_open_web_auth_url($url, $appid);
            exit;
        } else {
            $this->setAuthorizeShopInfo($appid, $code);
        }
    }

    /**
     * 获取店铺公众号的基本信息
     */
    public function getShopBaseInfo()
    {
        // 获取组织id
        $organization_id = request()->get("organization_id");
        // 获取公众号的基本信息
        $res = WechatAuthorization::getAuthInfo(["organization_id" => $organization_id], ["authorizer_appid", "authorizer_access_token"]);

        // 判断公众号是否在零壹第三方平台授权过
        if ($res !== false) {
            $this->wechat_info = $res;
        } else {
            // 公众号信息没有授权应该进行的步骤

        }
    }

    /**
     * @param $appid
     * @param $appsecret
     * @param $code
     * @return bool
     */
    public function setAuthorizeZeroneInfo($appid, $appsecret, $code)
    {
        // 静默授权：通过授权使用的code,获取到用户openid
        $res_access_arr = \Wechat::get_web_access_token($code, $appid, $appsecret);

        // 如果不存在授权所特有的access_token,则重新获取code,并且验证
        if (!empty($res_access_arr['access_token'])) {
            $openid = $res_access_arr['openid'];
        } else {
            $this->getAuthorizeZeroneInfo(request()->url());
            return;
        }

        DB::beginTransaction();
        try {
            // 获取account 最大的值，然后就可以进行数据的累加
            $account = User::max("account");
            $param["account"] = ++$account;
            $param["password"] = 123456;
            $param["safepassword"] = 123456;
            $param["zerone_open_id"] = $openid;
            $param["status"] = 1;
            $res = User::insertData($param, "update_create", ["zerone_openid" => $param["zerone_open_id"]]);
            session(["zerone_auth_info" => ["zerone_user_id" => $res["id"]]]);
            // 数据提交
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    /**
     * @param $appid
     * @param $code
     * @param string $re_url
     * @return bool
     */
    public function setAuthorizeShopInfo($appid, $code, $re_url = "")
    {
        // 静默授权：通过授权使用的code,获取到用户openid
        $res_access_arr = \Wechat::get_open_web_access_token($appid, $code);

        // 如果不存在授权所特有的access_token,则重新获取code,并且验证
        if (!empty($res_access_arr['access_token'])) {
            $openid = $res_access_arr['openid'];
        } else {
            $this->getAuthorizeShopInfo(request()->url());
            return;
        }

        DB::beginTransaction();
        try {
            // 店铺公众号的信息
            // 组织id
            $param["fansmanage_id"] = request()->get("organization_id");
            $param["user_id"] = session(["zerone_auth_info"])["zerone_user_id"];
            $param["open_id"] = $openid;
            $param["status"] = 1;

            // 创建或者更新粉丝数据
            FansmanageUser::insertData($param, "update_create", ["openid" => $param["open_id"]]);
            session(["zerone_auth_info" => ["shop_id" => request()->get("shop_id")]]);

            // 获取用户的信息
            $user_info = \Wechat::get_web_user_info($this->wechat_info["authorizer_access_token"], $openid);
            // 判断存在用户消息
            if (!empty($user_info["errcode"]) && $user_info["errcode"] != 0) {
                // 用户id
                $param["user_id"] = session(["zerone_auth_info"])["zerone_user_id"];
                $param["nickname"] = $user_info["nickname"];
                $param["sex"] = $user_info["sex"];
                $param["city"] = $user_info["city"];
                $param["country"] = $user_info["country"];
                $param["province"] = $user_info["province"];
                $param["head_imgurl"] = $user_info["headimgurl"];
                // 保存用户数据
                UserInfo::insertData($param);
            }
            // 数据提交
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }


    /**
     * 店铺保存用户授权信息
     * @param $appid
     * @param $appsecret
     * @param $type
     * @param $code
     * @param bool $get_user_info
     * @param $re_url
     * @return boolean
     */
    public function setAuthorizeInfo($appid, $appsecret, $code, $type = "zerone_info", $get_user_info = false, $re_url = "")
    {
        $access_token = "";

        // 静默授权：通过授权使用的code,获取到用户openid

        $res_access_arr = \Wechat::get_web_access_token($code, $appid, $appsecret);

        // 如果不存在授权所特有的access_token,则重新获取code,并且验证
        if (!empty($res_access_arr['access_token'])) {
            $openid = $res_access_arr['openid'];
        } else {
            $url_arr = explode("?", $re_url);
            $this->wechatAuthorize($url_arr[0]);
            exit;
        }

        DB::beginTransaction();
        try {
            // 判断是哪个类型的数据, 进行相对应数据的保存
            switch ($type) {
                // 零壹服务公众号的信息
                case "zerone_info" :
                    // 获取account 最大的值，然后就可以进行数据的累加
                    $account = User::max("account");
                    $param["account"] = ++$account;
                    $param["password"] = 123456;
                    $param["safepassword"] = 123456;
                    $param["zerone_open_id"] = $openid;
                    $param["status"] = 1;
                    $res = User::insertData($param, "update_create", ["zerone_openid" => $param["zerone_open_id"]]);
                    session(["zerone_auth_info" => ["zerone_user_id" => $res["id"]]]);
                    break;
                // 店铺公众号的信息
                case "shop_info":
                    // 组织id
                    $param["fansmanage_id"] = 10002;
                    $param["user_id"] = session(["zerone_auth_info"])["zerone_user_id"];
                    $param["open_id"] = $openid;
                    $param["status"] = 1;
                    // 保存粉丝数据
                    FansmanageUser::insertData($param, "update_create", ["openid" => $param["open_id"]]);
                    session(["zerone_auth_info" => ["shop_id" => "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"]]);
                    break;
            }

            // 判断是否需要获取用户数据
            if ($get_user_info === true) {
                // 获取用户的信息
                $user_info = \Wechat::get_fans_info($access_token, $openid);

                // 判断存在用户消息
                if (!empty($user_info["errcode"]) && $user_info["errcode"] != 0) {
                    // 用户id
                    $param["user_id"] = session(["zerone_auth_info"])["zerone_user_id"];
                    $param["nickname"] = $user_info["nickname"];
                    $param["sex"] = $user_info["sex"];
                    $param["city"] = $user_info["city"];
                    $param["country"] = $user_info["country"];
                    $param["province"] = $user_info["province"];
                    $param["head_imgurl"] = $user_info["headimgurl"];
                    // 保存用户数据
                    UserInfo::insertData($param);
                }
            }
            // 数据提交
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }


    /**
     * 获取 wx.config 里面的签名,JSSDk 所需要的
     *
     * @return array
     */
    public function getSignPackage()
    {
        // 获取微信的信息
        $appid = $this->wechat_config["appid"];
        $ticket = $this->wechat_config["jsapi_ticket"];
        // 设置得到签名的参数
        $url = request()->fullUrl();
        $timestamp = time();
        $nonceStr = substr(md5(time()), 0, 16);
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string
            = "jsapi_ticket={$ticket}&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);
        $signPackage = array("appId" => $appid, "nonceStr" => $nonceStr,
            "timestamp" => $timestamp, "url" => $url,
            "rawString" => $string, "signature" => $signature);
        // 返回签名
        return $signPackage;
    }


    /**
     * CURL请求
     * @param string $url 请求url地址
     * @param string $method 请求方法 get post
     * @param array $postData post数据数组
     * @param array $headers 请求header信息
     * @param bool|false $debug 调试开启 默认false
     * @return mixed
     */
    public function httpRequest($url, $method, $postData = [], $headers = [], $debug = false)
    {
        // 将方法统一换成大写
        $method = strtoupper($method);
        // 初始化
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0");
        // 在发起连接前等待的时间，如果设置为0，则无限等待
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        // 设置CURL允许执行的最长秒数
        curl_setopt($curl, CURLOPT_TIMEOUT, 7);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                if (!empty($postData)) {
                    $tmpdatastr = is_array($postData) ? http_build_query($postData) : $postData;
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $tmpdatastr);
                }
                break;
            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method); /* //设置请求方式 */
                break;
        }
        $ssl = preg_match('/^https:\/\//i', $url) ? true : false;
        curl_setopt($curl, CURLOPT_URL, $url);
        if ($ssl) {
            // https请求 不验证证书和hosts
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            // 不从证书中检查SSL加密算法是否存在
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        // 启用时会将头文件的信息作为数据流输出
//        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        // 指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的
        curl_setopt($curl, CURLOPT_MAXREDIRS, 2);

        // 添加请求头部
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        // COOKIE带过去
//        curl_setopt($curl, CURLOPT_COOKIE, $Cookiestr);
        $response = curl_exec($curl);
        $requestInfo = curl_getinfo($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        // 开启调试模式就返回 curl 的结果
        if ($debug) {
            echo "=====post data======\r\n";
            dump($postData);
            echo "=====info===== \r\n";
            dump($requestInfo);
            echo "=====response=====\r\n";
            dump($response);
            echo "=====http_code=====\r\n";
            dump($http_code);

            dump(curl_getinfo($curl, CURLINFO_HEADER_OUT));
        }
        curl_close($curl);
        return $response;
    }
}
