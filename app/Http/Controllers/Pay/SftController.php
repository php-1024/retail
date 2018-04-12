<?php
/**
 * Android接口
 */

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
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

//    protected $origin_key = "liuxingwen05118888";
//    protected $merchantNo = "540511";

    public function test()
    {
        // 订单生成
        $api_url = 'http://mgw.shengpay.com/web-acquire-channel/pay/order.htm';
//        $api_url = 'http://mgw.shengpay.com/web-acquire-channel/pay/order.htm';
//        $param_body["merchantNo"] = '11548088';
        $param_body["merchantNo"] = '540511';
        $param_body["charset"] = 'UTF-8';
        $param_body["requestTime"] = date('YmdHis');

        // 业务参数
        // 订单号
        $param_body["merchantOrderNo"] = "LS20180408_5_1000".mt_rand(100,999);
        // 交易金额
        $param_body["amount"] = "0.01";
        $param_body["expireTime"] = date('YmdHis', strtotime("+2 hours"));
        $param_body["notifyUrl"] = "http://o2o.01nnt.com/pay/sft/notify";
        $param_body["productName"] = md5(microtime(true));
        $param_body["currency"] = "CNY";
        $param_body["userIp"] = "120.78.140.10";
        $param_body["payChannel"] = "ow";

//        $param_body["openid"] = '11548088';
        $param_body["pageUrl"] = 'http://o2o.01nnt.com/pay/sft/test2';
//        $param_body["exts"] = '11548088';


        /*
        $param_body["exts"] = array(
            "requestFrom"=>"WAP",//ANDROID_APP, IOS_APP, WAP
            "app_name"=>"",// APP应用名称
            "bundle_id"=>"",//IOS 应用唯一标识
            "package_name"=>"",//Android 应用在一台设备上的唯一标识，在manifest文件里声明  ,示例值：com.tecet.tmgp.game
            "wap_url"=>'http://www.17kx.com',//授权域名(报备时填写的域名地址)
            "wap_name"=>"测试WAP",//WAP应用名称,网页标题
            "note"=>"http://www.17kx.com",//为商户自定义的跟本次交易有关的参数
            "attach"=>"" //可以为空，或者为任何自己想要卡网关回传的校验类型的数据。
        );
        */


        $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);

        $origin_key = "support4test";
//        $origin_key = "liuxingwen05118888";
        $header = ["signType: MD5", "signMsg: " . strtoupper(md5($param_body_json . $origin_key))];

        $res = $this->httpRequest($api_url, "post", $param_body_json, $header, false);
        $res = json_decode($res, true);

        if(!empty($res["payUrl"])) {
            //dump($res);
            header('Location:' . $res["payUrl"]);
        }else{
            dd($res);
        }
    }

    public function test2()
    {
//        dump(\request()->all());
        //$test = "<script>location.href = 'weixin://wxpay/bizpayurl?pr=m8aUz9Q'</script>";
        //echo $test;
        echo "test2";
    }

    public function notify(){
        echo "OK";
    }

    public function test3()
    {
        // 订单查询
        $api_url = "http://mgw.shengpay.com/web-acquire-channel/pay/query.htm";

        $param_body["merchantNo"] = '11548088';
        $param_body["charset"] = 'UTF-8';
        $param_body["requestTime"] = date('YmdHis');


        $param_body["merchantOrderNo"] = date('YmdHis');
        $param_body["sftOrderNo"] = date('YmdHis');
        $param_body["exts"] = date('YmdHis');

        $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);
        $header = ["signType: MD5", "signMsg: " . strtoupper(md5($param_body_json . $this->origin_key))];
        $this->httpRequest($api_url, "post", $param_body_json, $header, true);
    }


    public function test4()
    {
        // 退款
        $api_url = "http://mgw.shengpay.com/web-acquire-channel/pay/refund.htm";
        $param_body["merchantNo"] = '11548088';
        $param_body["charset"] = 'UTF-8';
        $param_body["requestTime"] = date('YmdHis');


        $param_body["refundOrderNo"] = "";
        $param_body["merchantOrderNo"] = "";
        $param_body["refundTransNo"] = "";
        $param_body["sftOrderNo"] = "";
        $param_body["exts"] = "";


        $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);
        $header = ["signType: MD5", "signMsg: " . strtoupper(md5($param_body_json . $this->origin_key))];
        $this->httpRequest($api_url, "post", $param_body_json, $header, true);
    }


    public function test5()
    {
        // 退款查询
        $api_url = "http://mgw.shengpay.com/ web-acquire-channel/pay/refundQuery.htm";
        $param_body["merchantNo"] = '11548088';
        $param_body["charset"] = 'UTF-8';
        $param_body["requestTime"] = date('YmdHis');


        $param_body["refundOrderNo"] = "";
        $param_body["merchantOrderNo"] = "";
        $param_body["refundTransNo"] = "";
        $param_body["sftOrderNo"] = "";
        $param_body["exts"] = "";


        $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);
        $header = ["signType: MD5", "signMsg: " . strtoupper(md5($param_body_json . $this->origin_key))];
        $this->httpRequest($api_url, "post", $param_body_json, $header, true);
    }

    public function test6()
    {
        // 分账
        $api_url = "http://mgw.shengpay.com/web-acquire-channel/pay/sharing.htm";
        $param_body["merchantNo"] = '11548088';
        $param_body["charset"] = 'UTF-8';
        $param_body["requestTime"] = date('YmdHis');


        $param_body["sharingOrderNo"] = "";
        $param_body["merchantOrderNo"] = "";
        $param_body["notifyURL"] = "";

        $param_body["sharingReqItem"][0]["sharingNo"] = "";
        $param_body["sharingReqItem"][0]["sharingAmount"] = "";
        $param_body["sharingReqItem"][0]["sharingRate"] = "";
        $param_body["sharingReqItem"][0]["payeeId"] = "";
        $param_body["sharingReqItem"][0]["payeeIdType"] = "";


        $param_body["exts"] = "";


        $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);
        $header = ["signType: MD5", "signMsg: " . strtoupper(md5($param_body_json . $this->origin_key))];
        $this->httpRequest($api_url, "post", $param_body_json, $header, true);
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


    /**
     * 利用约定数据和私钥生成数字签名
     * @param $data 待签数据
     * @return String 返回签名
     */
    public function sign($data = '')
    {
        if (empty($data)) {
            return False;
        }

        $private_key = file_get_contents(dirname(__FILE__) . '/rsa_private_key.pem');
        if (empty($private_key)) {
            echo "Private Key error!";
            return False;
        }

        $pkeyid = openssl_get_privatekey($private_key);
        if (empty($pkeyid)) {
            echo "private key resource identifier False!";
            return False;
        }

        $verify = openssl_sign($data, $signature, $pkeyid, OPENSSL_ALGO_MD5);
        openssl_free_key($pkeyid);
        return $signature;
    }

    /**
     * 利用公钥和数字签名以及约定数据验证合法性
     * @param $data 待验证数据
     * @param $signature 数字签名
     * @return -1:error验证错误 1:correct验证成功 0:incorrect验证失败
     */
    public function isValid($data = '', $signature = '')
    {
        if (empty($data) || empty($signature)) {
            return False;
        }

        $public_key = file_get_contents(dirname(__FILE__) . '/rsa_public_key.pem');
        if (empty($public_key)) {
            echo "Public Key error!";
            return False;
        }

        $pkeyid = openssl_get_publickey($public_key);
        if (empty($pkeyid)) {
            echo "public key resource identifier False!";
            return False;
        }

        $ret = openssl_verify($data, $signature, $pkeyid, OPENSSL_ALGO_MD5);
        switch ($ret) {
            case -1:
                echo "error";
                break;
            default:
                echo $ret == 1 ? "correct" : "incorrect";//0:incorrect
                break;
        }
        return $ret;
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
