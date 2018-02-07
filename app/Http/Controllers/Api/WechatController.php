<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

class WechatController extends Controller{
    public function response(){
        $wechat = new \Wechat();
        $wechat->test();
    }
}
?>