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
    // 公众账号ID
    private $appId = "wx3fb8f4754008e524";
    // 公众账号密钥
    private $appSecret = "eff84a38864f33660994eaaa2f258fcf";
    // 商户号
    private $mchId = "1503376371";
    // api 密钥
    private $key = "f1c7979edd28576bfe57e5d36f0a3604";
    // 商户支付证书
    private $certPemPath = "./uploads/pem/1503376371/apiclient_cert.pem";
    // 支付证书私钥
    private $keyPemPath = "./uploads/pem/1503376371/apiclient_key.pem";

    public $wechat;

    public function __construct()
    {
        $wechat = new WXPay(
            $this->appId,
            $this->mchId,     // mch id
            $this->key,
            realpath($this->certPemPath),
            realpath($this->keyPemPath),
            6000
        );
        $this->wechat = $wechat;
    }

    public function test13()
    {
        $reqData["type"] = "out_refund_no";
        $reqData["number"] = "1003022622018050853721122351525761650";

        $res = $this->refund($reqData);
        echo $res;
    }

    public function demo()
    {
        // 退款查询接口
        $reqData["type"] = "out_refund_no";
        $reqData["number"] = "1003022622018050853721122351525761650";
        $res = $this->refundQuery($reqData);
        echo $res;
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



    public function refund($param = [])
    {
        $data["transaction_id"] = '4200000129201805095842866557';
//        $data["out_trade_no"] = '';

        $data["out_refund_no"] = md5(time());
//        $data["out_refund_no"] = "1111111";
        $data["total_fee"] = 10;
        $data["refund_fee"] = 2;
        $data["refund_desc"] = "12312321";
        $data["notify_url"] = "12312321";

//        dd($data);
        $res = $this->wechat->refund($data);
        return $this->resDispose($res);
    }


    /**
     * 退款订单查询
     * @param array $param
     * @return string
     */
    public function refundQuery($param = [])
    {
        $data[$param["type"]] = $param["number"];
        // 查询接口
        $res = $this->wechat->refundQuery($data);
        return $this->resDispose($res);
    }


    /**
     * 接口返回处理
     * @param $param
     * @return string
     */
    public function resDispose($param)
    {
        if ($param["return_code"] == "SUCCESS") {
            $res["data"] = $param;
            $res["return_code"] = 1;
            $res["return_msg"] = "SUCCESS";
        } else {
            $res["return_code"] = 0;
            $res["return_msg"] = $param["return_msg"];
        }
        return json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}