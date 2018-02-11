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

    public function open(Request $request){
        $timeStamp    =$request->input('get.timestamp');
        $nonce        =$request->input('get.nonce');
        $encrypt_type =$request->input('get.encrypt_type');
        $msg_sign     =$request->input('get.msg_signature');
        $encryptMsg   =file_get_contents('php://input');

        $result = \Wechat::getVerify_Ticket($timeStamp,$nonce,$encrypt_type,$msg_sign,$encryptMsg);
        if($result){
            ob_clean();
            echo "success";
        }
    }
}
?>