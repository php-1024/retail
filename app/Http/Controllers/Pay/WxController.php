<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/8
 * Time: 17:09
 */

namespace App\Http\Controllers\Pay;


use App\Http\Controllers\Controller;
use WXPay\WXPay;

class WxController extends Controller
{
    private $appId = "wx3fb8f4754008e524";
    private $appSecret = "eff84a38864f33660994eaaa2f258fcf";
    private $mchId = "1503376371";
    private $key = "f1c7979edd28576bfe57e5d36f0a3604";
    private $certPemPath = "/uploads/pem/1503376371/apiclient_cert.pem";
    private $keyPemPath = "/uploads/pem/1503376371/apiclient_key.pem";

    public $wechat;

    public function __construct()
    {
        $wechat = new WXPay(
            $this->appId,
            $this->mchId,     // mch id
            $this->key,
            $this->certPemPath,
            $this->keyPemPath,
            6000
        );
        $this->wechat = $wechat;
    }

    public function test13()
    {
        $this->orderQuery();
    }

    public function unifiedOrder()
    {

    }


    public function orderQuery()
    {
        $resp = $this->wechat->orderQuery(array(
            'out_trade_no' => '201610265257070987061763',
            'total_fee' => 1,
            'body' => '腾讯充值中心-QQ会员充值',
            'spbill_create_ip' => '123.12.12.123',
            'trade_type' => 'NATIVE',
            'notify_url' => 'https://www.example.com/wxpay/notify'
        ));
        var_dump($resp);
    }
}