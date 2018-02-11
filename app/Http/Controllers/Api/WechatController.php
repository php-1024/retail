<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WechatOpenSetting;

class WechatController extends Controller{
    public function response($appid,Request $request){
        dump($appid);
        //\Wechat::getVerify_Ticket();
        WechatOpenSetting::editComponentVerifyTicket(123,time());
        echo "这里是消息与事件接收URL";
    }

    public function open(){
        echo "授权事件接收URL";
    }
}
?>