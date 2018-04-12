<?php
/**
 * 盛付通支付接口
 * Creator: xuho
 */

namespace App\Services\Pay;


class Sft
{


    /**
     * 查询订单 接口
     * @param array $param
     * @return mixed
     */
    public static function queryOrder($param)
    {
        try {
            // 接口地址
            $api_url = "http://mgw.shengpay.com/web-acquire-channel/pay/query.htm";
            // 商家的身份码
            $param_body["merchantNo"] = $param["merchantNo"];
            // 字符集
            $param_body["charset"] = 'UTF-8';
            // 请求时间-当前时间
            $param_body["requestTime"] = date('YmdHis');
            // 商品订单id
            $param_body["merchantOrderNo"] = $param["merchantOrderNo"];
            // 盛付通返回的订单id
            $param_body["sftOrderNo"] = null;
            // 其他参数
            $param_body["exts"] = null;
            // json 化 参数数据
            $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);
            // 获取签名
            $header = self::getSign($param_body_json, $param["origin_key"]);
            // 发起请求
            return self::httpRequest($api_url, "post", $param_body_json, $header);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * 退款 接口
     * @param $param
     * @return mixed|string
     */
    public static function refund($param)
    {
        try {
            // 接口地址
            $api_url = "http://mgw.shengpay.com/web-acquire-channel/pay/refund.htm";
            // 商家的身份码
            $param_body["merchantNo"] = $param["merchantNo"];
            // 字符集
            $param_body["charset"] = 'UTF-8';
            // 请求时间-当前时间
            $param_body["requestTime"] = date('YmdHis');
            // 退款流水账号
            $param_body["refundOrderNo"] = $param["refundOrderNo"];
            // 退款订单号
            $param_body["merchantOrderNo"] = $param["merchantOrderNo"];
            // 退款金额
            $param_body["refundAmount"] = $param["refundAmount"];
            // 通知地址
            $param_body["notifyURL"] = $param["notifyURL"];
            // 其他
            $param_body["exts"] = "";

            // json 化 参数数据
            $param_body_json = json_encode($param_body, JSON_UNESCAPED_UNICODE);
            // 获取签名
            $header = self::getSign($param_body_json, $param["origin_key"]);
            // 发起请求
            return self::httpRequest($api_url, "post", $param_body_json, $header);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }




    /**
     * 返回签名
     * @param string $body_content 参数主体，json 格式
     * @param string $origin_key 商家码
     * @return array
     */
    public static function getSign($body_content, $origin_key)
    {
        $header = ["signType: MD5", "signMsg: " . strtoupper(md5($body_content . $origin_key))];
        return $header;
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
    protected static function httpRequest($url, $method, $postData = [], $headers = [], $debug = false)
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