<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WechatController extends Controller{
    public function response($appid,Request $request){
        dump($appid);
        \Wechat::getVerify_Ticket();
        echo "这里是消息与事件接收URL";
    }

    public function open(){
        echo "授权事件接收URL";
    }
}
?>