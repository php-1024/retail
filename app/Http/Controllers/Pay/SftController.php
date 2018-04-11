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

    public function test()
    {
        $api_url = 'http://mgw.shengpay.com/web-acquire-channel/pay/order.htm';
//        $param_body["merchantNo"] = '11548088';
//        $param_body["charset"] = 'UTF-8';
//        $param_body["requestTime"] = date('YmdHis');
//
//
//        // 业务参数
//        // 订单号
//        $param_body["merchantOrderNo"] = md5(time());
//        // 交易金额
//        $param_body["amount"] = "0.01";
//        $param_body["expireTime"] = date('YmdHis', strtotime("+2 hours"));
//        $param_body["notifyUrl"] = "http://o2o.01nnt.com/pay/sft/test2";
//        $param_body["productName"] = md5(microtime(true));
//        $param_body["currency"] = "CNY";
//        $param_body["userIp"] = "120.78.140.10";
//        $param_body["payChannel"] = "wp";
////        $param_body["openid"] = '11548088';
////        $param_body["pageUrl"] = 'http://o2o.01nnt.com/pay/sft/test2';
////        $param_body["exts"] = '11548088';
//
//
//        if ($param_body["payChannel"] == 'hw') {
//            $param_body_attach_wxh5["requestFrom"] = "ANDROID_APP";
//            $param_body_attach_wxh5["app_name"] = "ANDROID_APP";
//            $param_body_attach_wxh5["bundle_id"] = "";
//            $param_body_attach_wxh5["package_name"] = "";
//            $param_body_attach_wxh5["wap_url"] = "";
//            $param_body_attach_wxh5["note"] = "";
//            $param_body_attach_wxh5["attach"] = "";
//        }
//
//        $param_head["signType"] = "MD5";
//        $param_head["signMsg"] = md5(microtime());


//        $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);;

        $param_body_json = '{
    "requestTime": "20171222111120", 
    "charset": "UTF-8", 
    "amount": "0.01", 
    "expireTime": "20171222131120", 
    "notifyUrl": "http://o2o.01nnt.com/pay/sft/test2", 
    "userIp": "123.123.123.123", 
    "currency": "CNY", 
    "payChannel": "wp", 
    "merchantOrderNo": "f2e03275ee25488f99e58630dfb02552", 
    "productName": "测试商品", 
    "merchantNo": "540511"
}';
        $res = $this->httpRequest($api_url, "post", $param_body_json);
        dump($res);
    }

    public function generateSignature($param)
    {

    }

    public function test2()
    {
        dd(request()->all());

        $origin = "111";
        $prepare_data['a'] = 'aaa';
        $prepare_data['b'] = 'bbb';
        $prepare_data['c'] = 'ccc';
        $prepare_data['d'] = 'ddd';
        $prepare_data['e'] = 'eee';
        $prepare_data['f'] = 'fff';
        $prepare_data['g'] = 'ggg';
        $prepare_data['h'] = 'hhh';
        $prepare_data['i'] = 'iii';
        $prepare_data['k'] = '';

        foreach ($prepare_data as $key=>$value) {
            if (!empty($value))
                $origin .= "&$key=$value";
        }

        dd($origin);

        $prepare_data['SignMsg'] = strtoupper(md5($origin . $this->key));
        return $prepare_data;
    }

    private $key = '111';

    public function verify()
    {
        $origin = "111";
        $prepare_data['a'] = 'aaa';
        $prepare_data['b'] = 'bbb';
        $prepare_data['c'] = 'ccc';
        $prepare_data['d'] = 'ddd';
        $prepare_data['e'] = 'eee';
        $prepare_data['f'] = 'fff';
        $prepare_data['g'] = 'ggg';
        $prepare_data['h'] = 'hhh';
        $prepare_data['i'] = 'iii';
        $prepare_data['k'] = '';

        foreach ($prepare_data as $value) {
            if (!empty($value))
                $origin .= $value;
        }


        $prepare_data['SignMsg'] = strtoupper(md5($origin . $this->key));
        return $prepare_data;

    }

    /*相应*/
    public function receive()
    {

        if ($this->returnSign()) {
            /*支付成功*/
            $return_data['order_id'] = $_POST['OrderNo'];
            $return_data['payment_id'] = $_POST['TransNo'];
            $return_data['price'] = $_POST['TransAmount'];
            $return_data['order_status'] = 0;
            return $return_data;

            echo 'OK';
        } else {
            echo 'Error';
            error_log(date('m-d H:i:s', SYS_TIME) . '| GET: illegality notice : flase |' . "\r\n", 3, CACHE_PATH . 'pay_error_sanda.php');
            showmessage(L('illegal_sign'));
            return false;
        }

    }


    /*响应数据验证*/
    private function returnSign()
    {
        $params = array(
            'aaa' => '',
            'bbb' => '',
            'ccc' => '',
            'ddd' => '',
            'eee' => '',
            'fff' => '',
            'ggg' => '',
            'hhh' => '',
            'iii' => '',
            'SignType' => 'MD5',
        );
        foreach ($_POST as $key => $value) {
            if (isset($params[$key])) {
                $params[$key] = $value;
            }
        }
        $TransStatus = (int)$_POST['TransStatus'];
        $origin = '';
        foreach ($params as $key => $value) {
            if (!empty($value))
                $origin .= $value;
        }
        $SignMsg = strtoupper(md5($origin . $this->key));
        if ($SignMsg == $_POST['SignMsg'] and $TransStatus == 1) {
            return true;
        } else {
            return false;
        }
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
        curl_setopt($curl, CURLOPT_MAXREDIRS, 2);/**/
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        // COOKIE带过去
//        curl_setopt($curl, CURLOPT_COOKIE, $Cookiestr);
        $response = curl_exec($curl);
        $requestinfo = curl_getinfo($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        // 开启调试模式就返回 curl 的结果
        if ($debug) {
            echo "=====post data======\r\n";
            var_dump($postData);
            echo "=====info===== \r\n";
            print_r($requestinfo);
            echo "=====response=====\r\n";
            print_r($response);
            echo "=====http_code=====\r\n";
            print_r($http_code);
        }
        curl_close($curl);
        return $response;
    }
}
