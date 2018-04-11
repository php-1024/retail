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
    public function test()
    {
        echo "测试盛付通相关接口";
        $url = 'http://mgw.shengpay.com/web-acquire-channel/pay/order.htm';
        http://10.241.80.55:8080/web-acquire-channel/pay/order.htm

        $param["merchantNo"] = '11548088';
        $param["charset"] = '11548088';
        $param["requestTime"] = date('YmdHis');
        $param["signType"] = '11548088';
        $param["signMsg"] = '11548088';

        // 业务参数
        // 订单号
        $param["merchantOrderNo"] = md5(time());
        // 交易金额
        $param["amount"] = "0.01";
        $param["expireTime"] = date('YmdHis', strtotime("+2 hours"));
        $param["notifyUrl"] = "http://o2o.01nnt.com/pay/sft/test2";
        $param["productName"] = '商品test-';
        $param["currency"] = '11548088';
        $param["userIp"] = '11548088';
        $param["payChannel"] = '11548088';
        $param["openid"] = '11548088';
        $param["pageUrl"] = '11548088';
        $param["exts"] = '11548088';


//        请求参数：signType、signMsg为签名字段，这两个字段存放在Request header中；
//        其他为业务相关字段，存放在Request body中，通过对Request body进行MD5签名，
//        产生加密信息串并赋值给signMsg字段。
//        计算公式：sign=md5(requestBody+md5key).toUpperCase()


        $data = [
            'merchantNo' => '11548088',
            'charset' => 'UTF-8',
            'requestTime' => date('YmdHis'),
            'merchantOrderNo' => 'sft_test' . mt_rand('1000000', '9999999'),
            'amount' => '0.01',
            'expireTime' => date('YmdHis'),


            'notifyUrl' => '',
            'productName' => '测试产品',
            'currency' => 'CNY',
            'userIp' => $ip = Request::getClientIp(),
            'openid' => '',
            'pageUrl' => '',
            'exts' => '',
        ];

        $data = json_encode($data, JSON_UNESCAPED_UNICODE);;

        dump($data);

    }

    public function test2()
    {

    }

}
