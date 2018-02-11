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
        file_put_contents('testopen.txt','123456');
        $timeStamp    =$request->input('timestamp');
        $nonce        =$request->input('nonce');
        $encrypt_type =$request->input('encrypt_type');
        $msg_sign     =$request->input('msg_signature');
        $encryptMsg   =file_get_contents('php://input');
        file_put_contents('testopen.txt',$encryptMsg);
        $result = \Wechat::getVerify_Ticket($timeStamp,$nonce,$encrypt_type,$msg_sign,$encryptMsg);
        if($result){
            ob_clean();
            echo "success";
        }
    }
}
?>