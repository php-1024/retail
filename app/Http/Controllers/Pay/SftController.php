<?php
/**
 * Android接口
 */
namespace App\Http\Controllers\Pay;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Session;
class SftController extends Controller{
    public function test(){
        echo "测试盛付通相关接口";
        $url = 'http://mgw.shengpay.com/web-acquire-channel/pay/order.htm';

        $data = [
            'merchantNo' => '11548088',
            'charset'=>'UTF-8',
            'requestTime'=>date('YmdHis'),
            'merchantOrderNo'=>'sft_test'.mt_rand('1000000','9999999'),
            'amount'=>'0.01',
            'expireTime'=>date('YmdHis'),
            'notifyUrl'=>'',
            'productName'=>'测试产品',
            'currency'=>'CNY',
            'userIp'=>$ip = Request::getClientIp(),
            'openid'=>'',
            'pageUrl'=>'',
            'exts'=>'',
        ];

        $data =  json_encode($data, JSON_UNESCAPED_UNICODE);;

        dump($data);

    }

}
?>